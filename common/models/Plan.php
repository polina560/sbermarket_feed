<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%plan}}".
 *
 * @property int         $id
 * @property int         $id_flat Комната
 * @property string      $plan    Фото квартиры
 *
 * @property-read Flat   $flat
 */
class Plan extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%plan}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id_flat', 'plan'], 'required'],
            [['id_flat'], 'integer'],
            [['plan'], 'string', 'max' => 255],
            [['id_flat'], 'exist', 'skipOnError' => true, 'targetClass' => Flat::class, 'targetAttribute' => ['id_flat' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_flat' => Yii::t('app', 'ID Flat'),
            'plan' => Yii::t('app', 'Plan'),
        ];
    }

    final public function getFlat(): ActiveQuery
    {
        return $this->hasOne(Flat::class, ['id' => 'id_flat']);
    }
}
