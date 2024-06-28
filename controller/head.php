<?php
require_once dirname(__DIR__) . '/system/core.php';
require_once dirname(__DIR__) . '/system/function.php';
$ACAIVIPPRO = new ACAIVIPPRO();
echo $ACAIVIPPRO->connect();
$title = isset($title) ? $title : Setting('title');
$description = isset($description) ? $description : Setting('description');
$images = isset($images) ? $images : Setting('images');

?>

<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "https://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">

<head>
   <title><?= $title; ?></title>
   <meta name="google-site-verification" content="RBP_Cj2oug-ktVxxmNM-OZzPsuYEV_101-wDoTfHydY" />
   <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
   <meta http-equiv="content-language" content="vi,en,id,cn" />
   <meta name="revisit-after" content="1 days">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="description" content="Tải Nhạc" />
   <meta name="keywords" content="download mp3" />
   <meta charset="UTF-8">
   <link href="<?= Setting('home_url'); ?>" rel="canonical" />
   <meta name="viewport" content="width=device-width, initial-scale=1" />
   <meta name="HandheldFriendly" content="True" />
   <meta name="MobileOptimized" content="320" />
   <meta name="robots" content="noodp" />
   <meta property="og:title" content="NhacTrung - Kumpulan Lagu Terbaru dan Terlengkap" />
   <meta name="geo.placename" content="Vietnam">
   <meta name="geo.region" content="vn">
   <meta name="copyright" content="2020 nhaccuatui ">
   <meta name="spiders" content="all">
   <meta name="robots" content="all,index,follow">
   <meta content="index,follow" name="googlebot">
   <meta content="index,follow" name="msnbot">
   <meta content="follow, all" name="ia_archiver">
   <meta content="follow, all" name="Baiduspider">
   <meta content="follow, all" name="BecomeBot">
   <meta content="follow, all" name="Bingbot">
   <meta content="follow, all" name="btbot">
   <meta content="follow, all" name="Dotbot">
   <meta content="follow, all" name="FAST-WebCrawler">
   <meta content="follow, all" name="FindLinks">
   <meta content="follow, all" name="FyberSpider">
   <meta content="follow, all" name="008">
   <meta content="snippet" name="googlebot-news">
   <meta content="index" name="googlebot-news">
   <meta content="index" name="Googlebot-Image">
   <meta content="index" name="Googlebot-Video">
   <meta content="index" name="Googlebot-Mobile">
   <meta content="index" name="Mediapartners-Google">
   <meta content="index" name="AdsBot-Google" />
   <meta content="Aeiwi, Alexa, AllTheWeb, AltaVista, AOL Netfind, Anzwers, Canada, DirectHit, EuroSeek, Excite, Overture, Go, Google, HotBot. InfoMak, Kanoodle, Lycos, MasterSite, National Directory, Northern Light, SearchIt, SimpleSearch, WebsMostLinked, WebTop, What-U-Seek, AOL, Yahoo, Bing, WebCrawler, Infoseek, Excite, Magellan, LookSmart, CNET, googlebot-news, Googlebot" name="search engines">
   <meta name="rating" content="general">
   <meta name="expires" content="never">
   <meta name="revisit-after" content="1 days">
   <meta name="ICBM" content="music" />
   <meta name="DC.Format" content="audio/mp3; 5 minutes" />
   <meta name="distribution" content="global" />
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
   <link href="//vjs.zencdn.net/5.4.6/video-js.min.css" rel="stylesheet">
   <script src="//vjs.zencdn.net/5.4.6/video.min.js"></script>
   <script src="https://fastcdn.jdi5.com/js/nghetaitruyen.aino.pk/1.js"></script>
   <link rel="dns-prefetch" href="https://fastcdn.jdi5.com">
   <link rel="stylesheet" type="text/css" href="/public/css/style.css" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
   <link rel="shortcut icon" href="https://pix1.wapkizfile.info/download/901d6a08d5575e89920ed220750fb6c0/trithuc+wapkiz+com/music-logo-creative-icon-vector-29591238-(trithuc.wapkiz.com).jpg">
   <link rel="icon" href="https://pix1.wapkizfile.info/download/901d6a08d5575e89920ed220750fb6c0/trithuc+wapkiz+com/music-logo-creative-icon-vector-29591238-(trithuc.wapkiz.com).jpg">
   <link rel="shortcut icon" type="image/x-icon" href="https://pix1.wapkizfile.info/download/901d6a08d5575e89920ed220750fb6c0/trithuc+wapkiz+com/music-logo-creative-icon-vector-29591238-(trithuc.wapkiz.com).jpg">
</head>

<body>
   <div class="sirah">
      <h1 style="font-size:30px;"> <a href="/" title="Tải Nhạc Mp3 Mới Nhất Miễn Phí"><?= Setting('domain'); ?></a></h1><iframe data-aa='2271792' src='//ad.a-ads.com/2271792?size=320x100' style='width:320px; height:100px; border:0px; padding:0; overflow:hidden; background-color: transparent;'></iframe>
   </div>
   <div id="kevin">
      <div class="batuk">
         <div class="mata">
            <div id="cangkem" align="center">
               <form action="<?= Setting('home_url'); ?>/search" method="get"> <input type="text" id="keyword" type="text" name="q" placeholder="Ca Sĩ / Tên Bài Hát. .."><input type="submit" id="search-submit"></form>
            </div>
         </div>
      </div>
   </div>