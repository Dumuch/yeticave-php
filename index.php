<?php
  require_once('functions.php');
  require_once('data.php');

$page_content = render_template('templates/index.php', [
  'products' => $products,
]);


$layout_content = render_template('templates/layout.php', [
  'content' => $page_content,
  'title' => 'Главная страница',
  'category' => $category,
  ] );

print($layout_content);
