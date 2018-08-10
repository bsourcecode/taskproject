<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "api".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $url
 * @property string $formats
 * @property string $http_method
 * @property string $parameters
 * @property string $prerequisites
 * @property string $notes
 * @property string $sample_request
 * @property string $sample_response
 * @property string $error_response
 */
class Api extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'api';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url', 'formats', 'http_method', 'position'], 'required'],
			[['position'], 'number'],
            [['description', 'url', 'formats', 'http_method', 'parameters', 'prerequisites', 'notes', 'sample_request', 'sample_response', 'error_response'], 'string'],
            [['title'], 'string', 'max' => 250],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'url' => 'Url',
            'formats' => 'Formats',
            'http_method' => 'Http Method',
            'parameters' => 'Parameters',
            'prerequisites' => 'Prerequisites',
            'notes' => 'Notes',
            'sample_request' => 'Sample Request',
            'sample_response' => 'Sample Response',
            'error_response' => 'Error Response',
			'position' => 'Position',
        ];
    }
}
