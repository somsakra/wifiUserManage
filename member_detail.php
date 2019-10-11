<? include "configbegin.php";
$sql = "select * from admin
        left join member on member.member_id = admin.member_id
        left join privilege on privilege.privilege_id = admin.privilege_id
        where admin.member_id = :member_id";
$sth = $pdo->prepare($sql);
$sth->execute(array(':member_id' => $_GET[id]));
foreach ($sth as $member);
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
                    <h4 class=" mb-4 text-gray-800"><?= "ข้อมูลของพนักงาน : $member[member_name] $member[member_surname]"; ?></h4>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลส่วนตัว</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>ชื่อ - นามสกุล</strong></div>
                                <div class="col"><?= "$member[member_name] $member[member_surname]"; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>แผนก</strong></div>
                                <div class="col"><?= $member[admin_department]; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>โทรศัพท์</strong></div>
                                <div class="col"><?= $member[member_tel]; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>ที่อยู่</strong></div>
                                <div class="col"><?= $member[member_address]; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>สิทธิ์</strong></div>
                                <div class="col"><?= $member[privilege_name]; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>Username</strong></div>
                                <div class="col"><?= $member[member_username]; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>สถานะ</strong></div>
                                <div class="col"><? if ($member[member_active] == 'y') {
                                                        echo "อนุญาตให้ใช้งาน";
                                                    } else {
                                                        echo "ไม่อนุญาต";
                                                    } ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <input type="button" value="แก้ไขข้อมูลพนักงาน" class="btn btn-primary" data-toggle="modal" data-target="#EditMemberModal">
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
    <div class="modal fade" id="EditMemberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลพนักงาน</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="manageadmin.php" method="POST">
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="member_name" class="col-sm-3 col-form-label">ชื่อ</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="member_name" name="member_name" required value=<?= $member[member_name]; ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="member_surname" class="col-sm-3 col-form-label">นามสกุล</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="member_surname" name="member_surname" required value=<?= $member[member_surname]; ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="admin_department" class="col-sm-3 col-form-label">แผนก</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="admin_department" name="admin_department" value=<?= $member[admin_department]; ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="member_address" class="col-sm-3 col-form-label">ที่อยู่</label>
                            <div class="col-sm-9">
                                <textarea name="member_address" id="member_address" rows="2" class="form-control"><?= $member[member_address]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="member_tel" class="col-sm-3 col-form-label">โทรศัพท์</label>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" id="member_tel" name="member_tel" value=<?= $member[member_tel]; ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="privilege_id" class="col-sm-3 col-form-label">สิทธิ์</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="privilege_id" name="privilege_id" required>
                                    <option value=""></option>
                                    <?
                                    $sql = "select * from privilege";
                                    $sth = $pdo->prepare($sql);
                                    $sth->execute();
                                    foreach ($sth as $privilege) { ?>
                                        <option <? if ($privilege[privilege_id] == $member[privilege_id]) {
                                                    echo "selected";
                                                } ?> value="<?= $privilege[privilege_id]; ?>"><?= $privilege[privilege_name]; ?></option>
                                    <? } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="member_username" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="member_username" name="member_username" required value=<?= $member[member_username]; ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="member_password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" id="member_password"   name="member_password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="member_active" class="col-sm-3 col-form-label">สถานะ</label>
                            <div class="col-sm-9 pt-2">
                                <input type="checkbox" value="y" id="member_active" name="member_active" <? if ($member[member_active] == 'y') {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                                <label class="form-check-label" for="member_active">อนุญาตให้ใช้งาน</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="agency_password" class="col-sm-3 col-form-label">ลบบัญชีผู้ใช้</label>
                            <div class="col-sm-9">
                                <a href="manageadmin.php?action=delete&member=<?=$member[member_id];?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบบัญชีนี้');">ลบบัญชีผู้ใช้นี้</a>
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