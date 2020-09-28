<?php
require 'dbh.php';
session_start();
$data = $_SESSION['json'];
$length = count($data);

  for ($i=1 ; $i <= $length; $i++){
    $addOns = $data[$i];
    $mealInsert = $data[$i];

    //get meal info
    $mealInfo = $mealInsert['meals'];
    //get nutriValues info
    $mealNutri = $mealInsert['nutriValues'];
    //insert into database
    $sqlInsertMeal = "INSERT INTO orderfood (CustomerID, MealID, Remarks, TotalCalories, TotalCarbohydrates, TotalProtein, TotalFats, TotalFibre, TotalOrderPrice, OrderDate, DeliveryDate, OrderStatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sqlInsertMeal)) {
      echo 'errorrr';
    } else {
      $customerId = $_SESSION['customerId'];
      $deliveryDate = $_SESSION['date'];
      $orderDate = date("Y-m-d");
      $remarks = "No remarks";
      $orderStatus = "Order Received";
      $totalPrice = $mealInsert['nutriValues']['price'];//
      $mealId = $mealInfo['MealID'];
      $totalCal = $mealNutri['cal'];
      $totalCar = $mealNutri['car'];
      $totalPro = $mealNutri['protein'];
      $totalFats = $mealNutri['fats'];
      $totalFib = $mealNutri['fib'];

      mysqli_stmt_bind_param($stmt, 'ssssssssssss', $customerId, $mealId, $remarks, $totalCal, $totalCar, $totalPro, $totalFats, $totalFib, $totalPrice, $orderDate, $deliveryDate, $orderStatus);
      mysqli_stmt_execute($stmt);
    }

    //get order id
    $getOrderId = "SELECT MAX(OrderID) FROM orderfood WHERE CustomerID = ?";
    if (!mysqli_stmt_prepare($stmt, $getOrderId)) {
      echo 'failed';
    } else {
      mysqli_stmt_bind_param($stmt, 's', $customerId);
      mysqli_stmt_execute($stmt);
      $fetchOrderId = mysqli_stmt_get_result($stmt);
      $orderId = mysqli_fetch_row($fetchOrderId);

      unset($addOns['meals']);
      unset($addOns['nutriValues']);

      if (!empty($addOns)) {
        //remove meals and nutri values from array
        unset($addOns['meals']);
        unset($addOns['nutriValues']);

        //split array into keys and values
        $keys = array_keys($addOns);
        $values = array_values($addOns);

        //loop array for
        for ($j = 0; $j < count($keys); $j++){
          $getAddOnId = "SELECT AddOnMenuID FROM addonmenu WHERE AddOnMenuName = ?;";

        if (!mysqli_stmt_prepare($stmt, $getAddOnId)) {
          echo 'failed';
        } else {
          $key = $keys[$j];
          mysqli_stmt_bind_param($stmt, 's', $key);
          mysqli_stmt_execute($stmt);
          $fetchAddOnId = mysqli_stmt_get_result($stmt);
          $addOnId = mysqli_fetch_row($fetchAddOnId);

          $insertAddOns = "INSERT INTO addon (OrderID, AddOnMenuID, AddOnQuantity) VALUES (?, ?, ?);";

          if (!mysqli_stmt_prepare($stmt, $insertAddOns)) {
            echo 'damn';
          } else {
            mysqli_stmt_bind_param($stmt, 'sss', $orderId[0], $addOnId[0], $values[$j]);
            mysqli_stmt_execute($stmt);
          }
        }
        }
      }
    }
  }
 ?>
