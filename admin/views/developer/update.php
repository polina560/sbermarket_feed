<?php

use common\components\helpers\UserUrl;
use common\models\DeveloperSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Developer
 */

$this->title = Yii::t('app', 'Update Developer: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Developers'),
    'url' => UserUrl::setFilters(DeveloperSearch::class)
];
$this->params['breadcrumbs'][] = ['label' => Html::encode($model->name), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="developer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => false]) ?>

</div>
