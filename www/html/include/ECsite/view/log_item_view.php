<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>購入</title>
        <link rel="stylesheet" href="./css/html5reset-1.6.1.css">
        <link rel="stylesheet" href="./css/main.css">
        <style type="text/css">
            content{
                width: 750px;
                margin: 20px 20px 0px 60px;
            }
            .new_product{
                margin-bottom: 10px;
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
                            <div id="item_list">
                                <?php foreach($item_data as $row){ ?>
                                    <div class="item">
                                        <a href="<?php print $row['url']; ?>?id=<?php print $row['item_id']; ?>"  class='item_url'>
                                            <img src="<?php print $img_dir. $row['img']; ?>" class="item_img">
                                            <p id="item_name"><?php print $row['name']; ?></p>
                                            <p id="item_price"><?php print $row['price']; ?></p>
                                            <p id="item_amount"><?php print $row['amount']?>個</p>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </content>
                </main>
                <footer></footer>
            </div>
        </div>
    </body>
</html>