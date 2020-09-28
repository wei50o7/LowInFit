<?php
  include 'includes/dbh.php';

    $getMealInfo = 'SELECT * FROM meal WHERE MealID = 1';
    $result = mysqli_query($conn, $getMealInfo);
    $row = mysqli_fetch_assoc($result);
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="css/test2.css">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
  <div class="modal-overlay modal-hidden">
    <div class="modal-container-wrapper">
      <div class="top-container">
        <div class="left-container">
          <div class="left-img">
            <img src="<?php echo $row['MealPicture']; ?>" alt="">
          </div>
        </div>
        <div class="right-container">
          <div class="product-title">
            <p><?php echo $row['MealName']; ?></p>
          </div>
          <div class="product-desc">
            <p><?php echo $row['MealDesc'] ?></p>
          </div>
          <div id="mdiv">
            <div class="mdiv">
              <div class="md"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="nutri-container">
        <div class="price">
          <p>Total Price : RM<?php echo $row['MealPricePerUnit']; ?></p>
        </div>
        <div class="nutri-table">
          <table>
        <tr>
          <th>Calories</th>
          <th><?php echo $row['MealCalories']; ?></th>
        </tr>
        <tr>
          <th>Carbohydrates</th>
          <th><?php echo $row['MealCarbohydrates']; ?></th>
        </tr>
        <tr>
          <th>Protein</th>
          <th><?php echo $row['MealProtein']; ?></th>
        </tr>
        <tr>
          <th>Fats</th>
          <th><?php echo $row['MealFats']; ?></th>
        </tr>
      </table>
        </div>

      </div>
      <div class="addon-container">
        <div class="addon">
          <div class="addon-left">
            <p>Salmon Steak</p>
          </div>
          <div class="addon-right">
            <button type="submit" name="button" class="left-btn">+</button>
            <p>150g</p>
            <button type="submit" name="button" class="right-btn">-</button>
          </div>
        </div>
        <div class="addon">
          <div class="addon-left">
            <p>Salmon Steak</p>
          </div>
          <div class="addon-right">
            <button type="submit" name="button" class="left-btn">+</button>
            <p>150g</p>
            <button type="submit" name="button" class="right-btn">-</button>
          </div>
        </div>
        <div class="addon">
          <div class="addon-left">
            <p>Salmon Steak</p>
          </div>
          <div class="addon-right">
            <button type="submit" name="button" class="left-btn">+</button>
            <p>150g</p>
            <button type="submit" name="button" class="right-btn">-</button>
          </div>
        </div>
      </div>
      <div class="bottom-container">
        <div class="button-container">
          <div class="button-position">
            <button type="submit" name="button">Add to cart</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  </body>
  <script src="js/test.js" charset="utf-8"></script>
</html>
