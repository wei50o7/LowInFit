<?php

if (!isset($_GET['id'])) {
  $e = 'Error!';
  echo JSON_encode($e);
} else {
  include 'dbh.php';

  $mealId = $_GET['id'];
  $getMeal = "SELECT * FROM meal WHERE MealID = ?";
  $getAddOns = "SELECT * FROM addonmenu";
  $getMealStmt = mysqli_stmt_init($conn);
  $array = array();

  if (!mysqli_stmt_prepare($getMealStmt, $getMeal)) {
    $error = "Error!";
    echo JSON_encode($error);
  } else {
    mysqli_stmt_bind_param($getMealStmt, 's', $mealId);
    mysqli_stmt_execute($getMealStmt);
    $result = mysqli_stmt_get_result($getMealStmt);
    $row = mysqli_fetch_assoc($result);

    $addon = array();
    $addOns = mysqli_query($conn, $getAddOns);
    while($addOnsRow = mysqli_fetch_assoc($addOns)){
      $addon[] = $addOnsRow;
    }


    $array['row'] = $row;
    $array['boom'] = $addon;
    echo JSON_encode($array);
  }
}
