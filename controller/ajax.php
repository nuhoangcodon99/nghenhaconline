<?php
require_once dirname(__DIR__) . '/system/core.php';
require_once dirname(__DIR__) . '/system/function.php';
if (isset($_POST['xxx_server']) && isset($_POST['id']) && isset($_POST['server'])) {
          $xxx_server = xss_jquery($_POST['xxx_server']);
          $id = xss_jquery($_POST['id']);
          $server = xss_jquery($_POST['server']);
          echo '<script>jwplayer.key = "ITWMv7t88JGzI0xPwW8I0+LveiXX9SWbfdmt0ArUSyc=";</script>
          <div class="cssloading">Đang tải video<span>.</span><span>.</span><span>.</span></div>
<iframe src="'.Setting('home_url').'/embed/'.$id.'/'.$server.'" scrolling="no" frameborder="0" width="100%" height="100%" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" style="position: absolute;
    top: 0;"></iframe>';
      } else {
         ?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL was not found on this server.</p>
<hr>
</body></html>

         <?php
      }
      
?>

 