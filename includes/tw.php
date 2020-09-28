<?php
include "dbh.php";
$email = "wei050297@gmail.com";

$sql = "SELECT * FROM useraccount WHERE Email='$email' AND Active = '1';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
print_r($row);

/*include "dbh.php";
session_start();
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
Your Receipt - Thank you for shopping with us
";
$end = "
------------------------------------------------------
Total: RM".$row['PaidAmount']."
------------------------------------------------------
";
$array = [];

$i = 1;
while ($row1 = mysqli_fetch_assoc($result1)) {
$a = $i.". ".$row1['MealName']."
RM".$row1['TotalOrderPrice']."
   ";
  array_push($array,$a);
  $i++;
};

$b = implode($array);
$c = $message.$b.$end;

$to      = $email; // Send email to our user
$subject = 'Receipt'; // Give the email a subject

$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
// Please specify your Mail Server - Example: mail.example.com.
ini_set("SMTP","ssl://smtp.gmail.com");
ini_set("smtp_port","587");
mail($to, $subject, $c, $headers); // Send our email*/
