<?php

namespace app\controllers;

use app\models\Product;
use yii\web\NotFoundHttpException;

class ProductController extends AppController
{
    public function actionView($id) // параметр - id продукта
    {
        $product = Product::findOne($id); // получаем продукт по его id
        if (empty($product)) { // если такого продукта нет
            throw new NotFoundHttpException('Такого продукта нет!'); // выбрасываем исключение 404
        }

        // регистрируем мета-теги
        $this->setMeta("{$product->title} :: " . \yii::$app->name, $product->keywords, $product->description);

        return $this->render('view', compact('product')); // передаем $product в вид
    }
}