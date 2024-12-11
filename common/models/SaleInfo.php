<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%sale_info}}".
 *
 * @property int              $id
 * @property int              $id_complex      Комплекс
 * @property string           $sales_phone     Телефон отдела продаж
 * @property string|null      $address         Адрес отдела продаж
 * @property float|null       $sales_latitude  Широта отдела продаж
 * @property float|null       $sales_longitude Долгота отдела продаж
 * @property string           $timezone        Часовой пояс по Гринвичу
 *
 * @property-read Complex     $complex
 * @property-read WorkDay[]   $workDays
 */
class SaleInfo extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%sale_info}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id_complex', 'sales_phone', 'timezone'], 'required'],
            [['id_complex'], 'integer'],
            [['sales_latitude', 'sales_longitude'], 'number'],
            [['sales_phone', 'address', 'timezone'], 'string', 'max' => 255],
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
            'sales_phone' => Yii::t('app', 'Sales Phone'),
            'address' => Yii::t('app', 'Address'),
            'sales_latitude' => Yii::t('app', 'Sales Latitude'),
            'sales_longitude' => Yii::t('app', 'Sales Longitude'),
            'timezone' => Yii::t('app', 'Timezone'),
        ];
    }

    final public function getComplex(): ActiveQuery
    {
        return $this->hasOne(Complex::class, ['id' => 'id_complex']);
    }

    final public function getWorkDays(): ActiveQuery
    {
        return $this->hasMany(WorkDay::class, ['id_sale_info' => 'id']);
    }
}
