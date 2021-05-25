<?php
  require_once('functions.php');
  require_once('data.php');
  require_once('weather.php');



$page_content = render_template('templates/index.php', [
  'products' => $products,
  'time' => out_time()
]);


$layout_content = render_template('templates/layout.php', [
  'content' => $page_content,
  'title' => 'Главная страница',
  'category' => $category,
  ] );


// echo get_currency('EUR', 0);

print($layout_content);
