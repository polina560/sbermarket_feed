<?php

namespace common\models;

use common\models\AppActiveRecord;
use OpenApi\Attributes\Property;
use OpenApi\Attributes\Schema;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%complex}}".
 *
 * @property int                    $id
 * @property int                    $id_complex
 * @property string                 $name      Название ЖК
 * @property float                  $latitude  Географическая широта ЖК
 * @property float                  $longitude Географическая долгота ЖК
 * @property string                 $address   Название ЖК
 *
 * @property-read Building[]        $buildings
 * @property-read DescriptionMain[] $descriptionMains
 * @property-read Developer[]       $developers
 * @property-read Discount[]        $discounts
 * @property-read Image[]           $images
 * @property-read ProfitMain[]      $profitMains
 * @property-read SaleInfo[]        $saleInfos
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
            [['name', 'latitude', 'longitude', 'address'], 'required'],
            [['latitude', 'longitude'], 'number'],
            [['name', 'address'], 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'address' => Yii::t('app', 'Address'),
        ];
    }

    public function fields()
    {
        return [
            'name'
        ];
    }

    final public function getBuildings(): ActiveQuery
    {
        return $this->hasMany(Building::class, ['id_complex' => 'id']);
    }

    final public function getDescriptionMains(): ActiveQuery
    {
        return $this->hasMany(DescriptionMain::class, ['id_complex' => 'id']);
    }

    final public function getDevelopers(): ActiveQuery
    {
        return $this->hasMany(Developer::class, ['id_complex' => 'id']);
    }

    final public function getDiscounts(): ActiveQuery
    {
        return $this->hasMany(Discount::class, ['id_complex' => 'id']);
    }

    final public function getImages(): ActiveQuery
    {
        return $this->hasMany(Image::class, ['id_complex' => 'id']);
    }

    final public function getProfitMains(): ActiveQuery
    {
        return $this->hasMany(ProfitMain::class, ['id_complex' => 'id']);
    }

    final public function getSaleInfos(): ActiveQuery
    {
        return $this->hasMany(SaleInfo::class, ['id_complex' => 'id']);
    }
}
