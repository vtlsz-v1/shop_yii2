<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;

class CategoryController extends AppController
{
    public function actionView($id)
    { // $id - номер категории
        $category = Category::findOne($id); // получаем категорию по id
        if (empty($category)) { // если такой категории не существует
            throw new NotFoundHttpException('Такой категории нет !'); // выбрасываем исключение 404
        }

        // регистрируем мета-теги
        $this->setMeta("{$category->title} :: " . \yii::$app->name, $category->keywords, $category->description);

        // если категория существует, получаем относящиеся к ней продукты (всё выводится на одной странице)
        //$products = Product::find()->where(['category_id' => $id])->all();

        // организуем постраничную навигацию
        $query = Product::find()->where(['category_id' => $id]); // объект запроса
        // будем выводить по 4 товара на странице
        // totalCount - общее количество товаров в таблице
        // 'pageSizeParam' => false - убираем из адресной строки браузера параметр per-page
        // 'forcePageParam' => false - для первой страницы не будет показываться get-параметр
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 4, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('view', compact('products', 'category', 'pages')); // передаем в вид продукты и категории
        // (с использованием пагинации)
    }

    // поиск товара через поисковую форму
    public function actionSearch()
    {
        // получаем q из массива get (это значение атрибута name текстовой поисковой строки <input>, т.е. текст запроса)
        $q = trim(\yii::$app->request->get('q'));
        $this->setMeta("Поиск: {$q} :: " . \yii::$app->name); // устанавливаем title

        if (!$q) { // если в переменной q окажется пустая строка
            return $this->render('search'); // ничего не ищем и возвращаем представление search
        }

        // если переменная q не пуста, выполняем следующие действия:
        $query = Product::find()->where(['like', 'title', $q]); // используем оператор like, ищем товар $q по полю title
        // будем выводить по 4 товара на странице
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 4, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        // передаем в вид продукты, объект пагинации и введенный пользователем запрос
        return $this->render('search', compact('products', 'pages', 'q'));
    }

}