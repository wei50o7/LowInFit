<?php
  session_start();
  if (!isset($_SESSION['roleId']) || !in_array($_SESSION['roleId'], array(1,2), true)) {
    header("Location: ../index.php");
    exit();
  }
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>LowInFit ADMIN</title>
    <link rel="stylesheet" href="../css/leftnavbar.css">
    <link rel="stylesheet" href="../css/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
    <header>
      <?php
        include "../includes/header.php";
       ?>
    </header>
    <div class="container-wrapper">
      <?php
        include '../includes/staffheader.php';
      ?>
      <div class="reportdatecontainer">
        <form class="" action="?" method="post">
          <div class="div-date">
            <div class="div-startdate">
              <p>Select Starting Date</p>
              <input type="date" class='reportdate' name="startdate" value="">
            </div>
            <div class="div-enddate">
              <p>Select Ending Date</p>
              <input type="date" class='reportdate' name="enddate" value="">
            </div>
          </div>

          <input type="submit" name="btnSubmit" value="Generate Report">
        </form>
        <?php
        include ("../includes/dbh.php");
        if (isset($_POST['btnSubmit'])) { ?>

        <div class="table-div">
          <table>
            <tr class="tr-header">
              <th class="th-big">Meal</th>
              <th>Amount Sold</th>
            </tr>

            <?php
          $startdate = $_POST['startdate'];
          $enddate = $_POST['enddate'];
          $sql = "SELECT MealID FROM meal";
          $result3 = mysqli_query($conn, $sql);
          $array = [];
          $join = mysqli_query($conn, "SELECT DISTINCT MealName, MealID FROM meal");

          while ($row3 = mysqli_fetch_array($join)) {
            echo "<tr class='data'>";
            echo "<td class='left'>";
            echo $row3['MealName'];
            echo "</td>";
            echo "<td class='center'>";
            $mealid = $row3['MealID'];
            $amount = mysqli_query($conn, "SELECT count(MealID) AS count FROM orderfood WHERE MealID = $mealid AND OrderDate BETWEEN '$startdate' and '$enddate'");
            $sold = mysqli_fetch_assoc($amount);
            $count = $sold['count'];
            echo $count;
            echo "</td>";
            echo "</tr>";
          } ?>
          </table>
          <div class="total">
            <?php
            $startdate = $_POST['startdate'];
            $enddate = $_POST['enddate'];
            $result = mysqli_query($conn,"SELECT sum(TotalOrderPrice) from orderfood where OrderDate BETWEEN '$startdate' and '$enddate'");
            $row = mysqli_fetch_array($result);
            echo "
            <p>Total Revenue: RM".round($row['sum(TotalOrderPrice)'],2)."</p>
            ";
            ?>
          </div>
        <?php } ?>
        </div>
        <!--
        include ("../includes/dbh.php");
        if (isset($_POST['btnSubmit'])) {

          $startdate = $_POST['startdate'];
          $enddate = $_POST['enddate'];
          $result = mysqli_query($conn,"SELECT sum(TotalOrderPrice) from orderfood where OrderDate BETWEEN '$startdate' and '$enddate'");
          $row = mysqli_fetch_array($result);
          $sql = "SELECT MealID FROM meal";
          $result3 = mysqli_query($conn, $sql);
          $array = [];

          while ($row3 = mysqli_fetch_assoc($result3)) {
            array_push($array, $row3['MealID']);
          }

          for ($i = 0;$i < count($array);$i++) {
            $sql1 = "SELECT count(MealID) from orderfood where OrderDate BETWEEN '$startdate' AND '$enddate' AND MealID=$array[$i];";
            $sql2 = "SELECT MealName from meal WHERE MealID=$array[$i];";
            $result1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($result1);
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

            echo "<br>";
            echo $row2['MealName'].':'.$row1['count(MealID)'];
          }
          if ($result) {
            echo '<div class="reportnumber" style=""><p>Total Revenue:RM'.round($row['sum(TotalOrderPrice)'],2).'</p></div>';
          } else {
          //echo "<script type='text/javascript'> alert('This menu still exist in customers' order, cannot be deleted!'); </script>";
          //echo "<script>window.history.go(-1)</script>";
          //echo "<script>window.location.href='../admin/managemenu.php?error=menuexistinorder'</script>";
          }
        }
      -->
      </div>
  </div>
</body>
</html>
