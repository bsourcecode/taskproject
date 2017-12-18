<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "version".
 *
 * @property integer $v_major
 * @property integer $v_minor
 * @property integer $v_patch
 * @property integer $v_realpatch
 * @property string $v_tag
 * @property integer $v_database
 * @property integer $v_acl
 * @property string $id
 */
class Version extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'version';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['v_major', 'v_minor', 'v_patch', 'v_realpatch', 'v_database', 'v_acl'], 'integer'],
            [['id', 'v_major'], 'required'],
            [['v_tag'], 'string', 'max' => 31],
            [['id'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'v_major' => 'V Major',
            'v_minor' => 'V Minor',
            'v_patch' => 'V Patch',
            'v_realpatch' => 'V Realpatch',
            'v_tag' => 'V Tag',
            'v_database' => 'V Database',
            'v_acl' => 'V Acl',
            'id' => 'ID',
        ];
    }
}
