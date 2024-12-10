<?php

use common\components\helpers\UserUrl;
use common\models\ProfitMainSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\ProfitMain
 */

$this->title = Yii::t('app', 'Create Profit Main');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Profit Mains'),
    'url' => UserUrl::setFilters(ProfitMainSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profit-main-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
