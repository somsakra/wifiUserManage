<?
session_start();
include "connection.php";
include "function.php";

// ตรวจสอบ Login
if (!checklogin()) {echo "<meta http-equiv='refresh' content='0;URL=login.php'>";exit();}

// ข้อมูล User ที่ Login
$member = userdetail($_SESSION[wififirst_id]);
?>