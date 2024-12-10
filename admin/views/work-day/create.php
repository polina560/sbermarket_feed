<?php

use common\components\helpers\UserUrl;
use common\models\WorkDaySearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\WorkDay
 */

$this->title = Yii::t('app', 'Create Work Day');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Work Days'),
    'url' => UserUrl::setFilters(WorkDaySearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-day-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
