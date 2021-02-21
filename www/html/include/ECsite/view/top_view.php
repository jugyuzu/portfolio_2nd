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
                height: 210px;
                margin-bottom: 10px;
            }
            h5{
                padding-top:10px;
                padding-left: 10px;
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
                            <h5>新着装具</h5>
                            <div id="item_list">
                                <!--foreach$new_orthosis-->
                                <?php foreach($new_orthosis as $row) { ?>
                                    <div class="item">
                                        <a href="<?php print $row['url']; ?>?id=<?php print $row['item_id']; ?>" class='item_url'>
                                            <img src="<?php print $img_dir; ?>free.jpg" class="item_img">
                                            <p id="orthosis_name"><?php print $row['name']; ?></p>
                                        </a>
                                    </div>
                                <?php }?>
                            </div>
                            <a href="orthosis_list.php?id=orthosis">もっと見る</a>
                        </div>
                        <div class='new_product'>
                            <h5>新着義足部品</h5>
                            <div id="item_list">
                            <!--foreach$new_prothesis-->
                            <?php foreach($new_prothesis as $row) { ?>
                                <div class="item">
                                    <a href="<?php print $row['url']; ?>?id=<?php print $row['item_id']; ?>"  class='item_url'>
                                        <img src="<?php print $img_dir; ?>free.jpg" class="item_img">
                                        <p id="prothesis_name"><?php print $row['name']; ?></p>
                                    </a>
                                </div>
                            <?php }?>
                            </div>
                            <a href="./prothesis_list.php?id=prothesis">もっと見る</a>
                        </div>
                    </content>
                </main>
                <footer></footer>
                </div>
        </div>
    </body>
</html>
<!---->