<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-wifi"></i>
    </div>
    <div class="sidebar-brand-text mx-3">WiFI First</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Task
  </div>


  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <i class="fas fa-user fa-cog"></i>
      <span>บุคคล</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded"> 
        <a class="collapse-item" href="customer.php">ลูกค้า</a>
        <? if(memberprivilege($_SESSION[wififirst_id])=='1'){ echo "<a class='collapse-item' href='customergroup.php'>กลุ่มลูกค้า</a>";}?>
        <? if(memberprivilege($_SESSION[wififirst_id])=='1'){ echo "<a class='collapse-item' href='agency.php'>Agency</a>";}?>
        <? if(memberprivilege($_SESSION[wififirst_id])=='1'){ echo "<a class='collapse-item' href='member.php'>พนักงาน</a>";}?>
      </div>
    </div>
  </li>

  <? if(memberprivilege($_SESSION[wififirst_id])=='1'){ ?><li class="nav-item"><a class="nav-link" href="package.php"><i class="fas fa-fw fa-paste"></i><span>Package</span></a></li><? } ?>
  


  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Report
  </div>

  <!-- Nav Item - Charts -->
  <li class="nav-item"><a class="nav-link" href="report_topup.php"><i class="fas fa-fw fa-chart-area"></i><span>การเติมเงิน</span></a></li>
  <li class="nav-item"><a class="nav-link" href="report_sell.php"><i class="fas fa-fw fa-chart-area"></i><span>การขาย</span></a></li>



  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>