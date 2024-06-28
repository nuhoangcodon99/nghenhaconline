<?php
require_once dirname(__DIR__) . '/system/core.php';
require_once dirname(__DIR__) . '/system/function.php';
header("content-type:text/xml;charset=utf-8");
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
 <url>
  <loc><?=Setting('home_url');?></loc>
  <priority>1.0</priority>
  <changefreq>daily</changefreq>
  <lastmod><?=date("Y-m-d", time());?></lastmod>
 </url>
 <?php  foreach ($ACAIVIPPRO->get_list("SELECT * FROM `posts` WHERE `hidden`='0' ORDER BY `id` ASC ") as $row) : ?>
 <url>
  <loc><?=Setting('home_url');?>/<?=$row['slug'];?>.html</loc>
  <priority>1.0</priority>
  <changefreq>daily</changefreq>
  <lastmod><?=date("Y-m-d", strtotime($row['time']));?></lastmod>
 </url>
 <?php endforeach;?>
 <?php foreach ($ACAIVIPPRO->get_list("SELECT * FROM `category` WHERE `hidden`='0' ORDER BY `id` ASC ") as $category) : ?>
 <url>
  <loc><?=Setting('home_url')?>/the-loai/<?=$category['slug']?>.html</loc>
  <priority>1.0</priority>
  <changefreq>daily</changefreq>
  <lastmod><?=date("Y-m-d", strtotime($category['time']));?></lastmod>
 </url>
  <?php endforeach;?>
</urlset>
