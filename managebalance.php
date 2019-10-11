<?
session_start();
include "connection.php";
include "function.php";
if ($_POST[action] == 'add') {
    // อัพเดท Agent
    $sql = "update agency set 
            agency_balance = agency_balance+:topup_amount
            where member_id = :member_id
            ";
            $sth = $pdo->prepare($sql);
            $sth->execute(array(':member_id' => $_POST[agencymember_id],
                                ':topup_amount' => $_POST[topup_amount]                  
        ));

    // ใส่ในข้อมูลการเติมเงิน    
	$sql = "insert into topup(
            member_id,
            agencymember_id,
            topup_amount,
            topup_note
            ) values (
            :member_id,
            :agencymember_id,
            :topup_amount,
            :topup_note
            )";
	$sth = $pdo->prepare($sql);
	$sth->execute(array(
		':member_id' => $_SESSION[wififirst_id],
		':agencymember_id' => $_POST[agencymember_id],
		':topup_amount' => $_POST[topup_amount],
		':topup_note' => $_POST[topup_note]
	));
	echo "<meta http-equiv='refresh' content='0;URL=balance.php?member=$_POST[agencymember_id]'>";
}
