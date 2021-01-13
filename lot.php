<?php
  require_once('data.php');
  require_once('init.php');

if(!$link) {
  $error = mysqli_connect_error();
  print($error);
} else {
  $sql = "SELECT `name` FROM categories";
  $result = mysqli_query($link, $sql);

  if($result) {
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
  } else {
    print(mysqli_error($link));
  }
}

$lot_id = intval($_GET['id']);

$sql = "SELECT id, name, description FROM lots WHERE id = " . $lot_id;
$result = mysqli_query($link, $sql);

if($result) {

  if(!mysqli_num_rows($result)) {
    http_response_code(404);
    $page_content = 'Такого нет';
  } else {
    $product = mysqli_fetch_array($result, MYSQLI_ASSOC);
    visit_history($lot_id, $visit_name);

    $page_content = render_template('templates/lot.php', [
      'category' => $categories,
      'lot_id' => $lot_id,
      'products' => $product,
      'time' => out_time()
    ]);
  }

} else {
  print('Не нашлось' . mysqli_error($link));
};

$layout_content = render_template('templates/layout.php', [
  'content' => $page_content,
  'title' => 'Главная страница',
  'category' => $categories,
  ]);

print($layout_content);
