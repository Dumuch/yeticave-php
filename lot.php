<?php
  require_once('functions.php');
  require_once('data.php');

$lot_id = null;

if (isset($_GET['id'])) {
  foreach($products as $item) {
    if ($item['id'] == $_GET['id']) {
      $lot_id = $_GET['id'];
    }
    else {
      http_response_code(404);
    }
  }
} else {
    http_response_code(404);
};

$page_content = render_template('templates/lot.php', [
  'category' => $category,
  'lot_id' => $lot_id,
  'products' => $products[$lot_id - 1],
  'time' => out_time()
]);


$layout_content = render_template('templates/layout.php', [
  'content' => $page_content,
  'title' => 'Главная страница',
  'category' => $category,
  ]);

print($layout_content);
