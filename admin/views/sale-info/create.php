<?php

use common\components\helpers\UserUrl;
use common\models\SaleInfoSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\SaleInfo
 */

$this->title = Yii::t('app', 'Create Sale Info');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Sale Infos'),
    'url' => UserUrl::setFilters(SaleInfoSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
