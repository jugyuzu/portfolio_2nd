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
      position:relative;
    }
    #container{
      min-width: 800px;
      margin:10px 0px 10px 40px;
      min-height:1000px;
      background-image: url('../view/css/note5.svg');
      background-repeat: no-repeat;
      position: relative;
    }
    #gallary{
      min-width: 800px;
      min-height:1000px;
      
      position: absolute; top: 320px;left: 280px;
      z-index:1;
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
    #inkImg{
      width:200px;
      height:200px;
      position:absolute;top: 500px;left: 1200px;
    }
    .penImg{
      width:400px;
      height:400px;
      position:absolute;top:-20px;left: 0px;
    }
    .penActive{
      position:absolute;top:-20px;left: 0px;
      width:400px;
      height:400px;
      transition :all 5s ease;
      transform: translateX(1160px);
    }
    .ink{
      position:absolute;top:121px;left: 1217px;
      width:250px;
      height:250px;
    }
    .inkActive{
      position:absolute;top:121px;left: 1217px;
      width:250px;
      height:250px;
      transition :all 0.3s ease-in;
      transform: translatey(180px);
    }
    .title{
      width: 0px;
      height: 110px;
      overflow: hidden;
      position:absolute;top:320px;left: 92px;
      transition: 1000ms linear;
    }
    .titleShow{
      position:absolute;top:320px;left: 92px;
      height: 110px;
      width: 400px;
    }
    .show_title{
      position:absolute;top:320px;left: 92px;
      height: 110px;
      width: 400px;
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
      <img src="../view/css/note_title.png" alt="" class="title">
    </div>
    <div id="gallary">
      <img src="../view/css/ink.svg" alt="" id="inkImg">
      <img src="../view/css/fd6.svg" alt="" class="penImg" >
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
          <p>※値段、商品名、説明は実際のものとは違います。</p>
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
    const images  =$('.img');
    const slide   =$('#slide').children();
    const img     =$('.penImg');
    const inkImage=$('<img src="../view/css/sqi.svg" alt="" class="ink" >');

    let index =0;
    let timeCounter = 0;
    let idPosition = $("#navi").offset().top;

    const showTitle = function(){
      $('.title').addClass('titleShow')
    }

    const removeInk = function(){
      $('.inkActive').remove();
      setTimeout(moveInk, 2000);
    }

    const dropInk = function(){
      $('.ink').addClass("inkActive");
      $('.ink').removeClass("ink");
      setTimeout(removeInk,2000);
    }

    const Accumulate = function(){
      $('.ink').attr('src','../view/css/sqi2.svg');
      setTimeout(dropInk, 3000);
    }
    
    const moveInk = function(){
        $('<img src="../view/css/sqi.svg" alt="" class="ink" >').appendTo('#gallary').hide().fadeIn('slow');
        setTimeout(Accumulate, 3000);
     }
    const slideImg  = function(){
       img.removeClass("penImg");
       img.addClass("penActive");
      }

    const slideShow = function() {
      images.eq(index).css('display', 'none');
      index++;
      if(index == images.length){
        index=0;
      }
      images.eq(index).fadeIn("fast");
    }
    
    setTimeout(slideShow, 3000);
    setTimeout(slideImg, 800);
    setTimeout(showTitle, 800);
    setTimeout(moveInk, 9000);
    
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
      $('#container').append('<img src="../view/css/note_title.png" alt="" class="show_title>');
    }

    function active_template(tag){
      $('#container').css('background-image','url(../view/css/note7.svg)');
      $('#container').html('');
      let template  = document.getElementById(tag);
      let content = template.content;
      let clone = document.importNode(content, true);
      $(clone).appendTo("#container");
      
    }
    
  </script>
  
</body>
</html>