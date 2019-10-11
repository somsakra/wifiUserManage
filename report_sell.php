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
                        <h4 class="mb-0 text-gray-800">ข้อมูลการขาย</h4>
                      
                    </div>

                    <? if(memberprivilege($_SESSION[wififirst_id])=='1' or memberprivilege($_SESSION[wififirst_id])=='2'){?>
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <a href="#" data-toggle="modal" data-target="#exportsellreportModal">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                            <div class="col mr-2">
                                                <div class="font-weight-bold text-primary text-uppercase mb-1">Export การขาย</div>

                                            </div>
                                            <div class="col-auto">
                                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <? } ?>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">รายการขายทั้งหมด</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="bg-gradient-primary text-gray-100">#</th>
                                            <th class="bg-gradient-primary text-gray-100">วันเวลา</th>
                                            <th class="bg-gradient-primary text-gray-100">ชื่อลูกค้า</th>
                                            <th class="bg-gradient-primary text-gray-100">แพคเกจ</th>
                                            <th class="bg-gradient-primary text-gray-100">วันเริ่มต้น</th>
                                            <th class="bg-gradient-primary text-gray-100">วันสิ้นสุด</th>
                                            <th class="bg-gradient-primary text-gray-100">ผู้ขาย</th>                                            
                                            <th class="bg-gradient-primary text-gray-100">หมายเหตุ</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $sql = "select * from buy
                                                left join member on member.member_id = buy.member_id
                                                left join customer on customer.customer_id = buy.customer_id
                                                left join package on package.package_id = buy.package_id
                                                where 1
                                                
                                        ";
                                        if(memberprivilege($_SESSION[wififirst_id])=='agency'){$sql.=" and buy.member_id = :member_id";}
                                        $sql.=" order by buy_datetime desc";
                                        $sth = $pdo->prepare($sql);
                                        if(memberprivilege($_SESSION[wififirst_id])=='agency'){$sth->bindParam(':member_id',$_SESSION[wififirst_id]);}
                                        $sth->execute();
                                        foreach ($sth as $buy) {
                                            ?>
                                            <tr>
                                                <td><?= ++$i; ?></td>
                                                <td><?= $buy[buy_datetime] ?></td>
                                                <td><?="$buy[customer_name] $buy[customer_surname]";?></td>
                                                <td><?= $buy[package_name] ?></td>
                                                <td><?= $buy[buy_datefrom] ?></td>
                                                <td><?= $buy[buy_dateto] ?></td>
                                                <td><?="$buy[member_name] $buy[member_surname]";?></td>
                                                
                                                <td><?= $buy[buy_note] ?></td>
                                               
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


    <!-- Export Report Modal -->
    <div class="modal fade" id="exportsellreportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เลือกข้อมูลที่ต้องการ</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="report_sell_export_excel.php" method="POST">
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="datefrom" class="col-sm-3 col-form-label">วันที่ทำรายการ</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="datefrom" name="datefrom">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dateto" class="col-sm-3 col-form-label">ถึงวันที่</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="dateto" name="dateto">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="package_id" class="col-sm-3 col-form-label">Package</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="package_id" name="package_id">
                                    <option value=""></option>
                                    <?
                                    $sql = "select * from package";
                                    $sth = $pdo->prepare($sql);
                                    $sth->execute();
                                    foreach ($sth as $package) {
                                        echo "<option value='$package[package_id]'>$package[package_name]</option>";
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="member_id" class="col-sm-3 col-form-label">ผู้ขาย</label>
                            <div class="col-sm-9">
                            <select class="form-control" id="member_id" name="member_id">
                                    <option value=""></option>
                                    <?
                                    $sql = "select * from agency
                                            left join member on member.member_id = agency.member_id
                                            ";
                                    $sth = $pdo->prepare($sql);
                                    $sth->execute();
                                    foreach ($sth as $agency) {
                                        echo "<option value='$agency[member_id]'>$agency[member_name] $agency[member_surname]</option>";
                                    } ?>
                                </select>
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