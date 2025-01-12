<?php

namespace app\components;

use app\models\Category;
use yii\base\Widget;

class MenuWidget extends Widget
{
    public $tpl; // понадобится для работы виджета более чем с одним шаблоном (для пользователей и админа)
    public $ul_class; // присвоение css-класса для меню
    public $data; // массив категорий товаров
    public $tree; // формирование дерева из массива категорий
    public $menu_Html; // готовая верстка меню, возвращаемого методом run()

    public function init()
    {
        parent::init();
        if($this->ul_class=== null) { // если ul_class не передан
            $this->ul_class = 'menu'; // присваиваем ему значение 'menu'
        }
        if($this->tpl === null) { // если свойство tpl не передано
            $this->tpl = 'menu'; // устанавливаем 'menu' в качестве значения по умолчанию для шаблона
        }
        $this->tpl .= '.php'; // добавляем расширение php
    }

    public function run()
    {
        // для экономии ресурсов целесообразно использовать кэширование
        // получаем данные из кэша
        $menu = \yii::$app->cache->get('menu'); // данные будут храниться по ключу menu
        if($menu) {
            return $menu; // возвращаем данные, если они получены из кэша
        }

        // если данные из кэша не получены, будет выполнен приведенный ниже код
        // получаем перечень всех категорий (в виде массива), при этом благодаря методу indexBy() ключи массива будут совпадать с id
        // берем только столбцы id, parent_id, title
        $this->data = Category::find()->select('id, parent_id, title')->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree(); // строим дерево
        $this->menu_Html = '<ul class = "' . $this->ul_class . '">';
        $this->menu_Html .= $this->getMenuHtml($this->tree); // формируем верстку меню
        $this->menu_Html .= '</ul>';
        /*debug($this->data);*/
        // кэшируем данные после выполнения вышестоящих пяти строк кода
        \yii::$app->cache->set('menu', $this->menu_Html, 60); // кэшируем по ключу menu данные $this->menu_Html на 60 секунд

        return $this->menu_Html; // возвращаем верстку для меню
    }

    protected function getTree(){ // возвращает дерево, формируемое из массива
        $tree = [];
        foreach ($this->data as $id=>&$node) { // проходимся по категориям и берем ключ и значение
            if (!$node['parent_id']) // если parent_id равно нулю, то это самостоятельная категория
                $tree[$id] = &$node; // этот потомок вкладывается в соответствующий элемент массива
            else // иначе это потомок (т.е. нужно обратиться к родительскому эл-ту, создать children  и сохранить в нем узел $node)
                $this->data[$node['parent_id']]['children'][$node['id']] = &$node;
        }
        return $tree;
    }

    protected function getMenuHtml($tree){
        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category); // это метод вызывается для каждой категории из дерева
        }
        return $str;
    }

    protected function catToTemplate($category){
        ob_start(); // после получения данным методом категории включается буферизация (чтобы не выводить данные на экран)
        include __DIR__ . '/menu_tpl/' . $this->tpl; // подключение шаблона (в нем содержится верстка для каждой категории)
        return ob_get_clean(); // возвращение категории из буфера без вывода на экран
    }
}