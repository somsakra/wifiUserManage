<? include "configbegin.php"; ?>
<!DOCTYPE html>
<html lang="th">

<head>
    <?
    $strExcelFileName = "Sell_Report.xls";
    header("Content-Type: application/x-msexcel; name=\"$strExcelFileName\"");
    header("Content-Disposition: inline; filename=\"$strExcelFileName\"");
    header("Pragma:no-cache");
    ?>

</head>

<body>
    <table width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>#</th>
                <th>วันเวลา</th>
                <th>ชื่อลูกค้า</th>
                <th>แพคเกจ</th>
                <th>ราคา</th>
                <th>Commission</th>
                <th>จ่ายจริง</th>
                <th>วันเริ่มต้น</th>
                <th>วันสิ้นสุด</th>
                <th>ผู้ขาย</th>
                <th>หมายเหตุ</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $sql = "select * from buy
                    left join member on member.member_id = buy.member_id
                    left join customer on customer.customer_id = buy.customer_id
                    left join package on package.package_id = buy.package_id
                    where 1
                ";
            if ($_POST[datefrom]) {$sql .= " and buy_datetime >= :datefrom";}
            if ($_POST[dateto]) {$sql .= " and buy_datetime <= :dateto";}
            if ($_POST[package_id]) {$sql .= " and buy.package_id = :package_id";}
            if ($_POST[member_id]) {$sql .= " and buy.member_id = :member_id";}
            if ($_POST[customergroup_id]) {$sql .= " and customergroup_id = :customergroup_id";}
            $sql .= " order by buy_datetime desc";
            $sth = $pdo->prepare($sql);
            if ($_POST[datefrom]) {$datefrom = $_POST[datefrom]." 00:00:00"; $sth->bindParam(':datefrom', $datefrom);}
            if ($_POST[dateto]) {$dateto = $_POST[dateto]." 23:59:59"; $sth->bindParam(':dateto', $dateto);}
            if ($_POST[package_id]) {$sth->bindParam(':package_id',$_POST[package_id]);}
            if ($_POST[member_id]) {$sth->bindParam(':member_id',$_POST[member_id]);}
            if ($_POST[customergroup_id]) {$sth->bindParam(':customergroup_id',$_POST[customergroup_id]);}
            $sth->execute();
            foreach ($sth as $buy) {
                ?>
                <tr>
                    <td><?= ++$i; ?></td>
                    <td><?= $buy[buy_datetime] ?></td>
                    <td><?= "$buy[customer_name] $buy[customer_surname]"; ?></td>
                    <td><?= $buy[package_name] ?></td>
                    <td><?= $buy[buy_price] ?></td>
                    <td><?= $buy[buy_commission] ?></td>
                    <td><?= $buy[buy_payment] ?></td>
                    <td><?= $buy[buy_datefrom] ?></td>
                    <td><?= $buy[buy_dateto] ?></td>
                    <td><?= "$buy[member_name] $buy[member_surname]"; ?></td>
                    <td><?= $buy[buy_note] ?></td>
                </tr>
            <? } ?>
        </tbody>
    </table>
</body>

</html>