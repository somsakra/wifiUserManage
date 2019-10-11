<? include "configbegin.php";
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
                        <h4 class="mb-0 text-gray-800">ข้อมูลการเติมเงิน</h4>
                      
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">รายการเติมเงินทั้งหมด</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="bg-gradient-primary text-gray-100">#</th>
                                            <th class="bg-gradient-primary text-gray-100">วันเวลา</th>
                                            <th class="bg-gradient-primary text-gray-100">เติมเงินให้</th>
                                            <th class="bg-gradient-primary text-gray-100">จำนวนเงิน</th>
                                            <th class="bg-gradient-primary text-gray-100">ผู้ทำรายการ</th>                                            
                                            <th class="bg-gradient-primary text-gray-100">หมายเหตุ</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $sql = "select  topup.topup_datetime,
                                                        topup.topup_amount,
                                                        topup.topup_note,
                                                        admin.member_name as admin_name,
                                                        admin.member_surname as admin_surname,
                                                        agency.member_name as agency_name,
                                                        agency.member_surname as agency_surname
                                                from topup
                                                left join member admin on admin.member_id = topup.member_id
                                                left join member agency on agency.member_id = topup.agencymember_id
                                                where 1
                                        ";
                                        if(memberprivilege($_SESSION[wififirst_id])=='agency'){$sql.=" and agencymember_id = :agencymember_id";}
                                        $sql.=" order by topup_datetime desc";
                                        $sth = $pdo->prepare($sql);
                                        if(memberprivilege($_SESSION[wififirst_id])=='agency'){$sth->bindParam(':agencymember_id',$_SESSION[wififirst_id]);}
                                        $sth->execute();
                                        foreach ($sth as $topup) {
                                            ?>
                                            <tr>
                                                <td><?= ++$i; ?></td>
                                                <td><?= $topup[topup_datetime] ?></td>
                                                <td><?="$topup[agency_name] $topup[agency_surname]";?></td>
                                                <td><?= $topup[topup_amount] ?></td>
                                                <td><?="$topup[admin_name] $topup[admin_surname]";?></td>
                                                
                                                <td><?= $topup[topup_note] ?></td>
                                               
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