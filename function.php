<?
function checklogin()
{
    if ($_SESSION[wififirst_id]) {
        include "connection.php";
        $sql = "select * from member where member_id = :id";
        $sth = $pdo->prepare($sql);
        $sth->execute(array(':id' => $_SESSION[wififirst_id]));
        foreach ($sth as $result);
        if ($result[member_active] == 'y') {
            return $_SESSION[wififirst_id];
        }
    } else if ($_COOKIE[wififirst_id]) {
        include "connection.php";
        $sql = "select * from member where member_id = :id";
        $sth = $pdo->prepare($sql);
        $sth->execute(array(':id' => $_COOKIE[wififirst_id]));
        foreach ($sth as $result);
        if ($result[member_active] == 'y') {
            $_SESSION["wififirst_id"] = $_COOKIE[wififirst_id];
            return $_SESSION[wififirst_id];
        }
    }
}

function userdetail($id)
{
    include "connection.php";
    $sql = "select * from member 
            left join agency on agency.member_id = member.member_id
            where member.member_id = :id";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':id' => $id));
    foreach ($sth as $result);
    $userdetail[] = $result[member_id];
    $userdetail[] = "$result[member_name] $result[member_surname]";
    $userdetail[] = $result[agency_commission]; // 2 คิดคอมมิชชั่นหรือไม่
    return $userdetail;
}


function deletetopupbyagency($agency) // ลบข้อมูลการเติมงานตามไอดีของ agency
{
    include "connection.php";
    $sql = "delete from topup
			where agency_id = :agency_id";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':agency_id' => $agency));
}

function memberprivilege($member_id) // ประเภท User
{
    include "connection.php";
    $sql = "select * from member
            left join admin on admin.member_id = member.member_id
            left join agency on agency.member_id =  member.member_id
            where member.member_id = :member_id";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':member_id' => $member_id));
    foreach ($sth as $result);
    if ($result[privilege_id]) {
        $privilege = $result[privilege_id];
    } else if ($result[agency_id]) {
        $privilege = 'agency';
    }
    return $privilege;
}

// ตรวจสอบวันสุดท้ายของแพคเกจที่ซื้อ
function lastbuydateto($customer_id)
{
    include "connection.php";
    $sql = "select MAX(buy_dateto) as date from buy
            where customer_id = :customer_id
            ";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':customer_id' => $customer_id));
    foreach ($sth as $lastbuydateto);
    return $lastbuydateto[date];
}

// ยอดเงินของ agency
function agencybalance($member)
{
    include "connection.php";
    $sql = "select agency_balance from agency
            where member_id = :member_id
            ";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':member_id' => $member));
    foreach ($sth as $result);
    return $result[agency_balance];
}

// % คอมมิชชั่น
function commission()
{
    include "connection.php";
    $sql = "select * from config
            where config_name = :config_name
            ";
    $sth = $pdo->prepare($sql);
    $sth->execute(array(':config_name' => 'commission'));
    foreach ($sth as $result);
    return $result[config_value];
}