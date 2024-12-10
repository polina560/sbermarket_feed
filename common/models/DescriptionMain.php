<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%description_main}}".
 *
 * @property int              $id
 * @property int              $id_complex Комплекс
 * @property string|null      $title      Заголовок
 * @property string           $text       Описание
 *
 * @property-read Complex     $complex
 */
class DescriptionMain extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%description_main}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id_complex', 'text'], 'required'],
            [['id_complex'], 'integer'],
            [['title'], 'string', 'max' => 500],
            [['text'], 'string', 'max' => 3000],
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
            'title' => Yii::t('app', 'Title'),
            'text' => Yii::t('app', 'Text'),
        ];
    }

    final public function getComplex(): ActiveQuery
    {
        return $this->hasOne(Complex::class, ['id' => 'id_complex']);
    }
}
