<?
    session_start();
	include("../settings/connect_datebase.php");

	function decrypt($data) {
		$key = '1234567890123456';
		$iv = '1234567890123456';
		return openssl_decrypt(base64_decode($data), 'aes-128-cbc', $key, OPENSSL_RAW_DATA, $iv);
	}

    $IdUser = $_SESSION['user'];
    $Message = decrypt($_POST["Message"]);
    $IdPost = decrypt($_POST["IdPost"]);

    $mysqli->query("INSERT INTO `comments`(`IdUser`, `IdPost`, `Messages`) VALUES ({$IdUser}, {$IdPost}, '{$Message}');");
?>