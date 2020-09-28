<link rel="stylesheet" href="../css/leftnavbar.css">
<?php
if (isset($_SESSION['roleId'])) {
  if ($_SESSION['roleId'] == 1) {
    echo '
    <div class="sidebar-container">
      <div class="sidebar">
        <div class="sidebar-h2">
          <h2>ADMIN</h2>
        </div>
        <ul>
        <li><a href="manageorder.php"><i class="fas fa-layer-group"></i>Manage Orders</a></li>
        <li><a href="pastorder.php"><i class="fas fa-layer-group"></i>Past Orders</a></li>
        <li><a href="managestaff.php"><i class="fas fa-glasses"></i>Manage Staffs</a></li>
        <li><a href="managemenu.php"><i class="fas fa-carrot"></i>Manage Menu</a></li>
        <li><a href="manageaddon.php"><i class="fas fa-ad"></i>Manage AddOn</a></li>
        <li><a href="generatereport.php"><i class="fas fa-book"></i>Generate Report</a></li>
        </ul>
      </div>
    </div>';
  } elseif($_SESSION['roleId'] == 2) {
        echo '
        <div class="sidebar-container">
          <div class="sidebar">
            <div class="sidebar-h2">
              <h2>STAFF</h2>
            </div>
            <ul>
            <li><a href="manageorder.php"><i class="fas fa-layer-group"></i>Manage Orders</a></li>
            </ul>
          </div>
        </div>';
      }
}
?>
