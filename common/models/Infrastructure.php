<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%infrastructure}}".
 *
 * @property int           $id
 * @property int           $id_complex    Комплекс
 * @property int|null      $parking       Парковка
 * @property int|null      $security      Охрана
 * @property int|null      $fenced_area   Огороженная территория
 * @property int|null      $sports_ground Спортивная площадка
 * @property int|null      $playground    Детская площадка
 * @property int|null      $school        Школа
 * @property int|null      $kindergarten  Детский сад
 *
 * @property-read Complex  $complex
 */
class Infrastructure extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%infrastructure}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id_complex'], 'required'],
            [['id_complex', 'parking', 'security', 'fenced_area', 'sports_ground', 'playground', 'school', 'kindergarten'], 'integer'],
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
            'id_complex' => Yii::t('app', 'ID Complex'),
            'parking' => Yii::t('app', 'Parking'),
            'security' => Yii::t('app', 'Security'),
            'fenced_area' => Yii::t('app', 'Fenced Area'),
            'sports_ground' => Yii::t('app', 'Sports Ground'),
            'playground' => Yii::t('app', 'Playground'),
            'school' => Yii::t('app', 'School'),
            'kindergarten' => Yii::t('app', 'Kindergarten'),
        ];
    }

    final public function getComplex(): ActiveQuery
    {
        return $this->hasOne(Complex::class, ['id' => 'id_complex']);
    }
}
