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
                height: 250px;
                margin-bottom: 10px;
            }
            h5{
                padding-top:10px;
                padding-left: 10px;
            }
            .item{
                width: 108px;
                margin-right: 10px;
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
                    <h5>気になる商品</h5>
                    <!--foreach$curious_item-->
                    <div id="item-list">
                        <?php if(empty($curious_item) == FALSE){foreach($curious_item as $row) { ?>
                            <div class="item">
                                <a href="<?php print $row['url']; ?>?id=<?php print $row['item_id']; ?>" class='item_url'>
                                    <img src="<?php print $img_dir; ?>free.jpg" class="item_img">
                                    <p id="orthosis_name"><?php print $row['name']; ?></p>
                                    
                                </a>
                                <form method="post">
                                    <input type="hidden" name="item_id" value="<?php print $row['item_id']; ?>">
                                    <input type="submit" name="submit" value="カートに入れる">
                                </form>
                                <form method="post" action="./delte_curious.php">
                                    <input type="hidden" name="item_id" value="<?php print $row['item_id']; ?>">
                                    <input type="submit" value="削除する">
                                </form>
                            </div>
                        <?php }}else{?> <p>気になる商品はありません</p> <?php } ?>
                    </div>
                </div>
                <div class='new_product'>
                    <h5>購入履歴</h5>
                    <!--foreach$new_prothesis-->
                    <div id="item_list">
                        <?php if(empty($history_item) == FALSE){foreach($history_item as $row) { ?>
                            <div class="item">
                                <a href="./log_item.php?id=<?php print $row['log_id']; ?>"  class='item_url'>
                                    <img src="<?php print $img_dir; ?>free.jpg" class="item_img">
                                    <p id="prothesis_name"><?php print $row['create_datetime']; ?></p>
                                </a>
                            </div>
                        <?php }}else{?> <p>購入した商品はありません</p> <?php } ?>
                    </div>
                    <a href="./history_data.php">もっと見る</a>
                </div>
            </content>
        </main>
        <footer></footer>
        </div>
        </div>
    </body>
</html>
<!---->