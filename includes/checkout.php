<?php
session_start();
  if (file_get_contents('php://input') == null) {
  } else {
    session_start();
    //get post json Object
    $jsonOrder = file_get_contents('php://input');
    $data = json_decode($jsonOrder, true);

    //set dbh connection
    require 'dbh.php';
    $length = count($data);
    $stmt = mysqli_stmt_init($conn);
    $insertPayment = "INSERT INTO payment (PaymentDate, PaidAmount) VALUES (?, ?)";



    if (!mysqli_stmt_prepare($stmt, $insertPayment)) {
      echo 'failed';
    } else {

      for ($i=1; $i <= $length ; $i++) {

        $mealInsert = $data[$i];
        //get nutriValues info
        $mealNutriPrice = $data[1]['nutriValues']['price'];
        if ($length > 1) {
          $finalPrice += $data[$i]['nutriValues']['price'];
        } else {
          $finalPrice = $mealNutriPrice;
        }
      }


      $date = date("Y-m-d");
      mysqli_stmt_bind_param($stmt, "ss",  $date, round($finalPrice,2));
      mysqli_stmt_execute($stmt);

      $getPaymentId = "SELECT MAX(PaymentID) FROM payment";
      $resultPaymentId = mysqli_query($conn, $getPaymentId);
      $rowPaymentId = mysqli_fetch_assoc($resultPaymentId);
      $paymentId = $rowPaymentId['MAX(PaymentID)'];

      //loop insert number of meals
      for ($i=1 ; $i <= $length; $i++){
        $addOns = $data[$i];
        $mealInsert = $data[$i];

        //get meal info
        $mealInfo = $mealInsert['meals'];
        //get nutriValues info
        $mealNutri = $mealInsert['nutriValues'];
        //insert into database
        $sqlInsertMeal = "INSERT INTO orderfood (CustomerID, MealID, Remarks, TotalCalories, TotalCarbohydrates, TotalProtein, TotalFats, TotalFibre, TotalOrderPrice, OrderDate, DeliveryDate, OrderStatus, PaymentID) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        if (!mysqli_stmt_prepare($stmt, $sqlInsertMeal)) {
        } else {
          $customerId = $_SESSION['customerId'];
          $deliveryDate = $_GET['date'];
          $orderDate = date("Y-m-d");
          $remarks = $mealInsert['remarks'];
          $orderStatus = "Order Received";
          $mealId = $mealInfo['MealID'];
          $totalCal = $mealNutri['cal'];
          $totalCar = $mealNutri['car'];
          $totalPro = $mealNutri['protein'];
          $totalFats = $mealNutri['fats'];
          $totalFib = $mealNutri['fib'];
          $totalPrice = $mealNutri['price'];

          mysqli_stmt_bind_param($stmt, 'sssssssssssss', $customerId, $mealId, $remarks, $totalCal, $totalCar, $totalPro, $totalFats, $totalFib, $totalPrice, $orderDate, $deliveryDate, $orderStatus, $paymentId);
          mysqli_stmt_execute($stmt);
        }

        //get order id
        $getOrderId = "SELECT MAX(OrderID) FROM orderfood WHERE CustomerID = ?";
        if (!mysqli_stmt_prepare($stmt, $getOrderId)) {
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
              } else {
                mysqli_stmt_bind_param($stmt, 'sss', $orderId[0], $addOnId[0], $values[$j]);
                mysqli_stmt_execute($stmt);
              }
            }
            }
          }
        }
      }
      $sql = "SELECT * FROM payment WHERE PaymentID = (SELECT MAX(PaymentID) FROM payment);";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $id = $row['PaymentID'];
      $email = 'eugenius1218@gmail.com';
      $sql1 = "SELECT * FROM orderfood JOIN meal ON meal.MealID = orderfood.MealID WHERE orderfood.PaymentID = $id;";
      $result1 = mysqli_query($conn, $sql1);
      $message = "
Thank you for your purchase!
A Receipt has been sent to your Email
------------------------------------------------------
Your Receipt - Thank you for shopping with us"."\r\n";
      $end = "
------------------------------------------------------
Total: RM".$row['PaidAmount']."
------------------------------------------------------";
      $array = [];
      $email = $_SESSION['email'];

      $k = 1;
      while ($row1 = mysqli_fetch_assoc($result1)) {
        $a = $k.". ".$row1['MealName']."
        RM".$row1['TotalOrderPrice']."\r\n";
        array_push($array,$a);
        $k++;
      }

      $b = implode($array);
      $c = $message.$b.$end;

      $to      = $email; // Send email to our user
      $subject = 'Receipt'; // Give the email a subject

      $headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
      // Please specify your Mail Server - Example: mail.example.com.
      ini_set("SMTP","ssl://smtp.gmail.com");
      ini_set("smtp_port","587");
      mail($to, $subject, $c, $headers); // Send our email
    }
    echo JSON_encode('success');
  }
