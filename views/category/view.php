<!-- products-breadcrumb -->
<div class="products-breadcrumb">
    <div class="container">
        <ul> <!--"хлебные крошки"-->
            <!--ссылка на главную страницу-->
            <li><i class="fa fa-home" aria-hidden="true"></i><a href="<?= \yii\helpers\url::home() ?>">Главная</a><span>|</span></li>
            <li><?= $category->title ?></li> <!--название выбранной категории-->
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
        <div class="w3l_banner_nav_right_banner3_btm">
            <div class="col-md-4 w3l_banner_nav_right_banner3_btml">
                <div class="view view-tenth">
                    <img src="images/13.jpg" alt=" " class="img-responsive" />
                    <div class="mask">
                        <h4>Grocery Store</h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
                    </div>
                </div>
                <h4>Utensils</h4>
                <ol>
                    <li>sunt in culpa qui officia</li>
                    <li>commodo consequat</li>
                    <li>sed do eiusmod tempor incididunt</li>
                </ol>
            </div>
            <div class="col-md-4 w3l_banner_nav_right_banner3_btml">
                <div class="view view-tenth">
                    <img src="images/14.jpg" alt=" " class="img-responsive" />
                    <div class="mask">
                        <h4>Grocery Store</h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
                    </div>
                </div>
                <h4>Hair Care</h4>
                <ol>
                    <li>enim ipsam voluptatem officia</li>
                    <li>tempora incidunt ut labore et</li>
                    <li>vel eum iure reprehenderit</li>
                </ol>
            </div>
            <div class="col-md-4 w3l_banner_nav_right_banner3_btml">
                <div class="view view-tenth">
                    <img src="images/15.jpg" alt=" " class="img-responsive" />
                    <div class="mask">
                        <h4>Grocery Store</h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
                    </div>
                </div>
                <h4>Cookies</h4>
                <ol>
                    <li>dolorem eum fugiat voluptas</li>
                    <li>ut aliquid ex ea commodi</li>
                    <li>magnam aliquam quaerat</li>
                </ol>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="w3ls_w3l_banner_nav_right_grid">
            <h3><?= $category->title ?></h3>
            <?php if(!empty($products)) : ?> <!--если выбранная категория не пустая-->
            <div class="w3ls_w3l_banner_nav_right_grid1">
            <!--выводим все относящиеся к этой категории товары-->
            <?php foreach($products as $product) : ?>
                <div class="col-md-3 w3ls_w3l_banner_left">
                    <div class="hover14 column">
                        <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                <?php if($product->is_offer) : ?> <!--если товар является предложением (т.е. если поле is_offer в таблице равно 1)-->
                        <div class="agile_top_brand_left_grid_pos">
                            <!--выводим изображения с помощью хелпера Html-->
                            <?= \yii\helpers\html::img('@web/images/offer.png', ['alt' => 'offer', 'class' => 'img-responsive']) ?>
                        </div>
               <?php endif; ?>
                                <div class="agile_top_brand_left_grid1">
                                    <figure>
                                        <div class="snipcart-item block">
                                            <div class="snipcart-thumb">
                                                <!--ссылка на товар-->
                                                <a href="<?= \yii\helpers\url::to(['product/view', 'id' => $product->id]) ?>">
                                                    <!--выводим изображения с помощью хелпера Html-->
                                                    <!--img - изображение товара в таблице БД, title - его наименование -->
                                                    <?= \yii\helpers\html::img("@web/products/{$product->img}", ['alt' => $product->title]) ?>
                                                </a>
                                                <p><?= $product->title ?></p>
                                                <h4>
                                                    $<?= $product->price ?> <!--актуальная цена товара-->
                                                    <?php if((float)$product->old_price) : ?> <!--старая цена товара (выводим только если она установлена)-->
                                                        <span>$<?= $product->old_price ?></span>
                                                    <?php endif; ?>
                                                </h4>
                                            </div>
                                            <div class="snipcart-details">
                                                <form action="#" method="post">
                                                    <fieldset>
                                                        <input type="hidden" name="cmd" value="_cart" />
                                                        <input type="hidden" name="add" value="1" />
                                                        <input type="hidden" name="business" value=" " />
                                                        <input type="hidden" name="item_name" value="knorr instant soup" />
                                                        <input type="hidden" name="amount" value="3.00" />
                                                        <input type="hidden" name="discount_amount" value="1.00" />
                                                        <input type="hidden" name="currency_code" value="USD" />
                                                        <input type="hidden" name="return" value=" " />
                                                        <input type="hidden" name="cancel_return" value=" " />
                                                        <input type="submit" name="submit" value="Add to cart" class="button" />
                                                    </fieldset>
                                                </form>
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                    <div class="clearfix"> </div>
            </div>
            <?php else: ?> <!--если товаров в данной категории нет-->
            <div class="w3ls_w3l_banner_nav_right_grid1">
                <h6>Здесь пока нет товаров...</h6>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<!-- //banner -->