<? include "configbegin.php";
if(memberprivilege($_SESSION[wififirst_id])!='1'){echo "<META http-equiv='refresh' content='0;URL=  index.php'> "; exit();}
?>

<!DOCTYPE html>
<html lang="en">

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
                        <h4 class="mb-0 text-gray-800">ข้อมูล Agency</h4>
                        <div>
                            <input type="button" value="เพิ่ม Agency ใหม่" class=" btn btn-primary shadow-sm" data-toggle="modal" data-target="#AddNewagencyModal">
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">รายชื่อ Agency</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="bg-gradient-primary text-gray-100">#</th>
                                            <th class="bg-gradient-primary text-gray-100">ชื่อ</th>
                                            <th class="bg-gradient-primary text-gray-100">โทรศัพท์</th>
                                            <th class="bg-gradient-primary text-gray-100">ยอดเงิน</th>
                                            <th class="bg-gradient-primary text-gray-100">สถานะ</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $sql = "select * from agency
                                        left join member on member.member_id = agency.member_id
                                        order by agency.member_id desc
                                        ";
                                        $sth = $pdo->prepare($sql);
                                        $sth->execute();
                                        foreach ($sth as $agency) {
                                            ?>
                                            <tr>
                                                <td><? $i++;
                                                echo "<a href='agency_detail.php?id=$agency[member_id]'>" . $i; ?></td>
                                                <td><?= "<a href='agency_detail.php?id=$agency[member_id]'>$agency[member_name] $agency[member_surname]</a>"; ?></td>
                                                <td><?= $agency[member_tel]; ?></td>
                                                <td><?= $agency[agency_balance]; ?></td>
                                                <td><? if ($agency[member_active] == 'y') {
                                                        echo "อนุญาตให้ใช้งาน";
                                                    } else {
                                                        echo "ไม่อนุญาต";
                                                    } ?></td>
                                            </tr>
                                        <? } ?>
                                    </tbody>
                                </table>
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


    <!-- Add New  Modal -->
    <div class="modal fade" id="AddNewagencyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่ม Agency ใหม่</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="manageagency.php" method="POST">
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="member_name" class="col-sm-3 col-form-label">ชื่อ</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="member_name" name="member_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="member_surname" class="col-sm-3 col-form-label">นามสกุล</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="member_surname" name="member_surname">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="member_address" class="col-sm-3 col-form-label">ที่อยู่</label>
                            <div class="col-sm-9">
                                <textarea name="member_address" id="member_address" rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="member_tel" class="col-sm-3 col-form-label">โทรศัพท์</label>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" id="member_tel" name="member_tel">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="member_username" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="member_username" name="member_username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="member_password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="member_password" name="member_password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="member_active" class="col-sm-3 col-form-label">สถานะ</label>
                            <div class="col-sm-9 pt-2">
                                <input type="checkbox" value="y" id="member_active" name="member_active">
                                <label class="form-check-label" for="member_active">อนุญาตให้ใช้งาน</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="agency_commission" class="col-sm-3 col-form-label">คอมมิชชั่น</label>
                            <div class="col-sm-9 pt-2">
                                <input type="checkbox" value="y" id="agency_commission" name="agency_commission">
                                <label class="form-check-label" for="agency_commission">คิดค่าคอมมิชชั่น</label>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="Submit">Submit</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <input type="hidden" name="action" value="add">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>