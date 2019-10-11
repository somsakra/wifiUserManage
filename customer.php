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
                        <h4 class="mb-0 text-gray-800">ข้อมูลลูกค้า</h4>
                        <div>
                            <input type="button" value="เพิ่มลูกค้าใหม่" class=" btn btn-primary shadow-sm" data-toggle="modal" data-target="#AddNewagencyModal">
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">รายชื่อลูกค้า</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="bg-gradient-primary text-gray-100">#</th>
                                            <th class="bg-gradient-primary text-gray-100">ชื่อ</th>
                                            <th class="bg-gradient-primary text-gray-100">โทรศัพท์</th>
                                            <th class="bg-gradient-primary text-gray-100">กลุ่มลูกค้า</th>
                                            <th class="bg-gradient-primary text-gray-100">วันสิ้นสุดแพคเกจ</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $sql = "select * from customer
                                        left join customergroup on customergroup.customergroup_id = customer.customergroup_id
                                        order by customer_id desc
                                        ";
                                        $sth = $pdo->prepare($sql);
                                        $sth->execute();
                                        foreach ($sth as $customer) {
                                            ?>
                                            <tr>
                                                <td><? $i++;
                                                    echo "<a href='customer_detail.php?customer=$customer[customer_id]'>" . $i; ?></td>
                                                <td><?= "<a href='customer_detail.php?customer=$customer[customer_id]'>$customer[customer_name] $customer[customer_surname]</a>"; ?></td>
                                                <td><?= $customer[customer_tel]; ?></td>
                                                <td><?= $customer[customergroup_name]; ?></td>
                                                <td><?  $expiredate = lastbuydateto($customer[customer_id]);
                                                        if($expiredate>=$today){echo $expiredate;} ?>
                                                </td>
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
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มลูกค้าใหม่</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="managecustomer.php" method="POST">
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="customer_name" class="col-sm-3 col-form-label">ชื่อ</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="customer_name" name="customer_name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_surname" class="col-sm-3 col-form-label">นามสกุล</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="customer_surname" name="customer_surname">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_address" class="col-sm-3 col-form-label">ที่อยู่</label>
                            <div class="col-sm-9">
                                <textarea name="customer_address" id="customer_address" rows="2" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_tel" class="col-sm-3 col-form-label">โทรศัพท์</label>
                            <div class="col-sm-9">
                                <input type="tel" class="form-control" id="customer_tel" name="customer_tel">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_username" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="customer_username" name="customer_username">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customer_password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="customer_password" name="customer_password">
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
                                    foreach ($sth as $customergroup) {
                                        echo "<option value='$customergroup[customergroup_id]'>$customergroup[customergroup_name]</option>";
                                    } ?>
                                </select>
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