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
            h5{
                padding-top:10px;
                text-align: center;
                margin-bottom: 40px;
            }
            .new_product{
                height: 700px;
                text-align: center;
                
            }
            .new_product p{
                text-align: center
            }
            
            .item{
                width: 120px;
                margin-top: 20px;
                margin-bottom: 20px;
                display: inline-block;
                text-align: center;
            }
            #page_button{
                width: 300px;
                margin: 0 auto;
                margin-top: 20px;
                font-size: 20px;
                text-align:center;
                display: flex;
                position: relative;
            }
            
            #front_button{
                /*
                background: url(./img/left.png);
                background-size: 30px;
                background-repeat: no-repeat;
                background-position: left;
                */
            }
            #next_button{
                /*
                padding-left: 0;
                width: 200px;
                background: url(./img/left.png);
                background-size: 30px;
                background-repeat: no-repeat;
                background-position: right;
                */
                position: absolute;right:0;
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
                            <h5>購入履歴一覧</h5>
                            <div id="item_list">
                                <!--prothesis_dataが入ってたら義肢の商品を表示、入っていなかったら該当する商品はありませんを表示-->
                                <?php foreach($history_data as $row) { ?>
                                    <div class="item">
                                        <a href="./log_item.php?id=<?php print $row['log_id']; ?>"  class='item_url'>
                                            <img src="<?php print $img_dir; ?>free.jpg" class="item_img">
                                            <p id="prothesis_name"><?php print $row['create_datetime']; ?></p>
                                        </a>
                                    </div>
                                <?php } ?>
                            </div>
                            <div id="page_button">
                                <?php if($front !== "none") { ?><a href="./front.php?id=<?php print $front ?>" id="front_button">前のページ: </a><?php } ?>
                                <?php if($next !== "none") { ?><a href="./next.php?id=<?php print $next ?>" id="next_button"> :次のページ</a><?php } ?>
                            </div>
                        </div>
                    </content>
                </main>
                <footer></footer>
            </div>
        </div>
    </body>
</html>