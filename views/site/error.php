<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception$exception */

use yii\helpers\Html;

$this->title = $name;
?>
<!-- banner -->
<div class="banner">
    <?= $this->render('//layouts/inc/sidebar') ?> <!--подключаем меню сайта-->
    <div class="w3l_banner_nav_right">
        <div style="padding: 10px">
            <h2><?= Html::encode($this->title) ?></h2>
            <div class="alert alert-danger">
                <?='<h4>' . nl2br(Html::encode($message)) . '</h4>' ?>
            </div>
        </div>
        <!-- //flexSlider -->
    </div>
    <div class="clearfix"></div>
</div>
