<? include "configbegin.php";
$sql = "select * from agency    
where agency_id = :agency_id";
$sth = $pdo->prepare($sql);
$sth->execute(array(':agency_id' => $_GET[agency]));
foreach ($sth as $agency);
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
                        <h4 class="mb-0 text-gray-800"><?= "ข้อมูลการเติมเงินของ $agency[agency_name] $agency[agency_surname]"; ?></h4>
                        <h4 class="mb-0 text-gray-800"><?= "ยอดเงินปัจจุบัน ".number_format($agency[agency_balance])." ฿"; ?></h4>
                       
                        <div>
                        <input type="button" value="เติมเงิน" class=" btn btn-primary shadow-sm" data-toggle="modal" data-target="#AddNewbalanceModal">
                            <a href="agency_detail.php?id=<?= $_GET[member]; ?>" class=" btn btn-primary shadow-sm">กลับ</a>
                        </div>
                    </div>



                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">ข้อมูลการเติมเงิน</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="bg-gradient-primary text-gray-100">#</th>
                                            <th class="bg-gradient-primary text-gray-100">วัน เวลา</th>
                                            <th class="bg-gradient-primary text-gray-100">ยอดเงิน (฿)</th>
                                            <th class="bg-gradient-primary text-gray-100">ผู้ทำรายการ</th>
                                            <th class="bg-gradient-primary text-gray-100">หมายเหตุ</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $sql = "select * from topup
                                                left join member on member.member_id = topup.member_id
                                                where agencymember_id = :agency_id
                                                order by topup_datetime desc
                                        ";
                                        $sth = $pdo->prepare($sql);
                                        $sth->execute(array('agency_id' => $_GET[member]));
                                        foreach ($sth as $topup) {
                                            ?>
                                            <tr>
                                                <td><?= ++$i; ?></td>
                                                <td><?= $topup[topup_datetime]; ?></td>
                                                <td><?= number_format($topup[topup_amount]); ?></td>
                                                <td><?= "$topup[member_name] $topup[member_surname]"; ?></td>
                                                <td><?= $topup[topup_note]; ?></td>
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
    <div class="modal fade" id="AddNewbalanceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เติมเงิน</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="managebalance.php" method="POST">
                    <div class="modal-body">

                        <div class="form-group row">
                            <label for="topup_amount" class="col-sm-3 col-form-label">ยอดเงิน</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="topup_amount" name="topup_amount">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="topup_note" class="col-sm-3 col-form-label">หมายเหตุ</label>
                            <div class="col-sm-9">
                                <textarea name="topup_note" id="topup_note" rows="2" class="form-control"></textarea>
                            </div>


                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="Submit">Submit</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="agencymember_id" value="<?= $_GET[member]; ?>">
                        </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>