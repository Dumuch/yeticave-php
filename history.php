<?php

require_once('functions.php');
require_once('data.php');



$page_content = render_template('templates/history.php', [
		'products_history' => define_visit_history($visit_name, $products),
		'time' => out_time(),
]);


$layout_content = render_template('templates/layout.php', [
		'content' => $page_content,
		'title' => 'История просмотра',
		'category' => $category,
]);


print($layout_content);
