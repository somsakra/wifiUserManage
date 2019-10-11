<?
session_start();
include "connection.php";
include "function.php";
if ($_POST[action] == 'add') {
	if(memberprivilege($_SESSION[wififirst_id])!='1'){echo "<META http-equiv='refresh' content='0;URL=  index.php'> "; exit();}
	$password_hash = password_hash($_POST[agency_password], PASSWORD_DEFAULT, ['cost' => 12]);
	$sql = "insert into member(
		member_username,
		member_password,
		member_name,
		member_surname,
		member_tel,
		member_address,
		member_active
		) values (
		:member_username,
		:member_password,
		:member_name,
		:member_surname,
		:member_tel,
		:member_address,
		:member_active
		)";
$sth = $pdo->prepare($sql);
$sth->execute(array(
	':member_username' => $_POST[member_username],
	':member_password' => $password_hash,
	':member_name' => $_POST[member_name],
	':member_surname' => $_POST[member_surname],
	':member_tel' => $_POST[member_tel],
	':member_address' => $_POST[member_address],
	':member_active' => $_POST[member_active]
));

$id = $pdo->lastInsertId();

$sql = "insert into agency(
	member_id,
	agency_balance,
	agency_commission
	) values (
	:member_id,
	:agency_balance,
	:agency_commission
	)";
$sth = $pdo->prepare($sql);
$sth->execute(array(
	':member_id' => $id,
	':agency_balance' => '0',
	'agency_commission' => $_POST[agency_commission]
));

	
	echo "<meta http-equiv='refresh' content='0;URL=agency.php'>";
}

if ($_POST[action] == 'edit') {
	if(memberprivilege($_SESSION[wififirst_id])!='1'){echo "<META http-equiv='refresh' content='0;URL=  index.php'> "; exit();}
	$sql = "update member set 
			member_username = :member_username,
			member_name = :member_name,
			member_surname = :member_surname,
			member_tel = :member_tel,
			member_address = :member_address,
			member_active = :member_active
			where member_id = :member_id";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(
        ':member_username' => $_POST[member_username],
        ':member_name' => $_POST[member_name],
        ':member_surname' => $_POST[member_surname],
        ':member_tel' => $_POST[member_tel],
        ':member_address' => $_POST[member_address],
		':member_active' => $_POST[member_active],
        ':member_id' => $_POST[member_id]
	));
	
	$sql = "update agency set
			agency_commission = :agency_commission
			where member_id = :member_id";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(
		':agency_commission' => $_POST[agency_commission],
        ':member_id' => $_POST[member_id]
    ));

	if ($_POST[member_password]) {
        $password = password_hash($_POST[member_password], PASSWORD_DEFAULT, ['cost' => 12]);
        $sql = "update member set member_password = :password
				where member_id = :member_id";
        $sth = $pdo->prepare($sql);
        $sth->execute(array(
            ':password' => $password,
            ':member_id' => $_POST[member_id]
        ));
    }

	echo "<META http-equiv='refresh' content='0;URL=  agency_detail.php?id=$_POST[member_id]&status=editprofilesuccess'> ";
}

if ($_GET[action] == 'delete') {
	if(memberprivilege($_SESSION[wififirst_id])!='1'){echo "<META http-equiv='refresh' content='0;URL=  index.php'> "; exit();}
	deletetopupbyagency($_GET[agency]);
	$sql = "delete from agency
			where member_id = :member_id";
	$sth = $pdo->prepare($sql);
	$sth->execute(array(':member_id' => $_GET[member]));

	$sql = "delete from member
			where member_id = :member_id";
	$sth = $pdo->prepare($sql);
	$sth->execute(array(':member_id' => $_GET[member]));
	echo "<META http-equiv='refresh' content='0;URL=  agency.php?status=deletesuccess'> ";
}
