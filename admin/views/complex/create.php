<?php

use common\components\helpers\UserUrl;
use common\models\ComplexSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Complex
 */

$this->title = Yii::t('app', 'Create Complex');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Complexes'),
    'url' => UserUrl::setFilters(ComplexSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="complex-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
