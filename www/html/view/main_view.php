<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../view/css/html5reset-1.6.1 (2).css">
  <!-- <link rel="stylesheet" type="text/css" href="../view/css/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="../view/css/slick/slick.css"> -->
  
  
  <style type="text/css">
    body{
      background-color: #F5F5F5; 
      font-family:"ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "メイリオ", Meiryo, Osaka, "ＭＳ Ｐゴシック", "MS PGothic", sans-serif;
      color:#630;
      line-height:40px;
      font-size:20px;
    }
    header{
      /* background-color: #556B2F; */
      min-width: 1150px;
      height:300px;
      border: solid 1px black;
      /* overflow: visible; */
      /* background-image: url("../view/css/art.jpg"); */
    }
    .greeting,.portfolio,.prof,.home{
      margin:0 20px;
      font-family:"ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro", "メイリオ", Meiryo, Osaka, "ＭＳ Ｐゴシック", "MS PGothic", sans-serif;
      font-size: 30px;
    }
    
    #main{
      margin-top: 10px;
      display:flex;
    }
    nav{
      /* background-color: #556B2F;
      color: #FFD700; */
      min-width: 260px;
      margin-left: 20px;
      height: 500px;
      position:relative
    }
    #container{
      min-width: 800px;
      margin:10px 0px 10px 40px;
      min-height:1000px;
      background-image: url('../view/css/note5.svg');
      background-repeat: no-repeat;
      position: relative;
    }
    button{
      border: none;
      outline: none;
      background: transparent;
      cursor: pointer;
    }
    .temp{
      display:inline-block;
      margin-top: 20px;
    }
    .template_style{
      width:500px;
      position: absolute;
      top : 60px;
      left: 80px; 
      text-indent: 1em;
      
    }
    .template_style span{
      opacity: 0;
      -webkit-transition: .6s ease-in-out;
      transition: .6s ease-in-out;
    }
    /* .template_style:hover{
      opacity: 1;
    } */
    #slide{
      min-width: 1150px;
      height:300px;
    }
    .img{
      width:100%;
      height:100%;
      object-fit:cover;
      display: none;
    }
    .img:first-child{
      display:inline;
    }
</style>
</head>
<body>
  <header>
    <div id="slide">
      <img src="../view/css/art.jpg" alt="img01" class="img">
      <img src="../view/css/bike.jpg" alt="img02"  class="img">
      <img src="../view/css/morning.jpg" alt="img03" class="img">
      <img src="../view/css/temple.jpg" alt="img04" class="img">
    </div>
        <!-- <ul class="slider">
          <li><img src="../view/css/art.jpg" alt="img01"></li>
          <li><img src="../view/css/bike.jpg" alt="img02"></li>
          <li><img src="../view/css/morning.jpg" alt="img03"></li>
          <li><img src="../view/css/temple.jpg" alt="img04"></li>
        </ul> -->
        <!-- <div><img src="../view/css/art.jpg" alt="img01"></div>
        <div><img src="../view/css/bike.jpg" alt="img02"></div>
        <div><img src="../view/css/morning.jpg" alt="img03"></div>
        <div><img src="../view/css/temple.jpg" alt="img04"></div> -->
      
    
      <!-- <div><button class="greeting" onclick="active_template('g_template')">初めに</button></div>
      <div><button class="portfolio" onclick="active_template('port_template')">ポートフォリオ</button></div>
      <div><button class="prof" onclick="active_template('prof_template')">自己紹介</button></div>
      <div><button class="home" onclick="change_note()">home</button></div> -->
  </header>
  <div id="main">
    <nav id="navi">
      <ul>
        <li><button class="greeting" onclick="active_template('g_template')">初めに</button></li>
        <li><button class="portfolio" onclick="active_template('port_template')">ポートフォリオ</li>
        <li><button class="prof" onclick="active_template('prof_template')">自己紹介</li>
        <li><button class="home" onclick="change_note()">home</button></li>
      </ul>
    </nav>
    <div id="container">
    </div>
    <template id="g_template">
      <div class="template_style">
        <h1>初めに</h1>
        <p>このページを開いてくださってありがとうございます。このページは日々精進のため、私が思いついたアプリをひたすら試すページです。
          ポートフォリオを押してどうぞ試していってください。
        </p>
      </div>
    </template>
    <template id="port_template">
      <div class="template_style">
        <h1>ポートフォリオ</h1>
        <a href="../controller/attendance.php" class="temp">出退勤アプリ</a>
          <p>コロナ禍でリモートワークが増えているので、どこで何時まで仕事をしたか確認するためのアプリです</p>
          <p>ジーコーディングとリバースジオコーディング,ajaxを使用しています</p>
        <a href="../htdocs/ECsite/controller/top.php" class="temp">義肢装具のECサイト</a>
          <p>義肢装具自体を知らない方も多いのでどういったものがあるのか、義肢のユーザーにはどういった部品があるのかを知ってもらうためのアプリです</p>
      </div>
    </template>
    <template id="prof_template">
      <div class="template_style">
        <h1>自己紹介</h1>
        <p>熊本県出身の駆け出しエンジニア。</p>
        <p>元医療系専門職で義足や装具を扱っていましたが、義肢装具の業界を広めたくて、IT業界に飛び込み。</p>
        <p>インソールや人体に詳しいです。</p>
        <p>普段は石黒版銀河英雄伝説と水曜どうでしょうを延々と見ています</p>
      </div>
    </template>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script>
    const images =$('.img');
    const slide  =$('#slide').children();
    let index =0;
    let timeCounter = 0;
    let idPosition = $("#navi").offset().top;


    const slideShow = function() {
      images.eq(index).css('display', 'none');
      index++;
      if(index == images.length){
        index=0;
      }
       images.eq(index).fadeIn("fast");
     }

     setInterval(slideShow, 3000);
    
    $(window).scroll(function(){
      let scroll = $(document).scrollTop();
      let moveAmount = idPosition + (scroll - 310)+ "px";
      $("#navi").animate({
        top: moveAmount
      },{
        duration : 0,
        queue : false
      });
    });

    function change_note(){
      $('#container').html("");
      $('#container').css('background-image','url(../view/css/note5.svg)');
    }

    function active_template(tag){
      $('#container').css('background-image','url(../view/css/note7.svg)');
      $('#container').html('');
      let template  = document.getElementById(tag);
      let content = template.content;
      let clone = document.importNode(content, true);
      $(clone).appendTo("#container");
      // $('.template_style').addClass("show");
      //animeCSS();
    }
    // function animeCSS(){
    //   // アニメーションさせたいクラス
    //   var container = $(".template_style");
    //   // アニメーションスピード
    //   var speed = 80;

    //   // テキストの間にスペースを入れます
    //   var content = $(container).html();
    //   var text = $.trim(content);
    //   var newHtml = "";

    //   // スペースで区切ったテキストを、テキストの数だけspanで囲む
    //   text.split("").forEach(function(v) {
    //    newHtml += '<span>' + v + '</span>';
    //   });

    //   // spanで囲んだテキスト群をHTMLに戻す
    //   $(container).html(newHtml);

    //   // 1文字ずつ表示
    //   var txtNum = 0;
    //   setInterval(function() {
    //     $(container).find('span').eq(txtNum).css({opacity: 1});
    //    txtNum++
    //   }, speed);
    // }
  </script>
  
  <!-- <script src="../view/css/slick/slick.js" type="text/javascript" charset="utf-8"></script> -->
</body>
</html>