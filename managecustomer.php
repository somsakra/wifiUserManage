<?
session_start();
include "connection.php";
include "function.php";

if ($_POST[action] == 'add') {
    $sql = "insert into customer(
			customer_username,
			customer_password,
			customer_name,
			customer_surname,
			customer_tel,
			customer_address,
			customergroup_id
            ) values (
			:customer_username,
			:customer_password,
            :customer_name,
			:customer_surname,
			:customer_tel,
			:customer_address,
			:customergroup_id
            )";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(
        ':customer_username' => $_POST[customer_username],
        ':customer_password' => $_POST[customer_password],
        ':customer_name' => $_POST[customer_name],
        ':customer_surname' => $_POST[customer_surname],
        ':customer_tel' => $_POST[customer_tel],
        ':customer_address' => $_POST[customer_address],
        ':customergroup_id' => $_POST[customergroup_id]
    ));


    echo "<meta http-equiv='refresh' content='0;URL=customer.php'>";
}

if ($_POST[action] == 'edit') {
	$sql = "update customer set 
			customer_username = :customer_username,
			customer_name = :customer_name,
			customer_surname = :customer_surname,
			customer_tel = :customer_tel,
			customer_address = :customer_address,
			customergroup_id = :customergroup_id
			where customer_id = :customer_id";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(
        ':customer_username' => $_POST[customer_username],
        ':customer_name' => $_POST[customer_name],
        ':customer_surname' => $_POST[customer_surname],
        ':customer_tel' => $_POST[customer_tel],
        ':customer_address' => $_POST[customer_address],
        ':customergroup_id' => $_POST[customergroup_id],
        ':customer_id' => $_POST[customer_id]
    ));
	echo "<META http-equiv='refresh' content='0;URL=  customer_detail.php?customer=$_POST[customer_id]&status=editprofilesuccess'> ";
}

if ($_GET[action] == 'delete') {
	if(memberprivilege($_SESSION[wififirst_id])!='1'){echo "<META http-equiv='refresh' content='0;URL=  index.php'> "; exit();}

	$sql = "delete from customer
			where customer_id = :customer_id";
	$sth = $pdo->prepare($sql);
	$sth->execute(array(':customer_id' => $_GET[customer]));
	echo "<META http-equiv='refresh' content='0;URL=  customer.php?status=deletesuccess'> ";
}
