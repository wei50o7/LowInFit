<?php
include "dbh.php";
function formatDate($date){
  $split = explode('/',$date);
  $arrange = array($split[2],$split[1],$split[0]);
  $merge = implode('-',$arrange);
  return $merge;
}
if(isset($_POST['date'])){
  $date = $_POST['date'];
}

$changeDate = formatDate($date);

//check customerID rows mysqli_getrow smth
$sql = "SELECT DISTINCT CustomerID FROM orderfood WHERE DeliveryDate='$changeDate'";
$result= mysqli_query($conn,$sql);
  /*$dt = date("Y-m-d");
  mysqli_stmt_bind_param($stmt, "s", $dt);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_store_result($stmt);*/
  $resultCheck = mysqli_num_rows($result);
  //check num of rows>>print_r ($resultCheck);
  if ($resultCheck > 10) {
    echo "<script>alert('This date is full')</script>";
    echo "<script>window.location.href='../cart.php?error=dateisfull'</script>";
    exit();

  } else {
    echo "<script>window.location.href='../checkout.php?date=".$changeDate."'</script>";
  }
 ?>
