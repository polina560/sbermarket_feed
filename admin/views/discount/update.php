<?php

use common\components\helpers\UserUrl;
use common\models\DiscountSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Discount
 */

$this->title = Yii::t('app', 'Update Discount: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Discounts'),
    'url' => UserUrl::setFilters(DiscountSearch::class)
];
$this->params['breadcrumbs'][] = ['label' => Html::encode($model->name), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="discount-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => false]) ?>

</div>
