<?
session_start();
include "connection.php";
include "function.php";
if ($_POST[action] == 'login') {
	$password = md5($_POST[member_password]);
	$sql = "select * from member where member_username = :member_username and member_active = 'y'";
	$sth = $pdo->prepare($sql);
	$sth->execute(array(':member_username' => $_POST[member_username]));
	foreach ($sth as $result);
	if (password_verify($_POST[member_password], $result[member_password])) {

		$_SESSION["wififirst_id"] = $result[member_id];
		if ($_POST[remember] == 'y') {
			setcookie("wififirst_id", $result[member_id], time() + (86400 * 30), "/");
		}
		echo "<META http-equiv='refresh' content='0;URL=  index.php'> ";
	} else {
		echo "<META http-equiv='refresh' content='0;URL=  login.php?status=notfound'> ";
	}
}
if ($_GET[action] == 'logout') {
	unset($_SESSION["wififirst_id"]);
	setcookie("wififirst_id", $result[member_id], time() - 1, "/");
	echo "<META http-equiv='refresh' content='0;URL=  login.php'> ";
}

