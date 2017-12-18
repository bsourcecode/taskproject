<?php 

namespace app\controllers;

use Yii;
use app\models\Tasks;
use app\models\Globals;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TasksController implements the CRUD actions for Tasks model.
 */
class TasksController extends Controller
{

    /**
     * @inheritdoc
     */
    public $statusList = array('in_progress' => 'In progress', 'complete' => 'Completed');
    public $priorityList = array('high' => 'High', 'normal' => 'Normal', 'low' => 'Low');

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (isset($_GET['fdate'])) {
            $dataProvider = new ActiveDataProvider([
                'query' => Tasks::find()->where(['date' => $_GET['fdate']])->orderBy(['position' => 0])
            ]);
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => Tasks::find(),
            ]);
        }

        return $this->render('index', [
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Tasks models.
     * @return mixed
     */
    public function actionAttendance()
    {
		$dataProvider = new ActiveDataProvider([
			'query' => Tasks::find()->where(['checkin' => 1])->orderBy(['date' => 'DESC'])
		]);

        return $this->render('attendance', [
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tasks model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
                'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tasks model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tasks();
        if (Yii::$app->request->post()) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return json_encode(array());
            } else {
                return json_encode($model->getErrors());
            }
            exit;
        } else {
            $lists = Globals::find()->select('value')->asArray()->all();
            $projectList = [];
            foreach($lists as $list){
                $projectList[$list['value']] = $list['value'];
            }
            return $this->renderPartial('create', [
                    'model' => $model,
                    'statusList' => $this->statusList,
                    'priorityList' => $this->priorityList,
                    'projectList' => $projectList
            ]);
        }
    }

    /**
     * Updates an existing Tasks model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->post()) {
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return json_encode(array());
            } else {
                return json_encode($model->getErrors());
            }
            exit;
        } else {
            
            $lists = Globals::find()->select('value')->asArray()->all();
            $projectList = [];
            foreach($lists as $list){
                $projectList[$list['value']] = $list['value'];
            }
            return $this->renderPartial('update', [
                    'model' => $model,
                    'statusList' => $this->statusList,
                    'priorityList' => $this->priorityList,
                    'projectList' => $projectList
            ]);
        }
    }

    /**
     * Deletes an existing Tasks model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tasks the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tasks::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDayreport($date)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tasks::find()->where(['date' => $date])->orderBy(['position' => 0])
        ]);

        if (isset($_GET['csv'])) {
            $this->download($dataProvider, $date);
        } else {
            return $this->render('report_today', [
                    'dataProvider' => $dataProvider,
                    'statusList' => $this->statusList,
                    'priorityList' => $this->priorityList,
            ]);
        }
    }

    public function actionTomorrow()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tasks::find()->where(['date' => date("Y-m-d", strtotime(date("Y-m-d ") . " +1 day"))]),
        ]);

        return $this->render('report_tomorrow', [
                'dataProvider' => $dataProvider,
                'statusList' => $this->statusList,
                'priorityList' => $this->priorityList,
        ]);
    }

    public function download($dataProvider, $date)
    {
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"Report".$date.".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        $handle = fopen('php://output', 'w');
        $heading = array(
            'Date*',
            'Bug No.*',
            'Priority',
            'Start Time',
            'End Time',
            'Project *',
            'Module Name / Task Name *',
            'Work Details *',
            'Hrs Worked *',
            'Status *',
            'Comments *',
        );
        fputcsv($handle, $heading);
        
        foreach ($dataProvider->models as $model) {
            fputcsv($handle, array(
                date("m/d/Y", strtotime($model->date)),
                $model->bug_no,
                $this->priorityList[$model->priority],
                date("H:i", strtotime($model->start_time)),
                date("H:i", strtotime($model->end_time)),
                $model->project,
                $model->module,
                $model->work_details,
                date("H:i", strtotime($model->hours_worked)),
                $this->statusList[$model->status],
                $model->comments,
            ));
        }
        
        fclose($handle);
        exit;
    }
}
