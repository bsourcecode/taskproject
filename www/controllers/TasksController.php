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
	
    public function actionCopy($id)
    {
        $exist = $this->findModel($id);
		$data = $exist->attributes;
		
		$model = new Tasks();
		$model->setAttributes($data);
        $model->date = date("Y-m-d H:i:s");
		$model->save();
		echo 1;
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

        if (isset($_GET['csv']) && isset($_GET['full'])) {
            $this->download1($dataProvider, $date);
        }else if (isset($_GET['csv'])) {
            $this->download($dataProvider, $date);
        } else {
            return $this->render('report_today', [
                    'dataProvider' => $dataProvider,
                    'statusList' => $this->statusList,
                    'priorityList' => $this->priorityList,
					'this_month' => $this->TotalHours(0),
					'last_month' => $this->TotalHours(1),
					'before_month' => $this->TotalHours(2),
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

    public function TotalHours($month = 0)
    {
		$start_date = date("Y-m-01", strtotime(date("Y-m-d") . " - ". $month." month"));
		$end_date = date("Y-m-t", strtotime(date("Y-m-d") . " - ". $month." month"));
		$result = Tasks::find()->select('SUM(hours_number) as hours_number')->where(['between', 'date', $start_date, $end_date])->all();
		if($result){
			foreach($result as $res){
				return $res->hours_number;
			}
		}
		return 0;
    }

    public function download($dataProvider, $date)
    {
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"Report".$date.".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        $handle = fopen('php://output', 'w');
        $heading = array(
            'Date',
			'Hours',
            'Bug',
            'Action',
            'Task',
            'Comments',
        );
        fputcsv($handle, $heading);
        
        foreach ($dataProvider->models as $index => $model) {
            fputcsv($handle, array(
                $index==0?date("m/d/Y", strtotime($model->date)):'',
				$model->hours_number,
                $model->bug_no,
                $model->module,
                $model->work_details,
                $model->comments,
            ));
        }
        
        fclose($handle);
        exit;
    }

    public function download1($dataProvider, $date)
    {        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"Report".$date.".csv\"");
        header("Pragma: no-cache");
        header("Expires: 0");

        $handle = fopen('php://output', 'w');
        $heading = array(
            'Date',
			'Bug',
			'Priority',
			'Start Time',
			'End Time',
			'Project',			
			'Module Name',
            'Task',
			'Hours',
			'Status',
            'Comments',
        );
        fputcsv($handle, $heading);
        
        foreach ($dataProvider->models as $index => $model) {
            fputcsv($handle, array(
                $index==0?date("m/d/Y", strtotime($model->date)):'',
				$model->bug_no,
				$this->priorityList[$model->priority],
				$model->start_time,
				$model->end_time,
				$model->project,
                '',
                $model->work_details,
				$model->hours_number,
				$this->statusList[$model->status],
                ' '.$model->comments,
            ));
        }
        
        fclose($handle);
        exit;
    }
}
