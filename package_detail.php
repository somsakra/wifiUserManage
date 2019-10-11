<? include "configbegin.php";
$sql = "select * from package where package_id = :package_id";
$sth = $pdo->prepare($sql);
$sth->execute(array(':package_id' => $_GET[package]));
foreach ($sth as $package);
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
                        <h4 class="mb-0 text-gray-800"><?= "ข้อมูล Package : $package[package_name]"; ?></h4>
                        <div>
                            <a href="package.php" class=" btn btn-primary shadow-sm">กลับ</a>
                        </div>
                    </div>

        
   

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">ข้อมูล Package</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>ชื่อ Package</strong></div>
                                <div class="col"><?= "$package[package_name]"; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>ราคา</strong></div>
                                <div class="col"><?= $package[package_price]; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>จำนวนวัน</strong></div>
                                <div class="col"><?= $package[package_day]; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>ความเร็ว Upload</strong></div>
                                <div class="col"><?= $package[package_upload]; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>ความเร็ว Download</strong></div>
                                <div class="col"><?= $package[package_download]; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>จำนวนอุปกรณ์</strong></div>
                                <div class="col"><?= $package[package_device]; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>เปิดใช้งาน</strong></div>
                                <div class="col"><? if($package[package_active]=='y'){echo "เปิดใช้งาน";} ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <input type="button" value="แก้ไขข้อมูล Package" class="btn btn-primary" data-toggle="modal" data-target="#EditpackageModal">
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
    <div class="modal fade" id="EditpackageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล Package</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="managepackage.php" method="POST">
                    <div class="modal-body">

                    <div class="form-group row">
                            <label for="package_name" class="col-sm-4 col-form-label">ชื่อ Package</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="package_name" name="package_name" value="<?=$package[package_name];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="package_price" class="col-sm-4 col-form-label">ราคา</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="package_price" name="package_price" value="<?=$package[package_price];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="	package_day" class="col-sm-4 col-form-label">จำนวนวัน</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="package_day" name="package_day" value="<?=$package[package_day];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="package_upload" class="col-sm-4 col-form-label">ความเร็ว Upload</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="package_upload" name="package_upload" value="<?=$package[package_upload];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="package_download" class="col-sm-4 col-form-label">ความเร็ว Download</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="package_download" name="package_download" value="<?=$package[package_download];?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="package_device" class="col-sm-4 col-form-label">จำนวนอุปกรณ์</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="package_device" name="package_device" value="<?=$package[package_device];?>">
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="package_active" class="col-sm-4 col-form-label">เปิดใช้งาน</label>
                            <div class="col-sm-8 pt-2">
                                <input type="checkbox" value="y" id="package_active" name="package_active" <? if($package[package_active]=='y'){echo "checked";} ?>>
                                <label class="form-check-label" for="package_active">เปิดใช้งาน Package นี้</label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">ลบ Package</label>
                            <div class="col-sm-8">
                                <a href="managepackage.php?action=delete&package=<?= $package[package_id]; ?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบ Package นี้');">ลบ Package นี้</a>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="Submit">Submit</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="package_id" value="<?= $_GET[package]; ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Buy  Modal -->
    <div class="modal fade" id="buyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ซื้อแพคเกจ</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="managebuy.php" method="POST">
                    <div class="modal-body">


                        <div class="form-group row">
                            <label for="package_id" class="col-sm-3 col-form-label">แพคเกจ</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="package_id" name="package_id">
                                    <option value=""></option>
                                    <?
                                    $sql = "select * from package order by package_price";
                                    $sth = $pdo->prepare($sql);
                                    $sth->execute();
                                    foreach ($sth as $package) { ?>
                                        <option value="<?= $package[package_id]; ?>"><?= "แพคเกจ $package[package_name] ราคา $package[package_price] ฿"; ?></option>
                                    <? } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="buy_note" class="col-sm-3 col-form-label">หมายเหตุ</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="buy_note" name="buy_note">
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="Submit">Submit</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <input type="hidden" name="action" value="buy">
                        <input type="hidden" name="package_id" value="<?= $_GET[package]; ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>