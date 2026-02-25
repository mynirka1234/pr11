<?php
	session_start();
	include("../settings/connect_datebase.php");
	
	function decrypt($data) {
		$key = '1234567890123456';
		$iv = '1234567890123456';
		return openssl_decrypt(base64_decode($data), 'aes-128-cbc', $key, OPENSSL_RAW_DATA, $iv);
	}

	$login = decrypt($_POST['login']);
	$password = decrypt($_POST['password']);
	
	// ищем пользователя
	$query_user = $mysqli->query("SELECT * FROM `users` WHERE `login`='".$login."' AND `password`= '".$password."';");
	
	$id = -1;
	while($user_read = $query_user->fetch_row()) {
		$id = $user_read[0];
	}
	
	if($id != -1) {
		$_SESSION['user'] = $id;
	}
	echo md5(md5($id));
?>