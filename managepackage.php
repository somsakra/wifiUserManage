<?
session_start();
include "connection.php";
include "function.php";

if ($_POST[action] == 'add') {
    $sql = "insert into package(
            package_name,
            package_price,
            package_day,
            package_upload,
            package_download,
            package_device,
            package_active
            ) values (
            :package_name,
            :package_price,
            :package_day,
            :package_upload,
            :package_download,
            :package_device,
            :package_active
            )";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(
        ':package_name' => $_POST[package_name],
        ':package_price' => $_POST[package_price],
        ':package_day' => $_POST[package_day],
        ':package_upload' => $_POST[package_upload],
        ':package_download' => $_POST[package_download],
        ':package_device' => $_POST[package_device],
        ':package_active' => $_POST[package_active]
    ));
    echo "<meta http-equiv='refresh' content='0;URL=package.php'>";
}

if ($_POST[action] == 'edit') {
    $sql = "update package set 
            package_name = :package_name,
            package_price = :package_price,
            package_day = :package_day,
            package_upload = :package_upload,
            package_download = :package_download,
            package_device = :package_device,
            package_active = :package_active
			where package_id = :package_id";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(
        ':package_name' => $_POST[package_name],
        ':package_price' => $_POST[package_price],
        ':package_day' => $_POST[package_day],
        ':package_upload' => $_POST[package_upload],
        ':package_download' => $_POST[package_download],
        ':package_device' => $_POST[package_device],
        ':package_active' => $_POST[package_active],
        ':package_id' => $_POST[package_id]
    ));

    echo "<META http-equiv='refresh' content='0;URL=  package_detail.php?package=$_POST[package_id]&status=editpackagesuccess'> ";
}

if ($_GET[action] == 'delete') {
	if(memberprivilege($_SESSION[wififirst_id])!='1'){echo "<META http-equiv='refresh' content='0;URL=  index.php'> "; exit();}

	$sql = "delete from package
			where package_id = :package_id";
	$sth = $pdo->prepare($sql);
	$sth->execute(array(':package_id' => $_GET[package]));
	echo "<META http-equiv='refresh' content='0;URL=  package.php?status=deletesuccess'> ";
}
