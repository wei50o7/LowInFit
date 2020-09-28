<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../css/main.css">
  </head>
  <body>
    <div class="product-container">
      <div class="product-description">
        <h2 id=chicken>Chicken</h2>
        <p>culpa malis</p>
        <p>legam summis quae cillum irure nulla fore sunt irure quis</p>
      </div>

      <div class="a">
        <div class="main-container">
        <?php
        include 'dbh.php';
        $getMealInfo = 'SELECT * FROM meal';
        $result = mysqli_query($conn, $getMealInfo);

        while ($row = mysqli_fetch_assoc($result)) {
          echo '<div class="product">
            <div class="img-container">
              <div class="product-img">
                <img src="'.'../'.$row['MealPicture'].'" alt="">
              </div>
            </div>

            <div class="product-content">
              <div class="product-name">
                <h3>'.$row['MealName'].'</h3>
              </div>
              <div class="content-table">
                <table>
                <tr>
                  <th>Calories</th>
                  <th>'.$row['MealCalories'].'</th>
                </tr>
                <tr>
                  <th>Carbohydrates</th>
                  <th>'.$row['MealCarbohydrates'].'</th>
                </tr>
                <tr>
                  <th>Protein</th>
                  <th>'.$row['MealProtein'].'</th>
                </tr>
                <tr>
                  <th>Fats</th>
                  <th>'.$row['MealFats'].'</th>
                </tr>
              </table>
              </div>
              <div class="content-price">
                <p>RM'.$row['MealPricePerUnit'].'</p>
              </div>
              <div class="content-button">
                <button class="show-modal" onclick="toggleModal()">View Menu Detail</button>
              </div>
            </div>
          </div>';
          }
         ?>
        </div>
      </div>
    </div>

  </body>
  <script src="js/test.js" charset="utf-8"></script>
</html>
