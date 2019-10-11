<?
session_start();
include "connection.php";
include "function.php";

if ($_POST[action] == 'add') {
    $sql = "insert into customergroup(
			customergroup_name
            ) values (
            :customergroup_name
            )";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(
        ':customergroup_name' => $_POST[customergroup_name]
    ));
   echo "<meta http-equiv='refresh' content='0;URL=customergroup.php'>";
}

if ($_POST[action] == 'edit') {
	$sql = "update customergroup set 
			customergroup_name = :customergroup_name
			where customergroup_id = :customergroup_id";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(
        ':customergroup_name' => $_POST[customergroup_name],
        ':customergroup_id' => $_POST[customergroup_id]
    ));
	echo "<META http-equiv='refresh' content='0;URL=  customergroup_detail.php?customergroup=$_POST[customergroup_id]&status=editsuccess'> ";
}

if ($_GET[action] == 'delete') {
	if(memberprivilege($_SESSION[wififirst_id])!='1'){echo "<META http-equiv='refresh' content='0;URL=  index.php'> "; exit();}

	$sql = "delete from customergroup
			where customergroup_id = :customergroup_id";
	$sth = $pdo->prepare($sql);
	$sth->execute(array(':customergroup_id' => $_GET[customergroup]));
	echo "<META http-equiv='refresh' content='0;URL=  customergroup.php?status=deletesuccess'> ";
}