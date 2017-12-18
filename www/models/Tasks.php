<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property integer $id
 * @property string $date
 * @property string $bug_no
 * @property string $priority
 * @property string $estimated_hours
 * @property string $start_time
 * @property string $end_time
 * @property string $hours_worked
 * @property string $project
 * @property string $module
 * @property string $work_details
 * @property string $status
 * @property string $comments
 * @property integer $position
 * @property string $created
 * @property string $modified
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'work_details', 'start_time', 'end_time', 'status', 'priority', 'position'], 'required'],
            [['date', 'estimated_hours', 'start_time', 'end_time', 'hours_worked', 'adj_time', 'created', 'modified'], 'safe'],
            [['work_details', 'comments'], 'string'],
			[['position', 'checkin'], 'integer'],
            [['bug_no', 'project', 'module', 'status'], 'string', 'max' => 45],
            [['priority'], 'string', 'max' => 20],
        ];
    }

public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if(!$this->id){
				$this->created=date("Y-m-d H:i:s");
			}
			$this->modified=date("Y-m-d H:i:s");
            return true;
        } else {
            return false;
        }
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'bug_no' => 'Bug No',
            'priority' => 'Priority',
            'estimated_hours' => 'Estimated Hours',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'hours_worked' => 'Hours Worked',
			'adj_time' => 'Adj Time',
            'project' => 'Project',
            'module' => 'Module',
            'work_details' => 'Work Details',
            'status' => 'Status',
            'comments' => 'Comments',
            'position' => 'Position',
			'checkin' => 'Check In',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
