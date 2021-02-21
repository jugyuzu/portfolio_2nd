<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>POSHOP</title>
        <link rel="stylesheet" href="./css/html5reset-1.6.1.css">
        <link rel="stylesheet" href="./css/main.css">
        <style type="text/css">
            content{
                width: 750px;
                margin: 20px 20px 0px 60px;
            }
            .new_product{
                padding-top: 10px;
                height: 700px;
            }
            .new_product p{
                text-align: center
            }
            #select_button{
                margin-top: 10px;
                text-align:center;
            }
            .item{
                margin: 20px;
                margin-right: 10px;
                display: inline-block;
                text-align: center;
            }
        </style>
        </head>
    <body>
        <div id="background">
            <div id="black">
                <header>
                    <div id=top_design>
                        <div id="top_logo">
                            <!-- ロゴ -->
                            <a href="./top.php">
                            <img src="./img/gisi.png" id="logo">
                            </a>
                        </div>
                    <!--検索-->
                    <!--アカウントロゴ-->
                        <div id="top_aicon">
                            <a href="./acaunt.php" class='rei'>
                                <img src="./img/aicon.png" id="aicon">
                                ゲストさん
                            </a>
                        <!--カート-->
                            <a href="./cart.php" class='rei'>
                                <img src="./img/cart.png" id="cart">
                                カートを見る
                            </a>
                            <a href="../../../controller/main.php" class='rei'>
                                homeへ
                            </a>
                        </div>
                    </div>
                </header>
                <main>
                    <!--メニューバー-->
                    <nav>
                        <ul><a href="./orthosis_list.php?id=orthosis">装具一覧</a>
                            <li><a href="./orthosis_list.php?id=arm">腕</a></li>
                            <li><a href="./orthosis_list.php?id=foot">足</a></li>
                            <li><a href="./orthosis_list.php?id=waist">腰</a></li>
                        </ul>
                        <ul><a href="./prothesis_list.php?id=prothesis">義肢一覧</a>
                            <li><a href="./prothesis_list.php?id=arm">腕</a></li>
                            <li><a href="./prothesis_list.php?id=foot">足</a></li>
                            <li><a href="./prothesis_list.php?id=cover">カバー</a></li>
                        </ul>
                    </nav>
                    <!--新着情報-->
                    <content id="top_product">
                        <div class='new_product'>
                            <p>義足部品一覧</p>
                            <!--並べ替えボタン-->
                            <div id="select_button">
                                <form method="post" action="./change_list_orthosis.php">
                                    <select name="select_time">
                                        <option value="new"<?php if($time === "new"){ print 'selected'; } ?>>新着順</option>
                                        <option value="price_up"<?php if($time === "up"){ print 'selected'; } ?>>価格順が高い順</option>
                                        <option value="price_down"<?php if($time === "down"){ print 'selected'; } ?>>価格順が安い順</option>
                                    </select>
                                    <select name="select_price">
                                        <option value="all" <?php if($price === "all"){ print 'selected'; } ?>>全ての価格</option>
                                        <option value="price10000" <?php if($price === "price10000"){ print 'selected'; } ?>>&#x301c;10000円</option>
                                        <option value="price50000" <?php if($price === "price50000"){ print 'selected'; } ?>>&#x301c;50000円</option>
                                        <option value="price100000"<?php if($price === "price100000"){ print 'selected'; } ?>>&#x301c;100000円</option>
                                    </select>
                                    <input type="submit"value="並べ替え">
                                </form>
                            </div>
                            <!--カートに同じ商品が入っていたらエラー文を表示-->
                            <p><?php if(empty($error) == FALSE){ foreach($error as $row){ print $row; }} ?></p>
                            <div id="item_list">
                            <!--prothesis_dataが入ってたら義肢の商品を表示、入っていなかったら該当する商品はありませんを表示-->
                                <?php if(empty($prothesis_data) === FALSE){foreach($prothesis_data as $row ) {?>
                                    <div class="item">
                                        <a href="<?php print $row['url']; ?>?id=<?php print $row['item_id']; ?>"  class='item_url'>
                                            <img src="<?php print $img_dir; ?>free.jpg" id=item_img>
                                            <p id="name"><?php print $row['name']; ?></p>
                                            <p id="price">&yen;<?php print $row['price']; ?></p>
                                        </a>
                                            <?php if($row['stock'] != 0) { ?>
                                                    <form method="post">
                                                        <input type="hidden" name="item_id" value="<?php print $row['item_id']; ?>">
                                                        <input type="submit" value="カートに入れる">
                                                    </form>
                                            <?php }else {
                                                        print '売り切れ' . "</br>";
                                                } ?>
                                    </div>
                                <?php } } else {?> <p>該当する商品はありません</p> <?php } ?>
                            </div>
                        </div>
                    </content>
                </main>
                <footer></footer>
            </div>
        </div>
    </body>
</html>
<!---->