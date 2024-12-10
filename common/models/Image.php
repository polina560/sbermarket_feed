<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%image}}".
 *
 * @property int          $id
 * @property int          $id_complex Комплекс
 * @property string       $image      Ссылка на изображение
 *
 * @property-read Complex $complex
 */
class Image extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%image}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id_complex', 'image'], 'required'],
            [['id_complex'], 'integer'],
            [['image'], 'string', 'max' => 255],
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
            'image' => Yii::t('app', 'Image'),
        ];
    }

    final public function getComplex(): ActiveQuery
    {
        return $this->hasOne(Complex::class, ['id' => 'id_complex']);
    }
}
