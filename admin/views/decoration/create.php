<?php

use common\components\helpers\UserUrl;
use common\models\DecorationSearch;
use yii\bootstrap5\Html;

/**
 * @var $this  yii\web\View
 * @var $model common\models\Decoration
 */

$this->title = Yii::t('app', 'Create Decoration');
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('app', 'Decorations'),
    'url' => UserUrl::setFilters(DecorationSearch::class)
];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="decoration-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', ['model' => $model, 'isCreate' => true]) ?>

</div>
