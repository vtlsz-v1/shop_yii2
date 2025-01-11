<?php

namespace app\components;

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
        return $this->tpl; // возвращаем шаблон для меню
    }
}