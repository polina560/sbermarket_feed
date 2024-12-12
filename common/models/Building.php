<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%building}}".
 *
 * @property int              $id
 * @property int              $fz_214                Соответствие ФЗ-214
 * @property int              $id_complex            Комплекс
 * @property int              $id_build              ID Строения
 * @property string           $name                  Название корпуса
 * @property int|null         $floors                Количество этажей
 * @property int|null         $floors_ready          Количество построенных этажей
 * @property int|null         $building_state        Статус стройки
 * @property string|null      $image                 Фото расположения корпуса
 * @property float|null       $ceiling_height        Высота потолков
 * @property int|null         $passenger_lifts_count Минимальное количество пассажирских лифтов
 * @property int|null         $cargo_lifts_count     Минимальное количество грузовых  лифтов
 *
 * @property-read Complex     $complex
 * @property-read Flat[]      $flats
 */
class Building extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%building}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [[ 'id_complex'], 'required'],
            [['id_build', 'fz_214', 'id_complex', 'floors', 'floors_ready', 'building_state', 'passenger_lifts_count', 'cargo_lifts_count'], 'integer'],
            [['ceiling_height'], 'number'],
            [['name', 'image'], 'string', 'max' => 255],
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
            'fz_214' => Yii::t('app', 'Fz 214'),
            'id_complex' => Yii::t('app', 'ID Complex'),
            'id_build' => Yii::t('app', 'ID Building'),
            'name' => Yii::t('app', 'Name'),
            'floors' => Yii::t('app', 'Floors'),
            'floors_ready' => Yii::t('app', 'Floors Ready'),
            'building_state' => Yii::t('app', 'Building State'),
            'image' => Yii::t('app', 'Image'),
            'ceiling_height' => Yii::t('app', 'Ceiling Height'),
            'passenger_lifts_count' => Yii::t('app', 'Passenger Lifts Count'),
            'cargo_lifts_count' => Yii::t('app', 'Cargo Lifts Count'),
        ];
    }

    final public function getComplex(): ActiveQuery
    {
        return $this->hasOne(Complex::class, ['id' => 'id_complex']);
    }

    final public function getFlats(): ActiveQuery
    {
        return $this->hasMany(Flat::class, ['id_building' => 'id']);
    }
}
