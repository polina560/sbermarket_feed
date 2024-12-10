<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%room_area}}".
 *
 * @property int        $id
 * @property int        $id_flat Комната
 * @property float      $area    Площадь жилой комнаты
 *
 * @property-read Flat  $flat
 */
class RoomArea extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%room_area}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id_flat', 'area'], 'required'],
            [['id_flat'], 'integer'],
            [['area'], 'number'],
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
            'id_flat' => Yii::t('app', 'Id Flat'),
            'area' => Yii::t('app', 'Area'),
        ];
    }

    final public function getFlat(): ActiveQuery
    {
        return $this->hasOne(Flat::class, ['id' => 'id_flat']);
    }
}
