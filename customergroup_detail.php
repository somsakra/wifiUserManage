<? include "configbegin.php";
$sql = "select * from customergroup  where customergroup_id = :customergroup_id";
$sth = $pdo->prepare($sql);
$sth->execute(array(':customergroup_id' => $_GET[customergroup]));
foreach ($sth as $customergroup);
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
                        <h4 class="mb-0 text-gray-800"><?= "ข้อมูลของลูกค้า : $customergroup[customergroup_name]"; ?></h4>
                        <div>
                            <a href="customergroup.php" class=" btn btn-primary shadow-sm">กลับ</a>
                        </div>
                    </div>

              

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลกลุ่มลูกค้า</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>ชื่อกลุ่มลูกค้า</strong></div>
                                <div class="col"><?= "$customergroup[customergroup_name]"; ?></div>
                            </div>
                           
                            <div class="row mt-2">
                                <div class="col">
                                    <input type="button" value="แก้ไขข้อมูลกลุ่มลูกค้า" class="btn btn-primary" data-toggle="modal" data-target="#EditcustomerModal">
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
    <div class="modal fade" id="EditcustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลกลุ่มลูกค้า</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="managecustomergroup.php" method="POST">
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="customer_name" class="col-sm-3 col-form-label">ชื่อกลุ่มลูกค้า</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="customergroup_name" name="customergroup_name" value=<?= $customergroup[customergroup_name]; ?>>
                            </div>
                        </div>
                      
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">ลบกลุ่มลูกค้า</label>
                            <div class="col-sm-9">
                                <a href="managecustomergroup.php?action=delete&customergroup=<?= $customergroup[customergroup_id]; ?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบกลุ่มลูกค้านี้');">ลบบัญชีกลุ่มลูกค้านี้</a>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="Submit">Submit</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="customergroup_id" value="<?= $_GET[customergroup]; ?>">
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
                                    $sql = "select * from package where package_active = 'y' order by package_price";
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
                        <input type="hidden" name="customer_id" value="<?= $_GET[customer]; ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>