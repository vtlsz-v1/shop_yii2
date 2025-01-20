<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use yii\web\NotFoundHttpException;

class CategoryController extends AppController
{
    public function actionView($id) { // $id - номер категории
        $category = Category::findOne($id); // получаем категорию по id
        if(empty($category)) { // если такой категории не существует
            throw new NotFoundHttpException('Такой категории нет !'); // выбрасываем исключение 404
        }

        // регистрируем мета-теги
        $this->setMeta("{$category->title} :: " . \yii::$app->name, $category->keywords, $category->description);

        // если категория существует, получаем относящиеся к ней продукты
        $products = Product::find()->where(['category_id' => $id])->all();

        return $this->render('view', compact('products', 'category')); // передаем в вид продукты и категории
    }
}