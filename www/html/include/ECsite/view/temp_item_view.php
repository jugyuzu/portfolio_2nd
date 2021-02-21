<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title><?php print $item_data[0]['name']; ?></title>
        <link rel="stylesheet" href="../controller/css/html5reset-1.6.1.css">
        <link rel="stylesheet" href="../controller/css/main.css">
        <style type="text/css">
            content{
                margin: 20px 20px 0px 60px;
            }
            h5{
                padding-top:10px;
                text-align: center;
            }
            .new_product{
                height: 500px;
                width: 750px;
                font-size: 30px;
            }
            #items{
                display: flex;
                position: relative;
            }
            #item_img_name{
                margin: 20px;
                text-align: center;
            }
            #item_price_button{
                margin-top: 20px;
                margin-bottom: 20px;
                position: absolute;top: 80px;right: 20px;
            }
            #item_msg{
                height: 30px;
                width: 400px;
                position: absolute;right: 20px;top: 200px;
                font-size: 20px;
            }
            #item_img{
                height: 250px;
                width: 250px;
            }
            #item_comment{
                margin: 20px;
            }
            #button{
                margin-top: 10px;
                display: flex;
            }
            .button {
                  display       : inline-block;
                  border-radius : 40%;      
                  font-size     : 20px;    
                  text-align    : center;     
                  cursor        : pointer;     
                  padding       : 3px 10px;   
                  background    : #ff7f7f;    
                  color         : rgba(255, 255, 26, 0.93);
                  line-height   : 1em;         
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
                            <a href="../controller/top.php">
                            <img src="../controller/img/gisi.png" id="logo">
                            </a>
                        </div>
                        <!--検索-->
                        <!--アカウントロゴ-->
                        <div id="top_aicon">
                            <a href="../controller/acaunt.php" class='rei'>
                                <img src="../controller/img/aicon.png" id="aicon">
                                ゲストさん
                            </a>
                        <!--カート-->
                            <a href="../controller/cart.php" class='rei'>
                                <img src="../controller/img/cart.png" id="cart">
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
                        <ul><a href="../controller/orthosis_list.php?id=orthosis">装具一覧</a>
                            <li><a href="../controller/orthosis_list.php?id=arm">腕</a></li>
                            <li><a href="../controller/orthosis_list.php?id=foot">足</a></li>
                            <li><a href="../controller/orthosis_list.php?id=waist">腰</a></li>
                        </ul>
                        <ul><a href="../controller/prothesis_list.php?id=prothesis">義肢一覧</a>
                            <li><a href="../controller/prothesis_list.php?id=arm">腕</a></li>
                            <li><a href="../controller/prothesis_list.php?id=foot">足</a></li>
                            <li><a href="../controller/prothesis_list.php?id=cover">カバー</a></li>
                        </ul>
                    </nav>
                    <!--アカウント情報-->
                    <content id="top_product">
                        <div class='new_product'>
                            <div id="items">
                                <div id="item_img_name">
                                    <img src="../controller/img/free.jpg" id="item_img">
                                    <p><?php print $item_data[0]['name']?></p>
                                </div>
                                <!--画像と値段などのボタんで半分に-->
                                <div id="item_price_button">
                                    <p id="item_chra">&yen;<?php print $item_data[0]['price']; ?></p>
                                    <div id="button">
                                        <?php if($item_data[0]['stock'] == 0) {?>
                                                <p>在庫切</p>
                                        <?php }else{ ?>
                                                <p>
                                                    <form method="post">
                                                        <input type="hidden" name="item_id" value="<?php print $item_data[0]['item_id']; ?>">
                                                        <input type="hidden" name="button" value="cart">
                                                        <input type="submit" name="submit" value="カートに入れる" class="button">
                                                    </form>
                                                </p>
                                        <?php } ?>
                                        <p>
                                            <form method="post">
                                                <input type="hidden" name="item_id" value="<?php print $item_data[0]['item_id']; ?>">
                                                <input type="hidden" name="button" value="like">
                                                <input type="submit" name="submit " value="&#9733;気になる" class="button">
                                            </form>
                                        </p>
                                    </div>
                                </div>
                                <div id="item_msg">
                                    <?php if(empty($error) != TRUE){
                                    //foreach($error as $row){ ?>
                                        <p><?php print $error[0]; ?></p>
                                <?php 
                                } ?>
                                </div>
                            </div>
                            <div id="item_comment">
                                <p><?php print $item_data[0]['comment'] ?></p>
                            </div>
                        </div>
                    </content>
                </main>
                <footer></footer>
            </div>
        </div>
    </body>
</html