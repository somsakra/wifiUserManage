<? include "configbegin.php";
$today = date("Y-m-d"); // วันนี้
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
                        <h4 class="mb-0 text-gray-800">Package</h4>
                        <div>
                            <input type="button" value="เพิ่ม Package" class=" btn btn-primary shadow-sm" data-toggle="modal" data-target="#Add">
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">รายชื่อ Package</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="bg-gradient-primary text-gray-100">#</th>
                                            <th class="bg-gradient-primary text-gray-100">ชื่อ</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $sql = "select * from package order by package_price 
                                        ";
                                        $sth = $pdo->prepare($sql);
                                        $sth->execute();
                                        foreach ($sth as $package) {
                                            ?>
                                            <tr>
                                                <td><? $i++;
                                                    echo "<a href='package_detail.php?package=$package[package_id]'>$i</a>"; ?></td>
                                                <td><?= "<a href='package_detail.php?package=$package[package_id]'>$package[package_name]</a>"; ?></td>

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
    <div class="modal fade" id="Add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่ม Package ใหม่</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="managepackage.php" method="POST">
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="package_name" class="col-sm-4 col-form-label">ชื่อ Package</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="package_name" name="package_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="package_price" class="col-sm-4 col-form-label">ราคา</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="package_price" name="package_price">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="	package_day" class="col-sm-4 col-form-label">จำนวนวัน</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="package_day" name="package_day">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="package_upload" class="col-sm-4 col-form-label">ความเร็ว Upload</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="package_upload" name="package_upload">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="package_download" class="col-sm-4 col-form-label">ความเร็ว Download</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="package_download" name="package_download">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="package_device" class="col-sm-4 col-form-label">จำนวนอุปกรณ์</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="package_device" name="package_device">
                            </div>
                        </div>
                        

                        <div class="form-group row">
                            <label for="package_active" class="col-sm-4 col-form-label">เปิดใช้งาน</label>
                            <div class="col-sm-8 pt-2">
                                <input type="checkbox" value="y" id="package_active" name="package_active">
                                <label class="form-check-label" for="package_active">เปิดใช้งาน Package นี้</label>
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