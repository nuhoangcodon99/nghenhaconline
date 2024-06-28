<div class="sidebar">
   <div class="section-title">
      <h2 class="cungur"><b>ĐƯỢC YÊU THÍCH NHẤT</b></h2>
   </div>
   <?php foreach ($ACAIVIPPRO->get_list("SELECT * FROM `posts` WHERE `hidden`='0' ORDER BY `view_month` DESC LIMIT 6") as $row) : ?>
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
</div>