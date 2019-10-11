<? include "configbegin.php";
$sql = "select * from agency  
left join member on member.member_id = agency.member_id  
where member.member_id = :member_id";
$sth = $pdo->prepare($sql);
$sth->execute(array(':member_id' => $_GET[id]));
foreach ($sth as $agency);
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <? include "confighead.php"; ?>


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <? include "sidebar.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <? include "topbar.php"; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h4 class="mb-0 text-gray-800"><?= "ข้อมูลของ Agency : $agency[agency_name] $agency[agency_surname]"; ?></h4>
                        <div>
                            <a href="agency.php" class=" btn btn-primary shadow-sm">กลับ</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="balance.php?member=<?= $agency[member_id]; ?>">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="font-weight-bold text-primary text-uppercase mb-1">ยอดเงิน</div>
                                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($agency[agency_balance]); ?> ฿ื</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-credit-card fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </a>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลส่วนตัว</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>ชื่อ - นามสกุล</strong></div>
                                <div class="col"><?= "$agency[member_name] $agency[member_surname]"; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>โทรศัพท์</strong></div>
                                <div class="col"><?= $agency[member_tel]; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>ที่อยู่</strong></div>
                                <div class="col"><?= $agency[member_address]; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>Username</strong></div>
                                <div class="col"><?= $agency[member_username]; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>สถานะ</strong></div>
                                <div class="col"><? if ($agency[member_active] == 'y') {
                                                        echo "อนุญาตให้ใช้งาน";
                                                    } else {
                                                        echo "ไม่อนุญาต";
                                                    } ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>คอมมิชชั่น</strong></div>
                                <div class="col"><? if ($agency[agency_commission] == 'y') {
                                                        echo "คิดค่าคอมมิชชั่น";
                                                    } else {
                                                        echo "ไม่คิดค่าคอมมิชชั่น";
                                                    } ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <input type="button" value="แก้ไขข้อมูล Agency" class="btn btn-primary" data-toggle="modal" data-target="#EditagencyModal">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->



    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>


    <!-- Edit  Modal -->
    <div class="modal fade" id="EditagencyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล Agency</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="manageagency.php" method="POST">
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="member_name" class="col-sm-3 col-form-label">ชื่อ</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="member_name" name="member_name" value=<?= $agency[member_name]; ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="member_surname" class="col-sm-3 col-form-label">นามสกุล</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="member_surname" name="member_surname" value=<?= $agency[member_surname]; ?>>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="member_address" class="col-sm-3 col-form-label">ที่อยู่</label>
                            <div class="col-sm-9">
                                <textarea name="member_address" id="member_address" rows="2" class="form-control"><?= $agency[member_address]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="member_tel" class="col-sm-3 col-form-label">โทรศัพท์</label>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" id="member_tel" name="member_tel" value=<?= $agency[member_tel]; ?>>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="member_username" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="member_username" name="member_username" value=<?= $agency[member_username]; ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="member_password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="member_password" name="member_password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="member_active" class="col-sm-3 col-form-label">สถานะ</label>
                            <div class="col-sm-9 pt-2">
                                <input type="checkbox" value="y" id="member_active" name="member_active" <? if ($agency[member_active] == 'y') {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                                <label class="form-check-label" for="member_active">อนุญาตให้ใช้งาน</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="agency_commission" class="col-sm-3 col-form-label">คอมมิชชั่น</label>
                            <div class="col-sm-9 pt-2">
                                <input type="checkbox" value="y" id="agency_commission" name="agency_commission" <? if ($agency[agency_commission] == 'y') {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                                <label class="form-check-label" for="agency_commission">คิดค่าคอมมิชชั่น</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-3 col-form-label">ลบบัญชีผู้ใช้</label>
                            <div class="col-sm-9">
                                <a href="manageagency.php?action=delete&member=<?=$agency[member_id];?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบบัญชีนี้');">ลบบัญชีผู้ใช้นี้</a>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="Submit">Submit</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="member_id" value="<?= $_GET[id]; ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>