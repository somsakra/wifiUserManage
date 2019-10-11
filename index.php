<? include "configbegin.php"; ?>

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
            <h4 class="mb-0 text-gray-800">Dashboard</h4>
          </div>

          <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
              <a href="customer.php">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="font-weight-bold text-primary text-uppercase mb-1">ลูกค้า</div>

                      </div>
                      <div class="col-auto">
                        <i class="fas fa-user-friends fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <? if (memberprivilege($_SESSION[wififirst_id])=='agency') { ?>
              <div class="col-xl-3 col-md-6 mb-4">

                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="font-weight-bold text-primary text-uppercase mb-1">Balance : <?= number_format(agencybalance($member[0])) . " บาท"; ?></div>

                      </div>
                      <div class="col-auto">
                        <i class="fas fa-money-check-alt fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
            <? } ?>






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
  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>