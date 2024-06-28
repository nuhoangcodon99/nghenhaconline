<?php
require_once dirname(__DIR__) . '/system/core.php';
require_once dirname(__DIR__) . '/system/function.php';
if (isset($_GET['tag'])) {
   $key = get($_GET['tag']);
} else {
   $key = "";
}

if (isset($_GET['page'])) {
   $page = xss(intval($_GET['page']));
   $title_page = " - Trang $page";
} else {
   $page = 1;
   $title_page = null;
}

$title = "Nghe nhạc Chủ Đề " . $key;
$description = "Nhạc hay chủ đề $key đã được chọn lọc, Nghe nhạc online miễn phí, tải nhạc online";
require_once dirname(__DIR__) . '/controller/head.php';
$sotin1trang = 12;
$from = ($page - 1) * $sotin1trang;
?>
<div class="weteng">
   <h2 class="cungur"><b>Chủ Đề <font color="red"><?= $key; ?></font> </b></h2>
   <?php foreach ($ACAIVIPPRO->get_list("SELECT * FROM `posts` WHERE `tags` LIKE '%$key%' ORDER BY `id` DESC LIMIT $from,$sotin1trang") as $row) : ?>
      <div class="polok">
         <table>
            <tbody>
               <tr valign="middle">
                  <td valign="top">
                     <div style="font-size:14px;">♬ <a href="<?= Setting('home_url'); ?>/<?= $row['slug']; ?>.html" title="<?= $row['title']; ?>"><b><?= $row['title']; ?></b></a><br> Độ Dài : 2:47 | Size : 6.37 MB | Lượt nghe : <?= formatViews($row['view']); ?></div>
                  </td>
               </tr>
            </tbody>
         </table>
      </div>
   <?php endforeach; ?>
   <div class="navigation-scoll">
      <?php
      $tong = $ACAIVIPPRO->num_rows("SELECT * FROM `posts` WHERE `tags` LIKE '%$key%'");
      if ($tong > $sotin1trang) {
         echo pagination_account(Setting('home_url') . '/tag/' . $slug . '.html?page=', $from, $tong, $sotin1trang);
      } ?>
   </div>

   <?php
   require_once dirname(__DIR__) . '/controller/foot.php';
   ?>