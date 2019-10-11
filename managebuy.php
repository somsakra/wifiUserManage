<?
include "configbegin.php";

if ($_POST[action] == 'buy') {

        $today = date("Y-m-d"); // วันนี้

        // แพคเกจที่ซื้อ
        $sql = "select * from package
            where package_id = :package_id
            ";
        $sth = $pdo->prepare($sql);
        $sth->execute(array(':package_id' => $_POST[package_id]));
        foreach ($sth as $package);

        // ตรวจสอบว่ายอดเงินของ agency พอหรือไม่
        if ((memberprivilege($_SESSION[wififirst_id]) == 'agency') and $package[package_price] > agencybalance($_SESSION[wififirst_id])) {
                echo "<meta http-equiv='refresh' content='0;URL=customer_detail.php?customer=$_POST[customer_id]&status=notenoughmoney'>";
                exit();
        }

        // ตรวจสอบวันสุดท้ายของแพคเกจที่ซื้อ
        $lastbuydateto = lastbuydateto($_POST[customer_id]);

        // วันเริ่มต้น Package
        if ($today >= $lastbuydateto) {
                $buy_datefrom = $today;
        } else {
                $buy_datefrom = date("Y-m-d", strtotime("+1 day", strtotime($lastbuydateto)));
        }

        // วันสิ้นสุด Package
        $day = $package[package_day] - 1;
        $buy_dateto = date("Y-m-d", strtotime("+$day day", strtotime($buy_datefrom)));

        // คำนวนค่าใช้จ่าย
        if ($member[2] == 'y') 
        {
                $buy_commission = $package[package_price] / 100 * commission(); // ค่าคอมมิชชั่นของ Agency
                $buy_payment = $package[package_price] - $buy_commission; // ยอดเงินที่ Agency จ่ายจริง
        } else {
                $buy_commission = 0; // ค่าคอมมิชชั่นของ Agency
                $buy_payment = $package[package_price]; // ยอดเงินที่ Agency จ่ายจริง
        }

        $sql = "insert into buy(
            member_id,
            customer_id,
            package_id,
            buy_datefrom,
            buy_dateto,
            buy_note,
            buy_price,
            buy_commission,
            buy_payment
            ) values (
            :member_id,
            :customer_id,
            :package_id,
            :buy_datefrom,
            :buy_dateto,
            :buy_note,
            :buy_price,
            :buy_commission,
            :buy_payment
            )";
        $sth = $pdo->prepare($sql);
        $sth->execute(array(
                ':member_id' => $_SESSION[wififirst_id],
                ':customer_id' => $_POST[customer_id],
                ':package_id' => $_POST[package_id],
                ':buy_datefrom' => $buy_datefrom,
                ':buy_dateto' => $buy_dateto,
                ':buy_note' => $_POST[buy_note],
                ':buy_price' => $package[package_price],
                ':buy_commission' => $buy_commission,
                ':buy_payment' => $buy_payment
        ));

        $sql = "    update agency 
                set agency_balance = agency_balance - $buy_payment
                where member_id = :member_id
                ";
        $sth = $pdo->prepare($sql);
        $sth->execute(array(':member_id' => $_SESSION[wififirst_id]));
        echo "<meta http-equiv='refresh' content='0;URL=buy_history.php?customer=$_POST[customer_id]'>";
}
