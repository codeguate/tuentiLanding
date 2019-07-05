<?php
include "server/core/phpqrcode-master/qrlib.php";
error_reporting(0);
// header('Content-type: image/png');
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);



//if(isset($_POST)){
$servername = "localhost";
$db = "tuenti_send";
$username = "root";
$password = "@Code1234";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


if(isset($_POST['submit'])){
  $post_id = $_POST['descontar'];
  $query = "SELECT * FROM usuario WHERE encrypt_code LIKE '$post_id'";
  $result = $conn->query($query);
  $cndAll = true;
  $estado = "";
  while($row = $result->fetch_assoc()){
      $estado = $row['estado'];
  }

  if($estado == 0){
     $query = "UPDATE usuario SET estado=1 WHERE encrypt_code = '$post_id'";
     // $query = "SELECT * FROM usuario WHERE encrypt_code LIKE '$post_id'";
     $result = $conn->query($query);
     $globalVar = 2;
  }
  if($estado == 1){
    $query = "UPDATE usuario SET estado=2 WHERE encrypt_code = '$post_id'";
    // $query = "SELECT * FROM usuario WHERE encrypt_code LIKE '$post_id'";
    $result = $conn->query($query);

    $globalVar = 1;
  }
  if($estado == 2){
    $query = "UPDATE usuario SET estado=3 WHERE encrypt_code = '$post_id'";
    // $query = "SELECT * FROM usuario WHERE encrypt_code LIKE '$post_id'";
    $result = $conn->query($query);

    $globalVar = 0;
  }
  if($estado == 3){
    $globalVar = 'Ya no tiene tragos disponibles';
  }

  echo "<!DOCTYPE html>
<html>
<head>
  <title> Tuenti Land</title>
  <link rel='shortcut icon' type='image/x-icon' href='https://d2px9hljt8lyuz.cloudfront.net/gt/static/img/favicon.ico'>
  <link rel='stylesheet' type='text/css' href='style.css'>
  <link rel='stylesheet' type='text/css' href='responsive.css'>
  <script src='https://unpkg.com/aos@2.3.1/dist/aos.js'></script>
  <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
  <script type='text/javascript' src='source.js'></script>
   <link rel='apple-touch-icon' sizes='180x180' href='favicon/apple-touch-icon.png'>
        <link rel='icon' type='image/png' href='favicon/FaviconHN.png' sizes='32x32'>
        <link rel='icon' type='image/png' href='favicon/FaviconHN.png' sizes='16x16'>
        <link rel='manifest' href='favicon/manifest.json'>
        <link rel='mask-icon' href='favicon/safari-pinned-tab.svg' color='#5bbad5'>
        <link href='https://unpkg.com/aos@2.3.1/dist/aos.css' rel='stylesheet'>
        <link rel='stylesheet' href='https://unpkg.com/aos@next/dist/aos.css' />
        <link rel='shortcut icon' href='avicon/favicon.ico'>
  <link rel='stylesheet' type='text/css' href='fonts/Futura-Std-Light-Condensed_19052.ttf'>
  <link href='https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900' rel='stylesheet'>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width'>
  <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KD4QNBJ');</script>
        <!-- End Google Tag Manager -->
        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-44335354-9', 'auto');
        ga('require', 'GTM-PH5272K');
        ga('send', 'pageview');
        </script>

        <style>.async-hide { opacity: 0 !important} </style>
        <script>(function(a,s,y,n,c,h,i,d,e){s.className+=' '+y;h.start=1*new Date;
        h.end=i=function(){s.className=s.className.replace(RegExp(' ?'+y),'')};
        (a[n]=a[n]||[]).hide=h;setTimeout(function(){i();h.end=null},c);h.timeout=c;
        })(window,document.documentElement,'async-hide','dataLayer',4000,
        {'GTM-PH5272K':true});</script>
</head>
<body>

  <div style='top: 0;margin-top: 0em' class='headerlo' data-aos='fade-down' >
      <img id='img_tuenti' src='img/icono.png'>
  </div>
<div class='general'>
  <div class='imagen'>
    <div class='logo1'>
      <img src='img/Artistas.png' style='width: 100%' id='img_art'>
      <img class='text_img' src='img/texto.png' >
      <div class='background_logo' data-aos='fade-up'>
        <div class='container'>
          <div class='row'>
            <div class='col-sm' id='img_logo'>
            </div>
            <div class='col-sm' id='descript'>
              <div class='row' id='t1'>
                PISO 21 
              </div>
              <div class='row' id='t1'>
                DANNY OCEAN
              </div>
              <div class='row' id='text_border'>
                <div class='row' id='t2'>
                  <div class='col'>
                    LA FACTORÍA
                  </div>
                  <div class='col'>
                    - PEDRO CAPÓ
                  </div>
                  <div class='col'>
                    - TAYLG 
                  </div>
                   
                </div>
                <div class='row' id='t22'>
                  <div class='col'>
                    LOS ENGAÑOSOS
                  </div>
                  <div class='col'>
                    - DOGGYSTYLE 
                  </div>
                  <div class='col'>
                     - LOS POW POW POWS 
                  </div>
                   
                </div>
              </div>
              <div class='row' id='t3'>
                <strong>8/2</strong> FUTECA CARDALES CAYALÁ
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <img data-aos='fade-up'  data-aos-duration='800' class='img_fondo' id='img' src='img/img_left.png'>
    <img data-aos='fade-down'  data-aos-duration='600' class='img_f1' id='img' src='img/Figure1.png'>
    <img  data-aos='fade-down-right'  data-aos-duration='700'  class='img_f2' id='img' src='img/Figure2.png'>
    <img data-aos='fade-down'  data-aos-duration='800' class='img_f3' id='img' src='img/Figure3.png'>
    <img data-aos='fade-up-left'  data-aos-duration='900' class='img_f4' id='img' src='img/Figure4.png'>
    <img data-aos='fade-right'  data-aos-duration='1000' class='img_f5' id='img' src='img/Figure1.png'>
    <img data-aos='fade-up-left' data-aos-duration='1100' class='img_f6' id='img' src='img/Figure3.png'>
    <img data-aos='fade-up' data-aos-duration='1200' class='img_f7' id='img' src='img/hoja_1.png'>
    <img data-aos='fade-up'  data-aos-duration='1300' class='img_f8' id='img' src='img/hoja_2.png'>
  <div class='form claslogin' id='content_form'>
      <img class='btnact action21' data-aos='flip-right' src='img/kick.png'>
    <p data-aos='flip-left' id='descript_p' class='parrafoform actionss'>Tragos Disponibles: ".$globalVar."</p> 
  </div>
</div>
</body>
   <script>
    $('#img_art').css('transition','transform 2000ms ease 0s');
    $('.text_img').css('transition','transform 2000ms ease 0s');
    $('.logo_tuenti').css('display','none');
    $('.general').css('visibility','hidden');
    $('button').css('display','none');
    let animate = true;
    let animate2 = true;
    function init_aos(){
      $('.general').css('visibility','visible')
      AOS.init();
      $('.logo_tuenti').fadeIn();
      $('button').fadeIn();
      setInterval(animate_img,2000);
      setInterval(animate2_img,1800);
    }
    function animate_img(){
      if(animate){
        $('#img_art').css('transform','scale(1.1)');
        $('.text_img').css('transform','scale(1.1)');
        animate = false;
      }else{
        $('#img_art').css('transform','scale(1)');
        $('.text_img').css('transform','scale(1)');
        animate = true;
      }
    }
    function animate2_img(){
      if(animate2){
        $('.text_img').css('transform','scale(1.1)');
        animate2 = false;
      }else{
        $('.text_img').css('transform','scale(1)');
        animate2 = true;
      }
    }
    setTimeout(init_aos,4000);
    if( $(window).width() < 1400){
      $('input').attr('data-aos','');
      $('input').fadeIn();
      $('#descript_p').appendTo('#content_form').show('slow');
      // $('#img_kick').appendTo('#content_form').show('slow');
      $('.background_logo').appendTo('#content_form').show('slow');
      // $('#img_kick').css('width','50%');
      $('.background_logo').css('width','60%');
      $('.background_logo').css('margin-bottom','3em');
      $('.background_logo').css('margin-top','2em');
      $('.headerlo').css('border-bottom','3px solid #ff0065')
    }  
  </script>
</html>";

}else{
  $dpi2 = $_GET['code'];
  $query = "SELECT * FROM usuario WHERE encrypt_code LIKE '$dpi2'";
  $result = $conn->query($query);
  $cndAll = true;
  $estado = "";
  while($row = $result->fetch_assoc()){
      $estado = $row['estado'];
  }
  $globalVar = 0;

  if($estado == 0){
    $globalVar = 3;
  }
  if($estado == 1){
    $globalVar = 2;
  }
  if($estado == 2){
    $globalVar = 1;
  }
  if($estado == 3){
    $globalVar = 'Ya no tienes tragos disponibles.';
  }
  echo "<!DOCTYPE html>
<html>
<head>
  <title> Tuenti Land</title>
  <link rel='shortcut icon' type='image/x-icon' href='https://d2px9hljt8lyuz.cloudfront.net/gt/static/img/favicon.ico'>
  <link rel='stylesheet' type='text/css' href='style.css'>
  <link rel='stylesheet' type='text/css' href='responsive.css'>
  <script src='https://unpkg.com/aos@2.3.1/dist/aos.js'></script>
  <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js'></script>
  <script type='text/javascript' src='source.js'></script>
   <link rel='apple-touch-icon' sizes='180x180' href='favicon/apple-touch-icon.png'>
        <link rel='icon' type='image/png' href='favicon/FaviconHN.png' sizes='32x32'>
        <link rel='icon' type='image/png' href='favicon/FaviconHN.png' sizes='16x16'>
        <link rel='manifest' href='favicon/manifest.json'>
        <link rel='mask-icon' href='favicon/safari-pinned-tab.svg' color='#5bbad5'>
        <link href='https://unpkg.com/aos@2.3.1/dist/aos.css' rel='stylesheet'>
        <link rel='stylesheet' href='https://unpkg.com/aos@next/dist/aos.css' />
        <link rel='shortcut icon' href='avicon/favicon.ico'>
  <link rel='stylesheet' type='text/css' href='fonts/Futura-Std-Light-Condensed_19052.ttf'>
  <link href='https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900' rel='stylesheet'>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width'>
  <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
        new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-KD4QNBJ');</script>
        <!-- End Google Tag Manager -->
        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-44335354-9', 'auto');
        ga('require', 'GTM-PH5272K');
        ga('send', 'pageview');
        </script>

        <style>.async-hide { opacity: 0 !important} </style>
        <script>(function(a,s,y,n,c,h,i,d,e){s.className+=' '+y;h.start=1*new Date;
        h.end=i=function(){s.className=s.className.replace(RegExp(' ?'+y),'')};
        (a[n]=a[n]||[]).hide=h;setTimeout(function(){i();h.end=null},c);h.timeout=c;
        })(window,document.documentElement,'async-hide','dataLayer',4000,
        {'GTM-PH5272K':true});</script>
</head>
<body>

  <div style='top: 0;margin-top: 0em' class='headerlo' data-aos='fade-down' >
      <img id='img_tuenti' src='img/icono.png'>
  </div>
<div class='general'>
  <div class='imagen'>
    <div class='logo1'>
      <img src='img/Artistas.png' style='width: 100%' id='img_art'>
      <img class='text_img' src='img/texto.png' >
      <div class='background_logo' data-aos='fade-up'>
        <div class='container'>
          <div class='row'>
            <div class='col-sm' id='img_logo'>
            </div>
            <div class='col-sm' id='descript'>
              <div class='row' id='t1'>
                PISO 21 
              </div>
              <div class='row' id='t1'>
                DANNY OCEAN
              </div>
              <div class='row' id='text_border'>
                <div class='row' id='t2'>
                  <div class='col'>
                    LA FACTORÍA
                  </div>
                  <div class='col'>
                    - PEDRO CAPÓ
                  </div>
                  <div class='col'>
                    - TAYLG 
                  </div>
                   
                </div>
                <div class='row' id='t22'>
                  <div class='col'>
                    LOS ENGAÑOSOS
                  </div>
                  <div class='col'>
                    - DOGGYSTYLE 
                  </div>
                  <div class='col'>
                     - LOS POW POW POWS 
                  </div>
                   
                </div>
              </div>
              <div class='row' id='t3'>
                <strong>8/2</strong> FUTECA CARDALES CAYALÁ
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <img data-aos='fade-up'  data-aos-duration='800' class='img_fondo' id='img' src='img/img_left.png'>
    <img data-aos='fade-down'  data-aos-duration='600' class='img_f1' id='img' src='img/Figure1.png'>
    <img  data-aos='fade-down-right'  data-aos-duration='700'  class='img_f2' id='img' src='img/Figure2.png'>
    <img data-aos='fade-down'  data-aos-duration='800' class='img_f3' id='img' src='img/Figure3.png'>
    <img data-aos='fade-up-left'  data-aos-duration='900' class='img_f4' id='img' src='img/Figure4.png'>
    <img data-aos='fade-right'  data-aos-duration='1000' class='img_f5' id='img' src='img/Figure1.png'>
    <img data-aos='fade-up-left' data-aos-duration='1100' class='img_f6' id='img' src='img/Figure3.png'>
    <img data-aos='fade-up' data-aos-duration='1200' class='img_f7' id='img' src='img/hoja_1.png'>
    <img data-aos='fade-up'  data-aos-duration='1300' class='img_f8' id='img' src='img/hoja_2.png'>
  <div class='form claslogin' id='content_form'>
      <img class='btnact action21' data-aos='flip-right' src='img/kick.png'>
    <p data-aos='flip-left' id='descript_p' class='parrafoform actionss'>Tragos Disponibles: ".$globalVar."</p> 
    <form action='verify.php'  id='send_form' class='login-form actionss' method='POST'>
     <input  type='text' name='descontar' id='desc' value='".$dpi2."' style='display:none;' hidden/>
      <div>
          <button style='width:auto;padding:1em;' type='submit' name='submit'>Canjear</button>
      </div>
  </form> 
  </div>
</div>
</body>
   <script>
    $('#img_art').css('transition','transform 2000ms ease 0s');
    $('.text_img').css('transition','transform 2000ms ease 0s');
    $('.logo_tuenti').css('display','none');
    $('.general').css('visibility','hidden');
    $('button').css('display','none');
    let animate = true;
    let animate2 = true;
    function init_aos(){
      $('.general').css('visibility','visible')
      AOS.init();
      $('.logo_tuenti').fadeIn();
      $('button').fadeIn();
      setInterval(animate_img,2000);
      setInterval(animate2_img,1800);
    }
    function animate_img(){
      if(animate){
        $('#img_art').css('transform','scale(1.1)');
        $('.text_img').css('transform','scale(1.1)');
        animate = false;
      }else{
        $('#img_art').css('transform','scale(1)');
        $('.text_img').css('transform','scale(1)');
        animate = true;
      }
    }
    function animate2_img(){
      if(animate2){
        $('.text_img').css('transform','scale(1.1)');
        animate2 = false;
      }else{
        $('.text_img').css('transform','scale(1)');
        animate2 = true;
      }
    }
    setTimeout(init_aos,4000);
    if( $(window).width() < 1400){
      $('input').attr('data-aos','');
      $('input').fadeIn();
      $('#descript_p').appendTo('#content_form').show('slow');
      // $('#img_kick').appendTo('#content_form').show('slow');
      $('.background_logo').appendTo('#content_form').show('slow');
      // $('#img_kick').css('width','50%');
      $('.background_logo').css('width','60%');
      $('.background_logo').css('margin-bottom','3em');
      $('.background_logo').css('margin-top','2em');
      $('.headerlo').css('border-bottom','3px solid #ff0065')
    }  
  </script>
</html>";
}





?>