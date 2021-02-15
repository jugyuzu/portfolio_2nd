<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../view/css/html5reset-1.6.1 (2).css">
  <style type="text/css">
    body{
      background-color: #F5F5F5; 
      
    }
    header{
      /* background-color: #556B2F; */
      min-width: 200px;
      height:150px;
      border: solid 1px black;
    }
    #main{
      margin-top: 10px;
      display:flex;
    }
    nav{
      background-color: #556B2F;
      color: #FFD700;
      min-width: 150px;
      margin-left: 20px;
      height: 500px;
      position:relative
    }
    #container{
      min-width: 1000px;
      margin:0 auto;
      min-height:1400px;
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
    .template_style{
      position: absolute;
      top : 100px;
      left: 120px;
    }
</style>
</head>
<body>
  <header>ヘッダー
      <div><button class="greeting" onclick="active_template('g_template')">初めに</button></div>
      <div><button class="portfolio" onclick="active_template('port_template')">ポートフォリオ</button></div>
      <div><button class="prof" onclick="active_template('prof_template')">自己紹介</button></div>
      <div><button class="home" onclick="change_note()">home</button></div>
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
        <a href="attendance.php">出退勤アプリ</a>
          <p>コロナ禍でリモートワークが増えているので、どこで何時まで仕事をしたか確認するためのアプリです</p>
          <p>ジーコーディングとリバースジオコーディングを使用しています</p>
        <a href="">義肢装具のECサイト</a>
          <p>義肢装具自体を知らない方も多いのでどういったものがあるのか、義肢のユーザーにはどういった部品があるのかを知ってもらうためのアプリです</p>
      </div>
    </template>
    <template id="prof_template">
      <div class="template_style">
        <h1>自己紹介</h1>
        <p>熊本県出身の駆け出しエンジニア</p>
        <p>元医療系専門職で義足や装具を扱っていましたが、義肢装具の業界を広めたくて、IT業界に飛び込み</p>
        <p>インソールや人体に詳しいです。</p>
        <p>普段は石黒版銀河英雄伝説と水曜どうでしょうを延々と見ています</p>
      </div>
    </template>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script>
    let id_position = $("#navi").offset().top;
    $(window).scroll(function(){
      let scroll = $(document).scrollTop();
      let move_amount = id_position + (scroll - 160)+ "px";
      $("#navi").animate({
        top: move_amount
      },{
        duration : 0,
        queue : false
      });
    });
    function change_note(){
      let container = document.getElementById('container');
      container.innerHTML = '';
      container.style.backgroundImage = "url(../view/css/note5.svg)";
    }
    function active_template(tag){
      let container = document.getElementById('container');
      container.style.backgroundImage = "url(../view/css/note4.svg)";
      container.innerHTML = '';
      let template  = document.getElementById(tag);
      let content = template.content;
      let clone = document.importNode(content, true);
      container.append(clone);
    }
    
  </script>
</body>
</html>