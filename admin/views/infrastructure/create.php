<?php

use common\components\helpers\UserUrl;
use common\models\InfrastructureSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Infrastructure
 */

$this->title = Yii::t('app', 'Create Infrastructure');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Infrastructures'),
    'url' => UserUrl::setFilters(InfrastructureSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="infrastructure-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
