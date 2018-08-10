<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attendance".
 *
 * @property integer $id
 * @property string $date
 * @property string $checkin
 * @property string $checkout
 * @property string $created
 * @property string $modified
 */
class Attendance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
	 
    public static function tableName()
    {
        return 'attendance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'required'],
            [['date', 'checkin', 'checkout', 'checkin2', 'checkout2', 'delay_hours', 'created', 'modified'], 'safe'],
        ];
    }
	
	public function beforeSave($insert)
    {
		$datetime1 = date_create($this->checkin);
		$datetime2 = date_create("9:00:00");
		$interval = date_diff($datetime1, $datetime2);
		$this->delay_hours = $interval->format('%h:%i:%s');
					
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
            'checkin' => 'Checkin',
            'checkout' => 'Checkout',
			'checkin2' => 'Checkin (2)',
            'checkout2' => 'Checkout (2)',
			'delay_hours' => 'Delay Hours',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
