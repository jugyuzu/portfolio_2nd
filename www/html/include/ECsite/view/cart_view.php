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
                margin-bottom: 10px;
                position: relative;
                height: 700px;
                overflow: auto;
            }
            h5{
                padding-top:10px;
                padding-left: 10px;
            }
            #sum{
                position: absolute;top: 30px;right: 180px;
                font-size: 20px;
            }
            #buy_button{
                position: absolute;top: 30px;right: 10px;
                font-size: 20px;
            }
            .item{
                margin-top: 50px;
                display: flex;
                position: relative;
            }
            .item_main{
                display: flex;
                position: relative;
            }
            .item_button{
                position: absolute; bottom: 0;right: 0;
                display: flex;
            }
            .item_name{
                font-size: 25px;
            }
            .item_price{
                position: absolute; bottom: 0; left: 180px;
                font-size: 25px;
            }
            #erro_msg{
                position: absolute;top: 30px;left: 10px;
                color: rgba(255, 255, 26, 0.93);
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
                    <!--アカウント情報-->
                    <content id="top_product">
                        <div class='new_product'>
                            <h5>カートの中身</h5>
                            <!--foreach$cart_data-->
                            <p id="sum">合計:<?php print $sum; ?>円</p>
                            <!--購入する場合-->
                            <form method="POST" id="buy_button">
                                <input type="hidden" name="buy" value="final">
                                <input type="submit" name="submit" value="購入する">
                            </form>
                            <div id="item_list">
                                <?php if(empty($cart_data) != TRUE){foreach($cart_data as $row ){?>
                                    <div class="item">
                                        <a href="<?php print $row['url']; ?>?id=<?php print $row['item_id']; ?>"  class="item_url">
                                                <img src="<?php print $img_dir; ?>free.jpg" class="item_img">
                                            <div id="item_main">
                                                <p class="item_name"><?php print $row['name']; ?></p>
                                                <p class="item_price">&yen;<?php print $row['price']; ?></p>
                                            </div>
                                        </a>
                                        <!--数量変更ボタン-->
                                        <div class="item_button">
                                            <div class="item_amount">
                                                <form method="POST" action="./change_order.php">
                                                    <input type="number" name="amount" value="<?php print $row['amount']; ?>" max="<?php print $row['stock']; ?>" min="1">
                                                    <input type="hidden" name="cart_id" value="<?php print $row['id']; ?>">
                                                    <input type="hidden" name="item_id" value="<?php print $row['item_id']; ?>">
                                                    <input type="submit" name="submit" value="数量変更">
                                                </form>
                                            </div>
                                            <!--削除ボタン-->
                                            <div id="item_delete">
                                                <form method="POST" action="./delete_order.php">
                                                    <input type="hidden" name="cart_id" value="<?php print $row['id']; ?>">
                                                    <input type="hidden" name="item_id" value="<?php print $row['item_id']; ?>">
                                                    <input type="submit" value="削除">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php }  ?>
                            </div>
                            <p id="erro_msg"><?php if(empty($error) != TRUE){ foreach($error as $row){ print $row . "</br>";} }?>
                            </p>
                                    </p><?php }else{ ?> <p>カートに商品が入っていません</p> <?php } ?>
                        </div>
                    </content>
                </main>
                <footer></footer>
            </div>
        </div>
    </body>
</html>
<!---->