<?php

use common\components\helpers\UserUrl;
use common\models\BuildingSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Building
 */

$this->title = Yii::t('app', 'Create Building');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Buildings'),
    'url' => UserUrl::setFilters(BuildingSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
