<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%xml_file}}".
 *
 * @property int         $id
 * @property string      $key        Ключ
 * @property string|null $xml        XML-файл
 * @property int         $updated_at Время изменения
 */
class XmlFile extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => false,
            ]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%xml_file}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['key'], 'required'],
            [['xml'], 'string'],
            [['updated_at'], 'integer'],
            [['key'], 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'key' => Yii::t('app', 'Key'),
            'xml' => Yii::t('app', 'Xml'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
