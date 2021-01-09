<?php
require_once('functions.php');
require_once('data.php');
require_once('userdata.php');



if($_SERVER['REQUEST_METHOD'] == 'POST') {
	$form = $_POST;
	$email = $form['email'] ?? '';

	$required = ['email', 'password'];
	$errors = [];

	foreach ($required as $field) {
		if(empty($form[$field])) {
			$errors[$field] = 'Это поле надо заполнить';
		}
	}

	$user = searchUserByEmail($form['email'], $users);

	if(!count($errors) and !empty($user)) {
		if(password_verify($form['password'], $user['password'])) {
			$_SESSION['user'] = $user;
		} else {
			$errors['password'] = 'Неверный пароль';
		}
	} else if (!count($errors) and empty($user)) {
		$errors['email'] = 'Такой пользователь не найден';
	}

	if(count($errors)) {
		$page_content = render_template('templates/login.php', [
			'errors' => $errors,
			'email' => $email,
			'user' => $user,
		]);
	} else {
		header('Location: /index.php');
		exit();
	}
} else {
	$page_content = render_template('templates/login.php', [
	]);
}



$layout_content = render_template('templates/layout.php', [
		'content' => $page_content,
		'title' => 'Главная страница',
		'category' => $category,
] );


// echo get_currency('EUR', 0);

print($layout_content);

