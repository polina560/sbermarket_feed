<?php

use common\components\helpers\UserUrl;
use common\models\SaleInfoSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\SaleInfo
 */

$this->title = Yii::t('app', 'Update Sale Info: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Sale Infos'),
    'url' => UserUrl::setFilters(SaleInfoSearch::class)
];
$this->params['breadcrumbs'][] = ['label' => Html::encode($model->id), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="sale-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => false]) ?>

</div>
