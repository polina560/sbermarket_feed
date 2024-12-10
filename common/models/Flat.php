<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%flat}}".
 *
 * @property int              $id
 * @property int              $flat_id        ID квартиры
 * @property int              $id_building    Строение
 * @property int              $apartment      Номер квартиры
 * @property int              $floor          Этаж
 * @property int              $room           Количество комнат
 * @property int|null         $ceiling_height Высота потолков в квартире
 * @property string|null      $description    Характеристики квартиры
 * @property int|null         $balcony        Наличие балкона
 * @property int|null         $renovation     Качество отделки
 * @property int              $price          Цена в рублях
 * @property float            $area           Общая площадь
 * @property float            $living_area    Жилая площадь
 * @property float            $kitchen_area   Площадь кухни
 * @property int|null         $window_view    Вид из окон
 * @property int|null         $bathroom       Санузел
 * @property string|null      $layout_type    Тип планировки
 * @property int              $housing_type   Тип жилья
 *
 * @property-read Building    $building
 * @property-read Plan[]      $plans
 * @property-read RoomArea[]  $roomAreas
 */
class Flat extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%flat}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['flat_id', 'id_building', 'apartment', 'floor', 'room', 'price', 'area', 'living_area', 'kitchen_area', 'housing_type'], 'required'],
            [['flat_id', 'id_building', 'apartment', 'floor', 'room', 'ceiling_height', 'balcony', 'renovation', 'price', 'window_view', 'bathroom', 'housing_type'], 'integer'],
            [['area', 'living_area', 'kitchen_area'], 'number'],
            [['description', 'layout_type'], 'string', 'max' => 255],
            [['id_building'], 'exist', 'skipOnError' => true, 'targetClass' => Building::class, 'targetAttribute' => ['id_building' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'flat_id' => Yii::t('app', 'Flat ID'),
            'id_building' => Yii::t('app', 'Id Building'),
            'apartment' => Yii::t('app', 'Apartment'),
            'floor' => Yii::t('app', 'Floor'),
            'room' => Yii::t('app', 'Room'),
            'ceiling_height' => Yii::t('app', 'Ceiling Height'),
            'description' => Yii::t('app', 'Description'),
            'balcony' => Yii::t('app', 'Balcony'),
            'renovation' => Yii::t('app', 'Renovation'),
            'price' => Yii::t('app', 'Price'),
            'area' => Yii::t('app', 'Area'),
            'living_area' => Yii::t('app', 'Living Area'),
            'kitchen_area' => Yii::t('app', 'Kitchen Area'),
            'window_view' => Yii::t('app', 'Window View'),
            'bathroom' => Yii::t('app', 'Bathroom'),
            'layout_type' => Yii::t('app', 'Layout Type'),
            'housing_type' => Yii::t('app', 'Housing Type'),
        ];
    }

    final public function getBuilding(): ActiveQuery
    {
        return $this->hasOne(Building::class, ['id' => 'id_building']);
    }

    final public function getPlans(): ActiveQuery
    {
        return $this->hasMany(Plan::class, ['id_flat' => 'id']);
    }

    final public function getRoomAreas(): ActiveQuery
    {
        return $this->hasMany(RoomArea::class, ['id_flat' => 'id']);
    }
}
