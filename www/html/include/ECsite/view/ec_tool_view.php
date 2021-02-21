<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>商品管理ページ</title>
        <link rel="stylesheet" href="./css/html5reset-1.6.1.css">
    </head>
    <style type="text/css">
        p{
            margin: 10px;
        }
        .comment_box{
            width: 400px;
        }
        table, tr, th, td {
                border: solid 1px;
            }
        #item_img{
            width: 80px;
            height: 80px;
        }
        #msg{
            min-height: 50px;
            padding-top: 19px;
            color:red;
        }
        table{
            text-align: center;
        }
        th{
            height: 40px;
            line-height: 40px;
        }
        td {
            text-align: center;
            vertical-align: middle;
        }
        .img{
            min-width: 90px;
        }
        .name{
            min-width: 80px;
        }
        .price{
            min-width: 100px;
        }
        .stock{
            min-width: 160px;
        }
        #stock_box{
            width: 50px;
        }
        .kind{
            min-width: 150px;
        }
        .status{
            min-width: 200px;
        }
        .part{
            min-width: 150px;
        }
        .url{
            min-width: 90px;
        }
        .comment{
            min-width: 400px;
        }
        #comment_box{
            width: 250px;
        }
        .delete{
            min-width: 80px;
        }
    </style>
    <body>
       <!--商品名、値段、在庫数、ステータス、画像、義足か装具かを入力-->
       <form method="POST" enctype="multipart/form-data">
           <p>商品名:<input type="text" name="name"></p>
           <p>値段:<input type="text" name="price"></p>
           <p>在庫数:<input type="text" name="stock"></p>
           <p>義肢装具:<select name="po">
               <option value="0">装具</option>
               <option value="1">義肢</option>
               </select>
           </p>
           <p>部位:
               <input type="radio" name="part" value="arm" checked>腕
               <input type="radio" name="part" value="foot">足
               <input type="radio" name="part" value="waist">腰
               <input type="radio" name="part" value="cover">カバー
           </p>
           <p>ステータス:
               <select name="status">
               <option value="0">非公開</option>
               <option value="1">公開</option>
               </select>
           </p>
           <p>画像:<input type="file" name="item_img"></p>
           <p>コメント:<input type="text" name="comment" placeholder="コメントは200文字までです。" class="comment_box"></p>
           <p><input type="submit" name ="submit" value="登録する"></p>
       </form>
       <div id="msg">
           <!--一覧で表示-->
           <?php if(empty($error) !== TRUE){
               foreach($error as $row){
                   print $row . "<br>";
               }
            }
            if(empty($msg) !== TRUE){
                   foreach($msg as $row){
                       print $row . "<br>";
                   }
            }?>
        </div>   
       <table>
           <tr>
               <th class="img">画像</th>
               <th class="name">名前</th>
               <th class="price">値段</th>
               <th class="stock">在庫</th>
               <th class="kind">種類</th>
               <th class="status">ステータス</th>
               <th class="part">部位</th>
               <th class="url">商品ページ</th>
               <th class="comment">コメント</th>
               <th class="delete">削除</th>
           </tr>
               <?php foreach ($data as $value) { ?> 
           <tr>
               <!--画像-->
               <td class="img"><img src="<?php print $img_dir . $value['img']; ?>" id="item_img"></td>
               <!--商品名-->
               <td class="name"><?php print $value['name']; ?></td>
               <!--値段-->
               <td class="price"><?php print $value['price']; ?>円</td>
               <!--在庫数変更ボタン-->
               <td class="stock">
                   <form method="post" action="./change_stock.php">
                       <input type="hidden" name="item_id" value="<?php print $value['item_id']?>">
                       <input type="text" name="stock_change" value="<?php print $value['stock'] ?>" id="stock_box" >
                       <input type="submit" name="submit" value="在庫変更">
                   </form>
               </td>
               <!--義肢装具変更ボタン-->
               <td class="kind">
                   <form method="post" action="./change_po.php">
                       <input type="hidden" name="item_id" value="<?php print $value['item_id']?>">
                       <select name="po_change" id="po">
                               <option value="0" <?php if($value['po'] == 0){ print 'selected'; }?>>装具</option>
                               <option value="1" <?php if($value['po'] == 1){ print 'selected'; }?>>義肢</option>
                       </select>
                       <input type="submit" name="submit" value="種類変更">
                   </form>
               </td>
               <!--ステータス-->
               <td class="status">
                   <form method="post" action="./change_status.php">
                       <input type="hidden" name="item_id" value="<?php print $value['item_id']?>">
                       <select name="status_change" id="status">
                               <option value="0" <?php if($value['status'] == 0){ print 'selected'; } ?>>非公開</option>
                               <option value="1" <?php if($value['status'] == 1){ print 'selected'; } ?>>公開</option>
                       </select>
                       <input type="submit" name="submit" value="ステータス変更">
                   </form>
               </td>
               <!--部位-->
               <td class="part">
                   <form method="post" action="./change_part.php">
                       <input type="hidden" name="item_id" value="<?php print $value['item_id']?>">
                       <select name="part_change" id="part">
                           <?php
                                $parts = ['arm'=>'腕','foot'=>'足','waist'=>'腰','cover'=>'カバー'];
                                foreach($parts as $key => $part){
                            ?>
                                <option value='<?php print $key;?>' <?php if($value['part']===$key){print 'selected';} ?>><?php print $part; ?></option>
                            <?php
                                }
                           ?>
                       </select>
                       <input type="submit" name="submit" value="部位変更">
                   </form>
               </td>
               <!--商品ページ-->
               <td class="url">
                   <a href="<?php print $value['url']; ?>?id=<?php print $value['item_id'] ?>">ページへ</a>
               </td>
               <!--コメント-->
               <td class="comment">
                   <form method="post" action="./change_comment.php">
                       <input type="hidden" name="item_id" value="<?php print $value['item_id']?>">
                       <input type="text" name="comment" value="<?php print $value['comment']?>" id="comment_box">
                       <input type="submit" value="コメント変更">
                   </form>
               </td>
               <td class="delete">
                   <form method="post" action="./delete_tool.php">
                       <input type="hidden" name="item_id" value="<?php print $value['item_id']?>">
                       <input type="submit" value="削除する">
                   </form>
               </td>
              <?php } ?>
           </tr>
           <?php?>
       </table>
    </body>
</html>