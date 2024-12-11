<?php

namespace common\models;

use common\models\AppActiveRecord;
use Yii;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%developer}}".
 *
 * @property int              $id
 * @property int              $id_complex   Комплекс
 * @property int              $id_developer ID застройщика
 * @property string           $name         Название застройщика
 * @property string|null      $site         Ссылка на сайт
 * @property string|null      $logo         Ссылка на логотип
 *
 * @property-read Complex     $complex
 */
class Developer extends AppActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%developer}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['id_complex', 'id_developer', 'name'], 'required'],
            [['id_complex', 'id_developer'], 'integer'],
            [['name', 'site', 'logo'], 'string', 'max' => 255],
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
            'id_complex' => Yii::t('app', 'ID Complex'),
            'id_developer' => Yii::t('app', 'ID Developer'),
            'name' => Yii::t('app', 'Name'),
            'site' => Yii::t('app', 'Site'),
            'logo' => Yii::t('app', 'Logo'),
        ];
    }

    final public function getComplex(): ActiveQuery
    {
        return $this->hasOne(Complex::class, ['id' => 'id_complex']);
    }
}
