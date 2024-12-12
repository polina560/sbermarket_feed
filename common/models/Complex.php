<?php

namespace common\models;

use common\models\AppActiveRecord;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%complex}}".
 *
 * @property int    $id
 * @property int    $id_complex ID Комплекса
 * @property string $name       Название ЖК
 * @property float  $latitude   Географическая широта ЖК
 * @property float  $longitude  Географическая долгота ЖК
 * @property string $address    Название ЖК
 * @property int    $id_feed    ID XML-файла
 */

#[Schema ( properties: [
    new Property(property: 'name', type: 'string')
])]
class Complex extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%complex}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id_complex', 'name', 'latitude', 'longitude', 'address', 'id_feed'], 'required'],
            [['id_complex', 'id_feed'], 'integer'],
            [['latitude', 'longitude'], 'number'],
            [['name', 'address'], 'string', 'max' => 255]
        ];
    }

    public function fields()
    {
        return [
            'name'
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
            'name' => Yii::t('app', 'Name'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'address' => Yii::t('app', 'Address'),
            'id_feed' => Yii::t('app', 'Id Feed'),
        ];
    }
}
