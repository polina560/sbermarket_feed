<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%profit_main}}".
 *
 * @property int          $id
 * @property int          $id_complex Комплекс
 * @property string       $title      Заголовок
 * @property string       $text       Описание
 * @property string       $image      Изображение
 *
 * @property-read Complex $complex
 */
class ProfitMain extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%profit_main}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id_complex', 'title', 'text', 'image'], 'required'],
            [['id_complex'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            [['text'], 'string', 'max' => 500],
            [['id_complex'], 'exist', 'skipOnError' => true, 'targetClass' => Complex::class, 'targetAttribute' => ['id_complex' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_complex' => Yii::t('app', 'Id Complex'),
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
            'image' => Yii::t('app', 'Image'),
        ];
    }

    final public function getComplex(): ActiveQuery
    {
        return $this->hasOne(Complex::class, ['id' => 'id_complex']);
    }
}
