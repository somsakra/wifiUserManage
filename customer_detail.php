<? include "configbegin.php";
$sql = "select * from customer  
left join customergroup on customergroup.customergroup_id = customer.customergroup_id
where customer_id = :customer_id";
$sth = $pdo->prepare($sql);
$sth->execute(array(':customer_id' => $_GET[customer]));
foreach ($sth as $customer);
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
                        <h4 class="mb-0 text-gray-800"><?= "ข้อมูลของลูกค้า : $customer[customer_name] $customer[customer_surname]"; ?></h4>
                        <div>
                            <a href="customer.php" class=" btn btn-primary shadow-sm">กลับ</a>
                        </div>
                    </div>
                    <? if ($_GET[status] == 'notenoughmoney') { ?>
                        <div class="row">
                            <div class="col">
                                <div class="alert alert-danger" role="alert">
                                    คุณมียอดเงินไม่เพียงพอในการซื้อแพคเกจนี้
                                </div>
                            </div>
                        </div>
                    <? } ?>
                    <div class="row">

                        <? if (memberprivilege($_SESSION[wififirst_id]) == 'agency') { ?>
                            <div class="col-xl-3 col-md-6 mb-4">
                                <a href="#" data-toggle="modal" data-target="#buyModal">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="font-weight-bold text-primary text-uppercase mb-1">ซื้อแพคเกจ</div>

                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <? } ?>


                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="buy_history.php?customer=<?= $customer[customer_id]; ?>">
                                <div class="card border-left-success shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="font-weight-bold text-primary text-uppercase mb-1">ประวัติการซื้อแพคเกจ</div>
                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-history fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลส่วนตัว</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>ชื่อ - นามสกุล</strong></div>
                                <div class="col"><?= "$customer[customer_name] $customer[customer_surname]"; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>โทรศัพท์</strong></div>
                                <div class="col"><?= $customer[customer_tel]; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>ที่อยู่</strong></div>
                                <div class="col"><?= $customer[customer_address]; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>Username</strong></div>
                                <div class="col"><?= $customer[customer_username]; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-5 col-sm-4 col-md-3 col-lg-2"><strong>กลุ่มลูกค้า</strong></div>
                                <div class="col"><?= $customer[customergroup_name]; ?></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <input type="button" value="แก้ไขข้อมูลลูกค้า" class="btn btn-primary" data-toggle="modal" data-target="#EditcustomerModal">
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
                    <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูลลูกค้า</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="managecustomer.php" method="POST">
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="customer_name" class="col-sm-3 col-form-label">ชื่อ</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="customer_name" name="customer_name" value=<?= $customer[customer_name]; ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_surname" class="col-sm-3 col-form-label">นามสกุล</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="customer_surname" name="customer_surname" value=<?= $customer[customer_surname]; ?>>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="customer_address" class="col-sm-3 col-form-label">ที่อยู่</label>
                            <div class="col-sm-9">
                                <textarea name="customer_address" id="customer_address" rows="2" class="form-control"><?= $customer[customer_address]; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_tel" class="col-sm-3 col-form-label">โทรศัพท์</label>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" id="customer_tel" name="customer_tel" value=<?= $customer[customer_tel]; ?>>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="customer_username" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="customer_username" name="customer_username" value=<?= $customer[customer_username]; ?>>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customergroup_id" class="col-sm-3 col-form-label">กลุ่มลูกค้า</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="customergroup_id" name="customergroup_id">
                                    <option value=""></option>
                                    <?
                                    $sql = "select * from customergroup";
                                    $sth = $pdo->prepare($sql);
                                    $sth->execute();
                                    foreach ($sth as $customergroup) { ?>
                                        <option value='<?= $customergroup[customergroup_id]; ?>' <? if ($customergroup[customergroup_id] == $customer[customergroup_id]) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?= $customergroup[customergroup_name]; ?></option>
                                    <? } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">ลบบัญชีลูกค้า</label>
                            <div class="col-sm-9">
                                <a href="managecustomer.php?action=delete&customer=<?= $customer[customer_id]; ?>" class="btn btn-danger" onclick="return confirm('ยืนยันการลบบัญชีนี้');">ลบบัญชีลูกค้านี้</a>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="Submit">Submit</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="customer_id" value="<?= $_GET[customer]; ?>">
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