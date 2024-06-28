<div class="tab-movies1">
<h2 class="cungur"><b>BẠN CÓ THỂ THÍCH ?</b></h2>
      <?php foreach ($ACAIVIPPRO->get_list("SELECT * FROM `posts` WHERE `slug` !='$slug' ORDER BY RAND() LIMIT 12") as $row) : ?>
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
         	<?php endforeach;?>
      </ul>
   </ul>
</div>