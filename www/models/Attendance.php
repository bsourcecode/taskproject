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
            [['date', 'checkin', 'checkout', 'created', 'modified'], 'safe'],
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
            'checkin' => 'Checkin',
            'checkout' => 'Checkout',
            'created' => 'Created',
            'modified' => 'Modified',
        ];
    }
}
