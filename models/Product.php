<?php

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'product'; // модель связана с таблицей product
    }

    public function getCategory() // получение категории товара
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']); // один товар будет принадлежать только к одной категории
    }
}