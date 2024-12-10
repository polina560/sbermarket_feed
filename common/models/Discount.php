<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%discount}}".
 *
 * @property int              $id
 * @property int              $id_complex  Комплекс
 * @property string           $name        Название акции
 * @property string           $description Описание акции
 * @property string|null      $image       Изображение
 *
 * @property-read Complex     $complex
 */
class Discount extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%discount}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id_complex', 'name', 'description'], 'required'],
            [['id_complex'], 'integer'],
            [['name', 'image'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 3000],
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
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'image' => Yii::t('app', 'Image'),
        ];
    }

    final public function getComplex(): ActiveQuery
    {
        return $this->hasOne(Complex::class, ['id' => 'id_complex']);
    }
}
