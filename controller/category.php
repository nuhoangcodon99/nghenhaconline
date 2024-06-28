<?php
require_once dirname(__DIR__) . '/system/core.php';
require_once dirname(__DIR__) . '/system/function.php';
if (isset($_GET['slug'])) {
   $slug = xss_jquery($_GET['slug']);
} else {
   $slug = "error";
}
if (isset($_GET['page'])) {
   $page = xss(intval($_GET['page']));
   $title_page = " - Trang $page";
} else {
   $page = 1;
   $title_page = null;
}
if ($row = $ACAIVIPPRO->get_row("SELECT * FROM `category` WHERE `slug`='$slug'")) :
   $title = $row['title'] . $title_page;
   $description = $row['description'];
   $id_categ = $row['id'];
   $title = isset($title) ? $title : $title . $title_page;
   require_once dirname(__DIR__) . '/controller/head.php';
   $sotin1trang = 12;
   $from = ($page - 1) * $sotin1trang;
?>
   <div class="weteng">
      <h2 class="cungur"><b>Thể Loại <font color="red"><?= $row['title']; ?> </b></h2>
      <?php if ($ACAIVIPPRO->num_rows("SELECT * FROM `posts` WHERE `category` LIKE '%$id_categ%'") > 0) : ?>
         <?php foreach ($ACAIVIPPRO->get_list("SELECT * FROM `posts` WHERE `category` LIKE '%$id_categ%' ORDER BY `id` DESC LIMIT $from,$sotin1trang") as $row) : ?>
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
         </ul>
         <div class="navigation-scoll">
            <?php
            $tong = $ACAIVIPPRO->num_rows("SELECT * FROM `posts` WHERE `category` LIKE '%$id_categ%'");
            if ($tong > $sotin1trang) {
               echo page_category(Setting('home_url') . '/the-loai/' . $slug . '.html?page=', $from, $tong, $sotin1trang);
            } ?>
         <?php endif; ?>
         </div>

         <?php
         require_once dirname(__DIR__) . '/controller/foot.php';
         ?>
      <?php else : header("location: /"); ?>
      <?php endif; ?>