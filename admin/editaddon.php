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
        $id = intval ($_GET['addonid']); //Get the id from URL
        $result = mysqli_query ($conn,"SELECT * FROM addonmenu WHERE AddOnMenuID=$id");
        while ($row = mysqli_fetch_array($result))
        {
        ?>
        <form action="../includes/editaddon.php" method="post">
        <table style="width: 100%;  transform: translateY(250px);" class="addon-table">
          <thead>
          <tr>
            <td style="width: 156px">AddOnMenuName:</td>
            <td><input name="addonmenuname" type="text" required value="<?php echo $row['AddOnMenuName'] ?>"></td>
          </tr>
          <tr>
            <td style="width: 156px">AddOnPricePerUnit:</td>
            <td><input name="addonpriceper10g" type="number" min="0" step="any" required value="<?php echo $row['AddOnPricePer10g'] ?>"></td>
          </tr>
          <tr>
            <td style="width: 156px">AddOnCalories:</td>
            <td><input name="addoncalories" type="number" min="0" step="any" required value="<?php echo $row['AddOnCalories'] ?>"></td>
          </tr>
          <tr>
            <td style="width: 156px">AddOnCarbohydrates:</td>
            <td><input name="addoncarbohydrates" type="number" min="0" step="any" required value="<?php echo $row['AddOnCarbohydrates'] ?>"></td>
          </tr>
          <tr>
            <td style="width: 156px">AddOnProtein:</td>
            <td><input name="addonprotein" type="number" min="0" step="any" required value="<?php echo $row['AddOnProtein'] ?>"></td>
          </tr>
          <tr>
            <td style="width: 156px">AddOnFats:</td>
            <td><input name="addonfats" type="number" min="0" step="any" required value="<?php echo $row['AddOnFats'] ?>"></td>
          </tr>
          <tr>
            <td style="width: 156px">AddOnFibre:</td>
            <td><input name="addonfibre" type="number" min="0" step="any" required value="<?php echo $row['AddOnFibre'] ?>"></td>
          </tr>
          <tr>
            <td><input name="btnSubmit" type="submit" value="Submit"><br></td>
            <td><input type="button" value="Back" onclick="history.back()"></td>
          </tr>

        </thead>
        </table>
        <input type="hidden" name="addonmenuid" value="<?php echo $row['AddOnMenuID'] ?>">
        </form>
        <?php
}
mysqli_close($conn);
?>

  </body>
</html>
