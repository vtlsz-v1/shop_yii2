<!-- products-breadcrumb -->
<div class="products-breadcrumb"> <!--"хлебные крошки"-->
    <div class="container">
        <ul>
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="<?= \yii\helpers\Url::home() ?>">Главная</a><span>|</span></li>
            <li> <!--выводим категорию выбранного продукта (используя связь между таблицами getCategory()) и его наименование-->
                <a href="<?= \yii\helpers\Url::to(['category/view', 'id' => $product->category->id]) ?>"><?= $product->category->title ?></a>
                <span>|</span>
                <!--то же самое можно сделать с помощью хелпера Html-->
                <?php /*= \yii\helpers\Html::a($product->category->title, ['category/view', 'id' => $product->category->id]) */?><!--
                <span>|</span>-->
            </li>
            <li><?= $product->title; ?></li> <!--название товара-->
        </ul>
    </div>
</div>
<!-- //products-breadcrumb -->
<!-- banner -->
<div class="banner">
    <?= $this->render('//layouts/inc/sidebar') ?> <!--подключаем меню сайта-->
    <div class="w3l_banner_nav_right">
        <div class="w3l_banner_nav_right_banner3">
            <h3>Best Deals For New Products<span class="blink_me"></span></h3>
        </div>
        <div class="agileinfo_single">
            <h5><?= $product->title ?></h5> <!--название продукта-->
            <div class="col-md-4 agileinfo_single_left">
                <!--выводим изображение продукта с помощью хелпера Html-->
                <!--img - изображение товара в таблице БД, title - его наименование -->
                <!--'id' => 'example' - id изображения-->
                <?= \yii\helpers\Html::img("@web/products/{$product->img}", ['alt' => $product->title, 'id' => 'example']) ?>
            </div>
            <div class="col-md-8 agileinfo_single_right">
                <div class="rating1">
						<span class="starRating">
							<input id="rating5" type="radio" name="rating" value="5">
							<label for="rating5">5</label>
							<input id="rating4" type="radio" name="rating" value="4">
							<label for="rating4">4</label>
							<input id="rating3" type="radio" name="rating" value="3" checked>
							<label for="rating3">3</label>
							<input id="rating2" type="radio" name="rating" value="2">
							<label for="rating2">2</label>
							<input id="rating1" type="radio" name="rating" value="1">
							<label for="rating1">1</label>
						</span>
                </div>
                <div class="w3agile_description">
                    <h4>Описание : </h4>
                    <?= $product->content ?>
                </div>
                <div class="snipcart-item block">
                    <div class="snipcart-thumb agileinfo_single_right_snipcart">
                        <h4>
                            $<?= $product->price ?> <!--актуальная цена товара-->
                            <?php if((float)$product->old_price) : ?> <!--старая цена товара (выводим только если она установлена)-->
                                <span>$<?= $product->old_price ?></span>
                            <?php endif; ?>
                        </h4>
                    </div>
                    <div class="snipcart-details agileinfo_single_right_details">
                        <form action="#" method="post">
                            <fieldset>
                                <input type="hidden" name="cmd" value="_cart" />
                                <input type="hidden" name="add" value="1" />
                                <input type="hidden" name="business" value=" " />
                                <input type="hidden" name="item_name" value="pulao basmati rice" />
                                <input type="hidden" name="amount" value="21.00" />
                                <input type="hidden" name="discount_amount" value="1.00" />
                                <input type="hidden" name="currency_code" value="USD" />
                                <input type="hidden" name="return" value=" " />
                                <input type="hidden" name="cancel_return" value=" " />
                                <input type="submit" name="submit" value="Add to cart" class="button" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<!-- //banner -->
