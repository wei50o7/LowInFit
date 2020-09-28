<?php
  session_start();
  if (!isset($_SESSION['roleId']) || !in_array($_SESSION['roleId'], array(1,2), true)) {
    header("Location: ../index.php");
    exit();
  }
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
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

    <title>Edit Menu</title>
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
      <?php
        include ("../includes/dbh.php");
        $id = intval ($_GET['mealid']); //Get the id from URL
        $result = mysqli_query ($conn,"SELECT * FROM meal WHERE MealID=$id");
        while ($row = mysqli_fetch_array($result))
        {
        ?>
        <form action="../includes/editmenu.php" method="post">
        <table style="width: 100%" class="addon-table">
          <thead>
          <tr>
            <td style="width: 156px">MealName:</td>
            <td><input name="mealname" type="text" required value="<?php echo $row['MealName'] ?>"></td>
          </tr>
          <tr>
            <td style="width: 156px">MealDescription:</td>
            <td><input name="mealdesc" type="text" required value="<?php echo $row['MealDesc'] ?>"></td>
          </tr>
          <tr>
            <td style="width: 156px">MealPricePerUnit:</td>
            <td><input name="mealpriceperunit" type="number" min="0" step="any" required value="<?php echo $row['MealPricePerUnit'] ?>"></td>
          </tr>
          <tr>
            <td style="width: 156px">MealCalories:</td>
            <td><input name="mealcalories" type="number" min="0" step="any" required value="<?php echo $row['MealCalories'] ?>"></td>
          </tr>
          <tr>
            <td style="width: 156px">MealCarbohydrates:</td>
            <td><input name="mealcarbohydrates" type="number" value="0" step="any" required value="<?php echo $row['MealCarbohydrates'] ?>"></td>
          </tr>
          <tr>
            <td style="width: 156px">MealProtein:</td>
            <td><input name="mealprotein" type="number" min="0" step="any" required value="<?php echo $row['MealProtein'] ?>"></td>
          </tr>
          <tr>
            <td style="width: 156px">MealFats:</td>
            <td><input name="mealfats" type="number" min="0" step="any" required value="<?php echo $row['MealFats'] ?>"></td>
          </tr>
          <tr>
            <td style="width: 156px">MealFibre:</td>
            <td><input name="mealfibre" type="number" min="0" step="any" required value="<?php echo $row['MealFibre'] ?>"></td>
          </tr>
          <tr>
            <td style="width: 156px">MealPicture(img/THEPICTURENAME):</td>
            <td><input name="mealpicture" type="text" value="<?php echo $row['MealPicture'] ?>"></td>
          </tr>
          <tr>
            <td style="width: 156px">MealCategory:</td>
            <td><input name="mealcategory" type="radio" id="chickenmain" value="1" <?php if ($row['CategoryID']==1) {
              echo "checked";}?>><label for="chickenmain">ChickenMain</label></td>
            <tr>
              <td></td>
              <td><input name="mealcategory" type="radio" id="fishmain" value="2" <?php if ($row['CategoryID']==2) {
                echo "checked";}?>><label for="fishmain">FishMain</label></td>
              <tr>
                <td><input name="btnSubmit" type="submit" value="Submit"><br></td>
                <td><input name="mealcategory" type="radio" id="vegemain" value="3" <?php if ($row['CategoryID']==3) {
                  echo "checked";}?>><label for="vegemain">VegeMain</label></td>
              </tr>
              <tr>
                <td><input type="button" value="Back" onclick="history.back()"></td>
                <td></td>
              </tr>
            </tr>
          </tr>
        </thead>
        </table>
        <input type="hidden" name="mealid" value="<?php echo $row['MealID'] ?>">
        </form>
<?php
}
mysqli_close($conn);
?>

  </body>
</html>
