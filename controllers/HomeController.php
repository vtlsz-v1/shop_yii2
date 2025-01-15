<?php

namespace app\controllers;

use app\models\Product;

class HomeController extends AppController
{
    public function actionIndex()
    {
        // $offers - специальные предложения (товары со скидкой; для них поле is_offer в таблице имеет значение 1
        $offers = Product::find()->where(['is_offer' => 1])->limit(4)->all(); // выводим 4 товара
        /*debug($offers);*/

        return $this->render('index', compact('offers')); // передаем товары в вид index
    }
}