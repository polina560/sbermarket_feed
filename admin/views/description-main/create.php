<?php

use common\components\helpers\UserUrl;
use common\models\DescriptionMainSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\DescriptionMain
 */

$this->title = Yii::t('app', 'Create Description Main');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Description Mains'),
    'url' => UserUrl::setFilters(DescriptionMainSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="description-main-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
