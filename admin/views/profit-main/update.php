<?php

use common\components\helpers\UserUrl;
use common\models\ProfitMainSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\ProfitMain
 */

$this->title = Yii::t('app', 'Update Profit Main: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Profit Mains'),
    'url' => UserUrl::setFilters(ProfitMainSearch::class)
];
$this->params['breadcrumbs'][] = ['label' => Html::encode($model->title), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="profit-main-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => false]) ?>

</div>
