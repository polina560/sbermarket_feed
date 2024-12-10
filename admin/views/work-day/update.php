<?php

use common\components\helpers\UserUrl;
use common\models\WorkDaySearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\WorkDay
 */

$this->title = Yii::t('app', 'Update Work Day: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Work Days'),
    'url' => UserUrl::setFilters(WorkDaySearch::class)
];
$this->params['breadcrumbs'][] = ['label' => Html::encode($model->id), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="work-day-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => false]) ?>

</div>
