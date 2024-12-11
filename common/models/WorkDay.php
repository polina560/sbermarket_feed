<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%work_day}}".
 *
 * @property int           $id
 * @property int           $id_sale_info Отдел продаж
 * @property int           $day          День недели
 * @property int           $open_at      Время открытия
 * @property int           $close_at     Время закртыия
 *
 * @property-read SaleInfo $saleInfo
 */
class WorkDay extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%work_day}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id_sale_info', 'day', 'open_at', 'close_at'], 'required'],
            [['id_sale_info', 'day', 'open_at', 'close_at'], 'integer'],
            [['id_sale_info'], 'exist', 'skipOnError' => true, 'targetClass' => SaleInfo::class, 'targetAttribute' => ['id_sale_info' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    final public function attributeLabels(): array
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_sale_info' => Yii::t('app', 'ID Sale Info'),
            'day' => Yii::t('app', 'Day'),
            'open_at' => Yii::t('app', 'Open At'),
            'close_at' => Yii::t('app', 'Close At'),
        ];
    }

    final public function getSaleInfo(): ActiveQuery
    {
        return $this->hasOne(SaleInfo::class, ['id' => 'id_sale_info']);
    }
}
