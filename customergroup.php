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
                        <h4 class="mb-0 text-gray-800">ข้อมูลกลุ่มลูกค้า</h4>
                        <div>
                            <input type="button" value="เพิ่มกลุ่มลูกค้าใหม่" class=" btn btn-primary shadow-sm" data-toggle="modal" data-target="#AddNewModal">
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">รายชื่อกลุ่มลูกค้า</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="bg-gradient-primary text-gray-100">#</th>
                                            <th class="bg-gradient-primary text-gray-100">ชื่อกลุ่ม</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $sql = "select * from customergroup
                                        order by customergroup_name
                                        ";
                                        $sth = $pdo->prepare($sql);
                                        $sth->execute();
                                        foreach ($sth as $customergroup) {
                                            ?>
                                            <tr>
                                                <td><? $i++;
                                                    echo "<a href='customergroup_detail.php?customergroup=$customergroup[customergroup_id]'>" . $i; ?></td>
                                                <td><?= "<a href='customergroup_detail.php?customergroup=$customergroup[customergroup_id]'>$customergroup[customergroup_name] $customergroup[customergroup_surname]</a>"; ?></td>
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
    <div class="modal fade" id="AddNewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มกลุ่มลูกค้าใหม่</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="managecustomergroup.php" method="POST">
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="customergroup_name" class="col-sm-3 col-form-label">ชื่อกลุ่มลูกค้า</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="customergroup_name" name="customergroup_name">
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