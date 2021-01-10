<?php
    require_once('functions.php');
    require_once('data.php');

if (!isset($_SESSION['user'])) {
	header('Location: /index.php');
	exit();
}

    $required_fields = [];
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $lot_name = $_POST['lot-name'] ?? '';
    $category_lot = $_POST['category-lot'] ?? '';
    $message = $_POST['message'] ?? '';
    $lot_rate = $_POST['lot-rate'] ?? '';
    $lot_step = $_POST['lot-step'] ?? '';
    $lot_date = $_POST['lot-date'] ?? '';

    $file_name = $_FILES['preview-img']['name'] ?? '';

    $errors = [];

    if (isset($_FILES['preview-img']['name'])) {

      $file_url = 'uploads/' . $file_name;
      move_uploaded_file($_FILES['preview-img']['tmp_name'], __DIR__ . '/'. $file_url);

    };


    $required_fields = [
      'file-name' => $file_name,
      'lot-name' => $lot_name,
      'category-lot' => $category_lot,
      'message'  => $message,
      'lot-rate' => $lot_rate,
      'lot-step' => $lot_step,
      'lot-date' => $lot_date,
    ];

    $obLot = $_POST;
    $obLot['file-name'] = $file_name;

    foreach ($required_fields as $field => $key) {
      if(empty($obLot[$field])) {
        $errors[$field] = 'Поле не заполнено';
      }
    }

	  if(count($errors)) {
      $page_content = render_template('templates/add-lot.php', [
        'category' => $category,
        'required_fields' => $required_fields,
        'errors' => $errors,
        'file_name' => $file_name,
        'file_url' => $file_url,
      ]);
    } else {
      $products = [
        'name' => $lot_name,
        'category' => $category_lot,
        'message'  => $message,
        'price' => $lot_rate,
        'lot-step' => $lot_step,
        'lot-date' => $lot_date,
        'img' => $file_url,

      ];

      $page_content = render_template('templates/lot.php', [
        'category' => $category,
        'lot_id' => 5,
        'products' => $products,
        'time' => out_time()
      ]);
    }

  } else {
			$page_content = render_template('templates/add-lot.php', [
        'products' => $products,
        'category' => $category,
        'required_fields' => $required_fields,
      ]);
}

$layout_content = render_template('templates/layout.php', [
  'content' => $page_content,
  'title' => 'Добавить лот',
  'category' => $category,
]);


print($layout_content);
