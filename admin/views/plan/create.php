<?php

use common\components\helpers\UserUrl;
use common\models\PlanSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Plan
 */

$this->title = Yii::t('app', 'Create Plan');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Plans'),
    'url' => UserUrl::setFilters(PlanSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
