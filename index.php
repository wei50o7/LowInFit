<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/test2.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>LowInFit</title>
  </head>

  <body>
    <?php
      include 'includes/dbh.php';
      if (isset($_COOKIE['usert']) && isset($_COOKIE['user'])) {
        $userToken = $_COOKIE['usert'];
        $username = $_COOKIE['user'];
        $verifyToken = "SELECT * FROM useraccount WHERE Username=?";
        $tokenStmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($tokenStmt, $verifyToken)) {
          echo 'error';
        } else {
          mysqli_stmt_bind_param($tokenStmt, 's', $username);
          mysqli_stmt_execute($tokenStmt);
          $result = mysqli_stmt_get_result($tokenStmt);
          $row = mysqli_fetch_assoc($result);

          $token = $row['LoginCookieHash'];
          if (password_verify($token, $userToken) === false) {
            header("Location: includes/logout.php");
            exit();
          } else if(password_verify($token, $userToken) === true) {
            setcookie("usert", $userToken, time()+(86400*7), '/');
            setcookie("user", $username, time()+(86400*7), '/');
            $_SESSION['userId'] = $row['UserID'];
            $_SESSION['userName'] = $row['Username'];
            $_SESSION['email'] = $row['Email'];
            $_SESSION['roleId'] = $row['RoleID'];
          }
      }
    }
     ?>
<!--============================================MODAL=====================================================================================-->
    <div class="modal-overlay modal-hidden" id="overlay">
      <div class="modal-container-wrapper">
        <div class="top-container">
          <div class="left-container">
            <div class="left-img">
              <img id="modal-img">
            </div>
          </div>
          <div class="right-container">
            <div class="product-title">
              <p id="modal-title"></p>
            </div>
            <div class="product-desc">
              <p id="modal-desc"></p>
            </div>
            <div class="remarks">
              <p>Remarks</p>
              <textarea rows="3" cols="80" maxlength="100" placeholder="Maximum 100 Characters" id="remarks"></textarea>
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
            <p id="modal-price"></p>
          </div>
          <div class="nutri-table">
            <table>
          <tr>
            <th>Calories</th>
            <th id="modal-calories"></th>
          </tr>
          <tr>
            <th>Carbohydrates</th>
            <th id="modal-carbohydrates"></th>
          </tr>
          <tr>
            <th>Protein</th>
            <th id="modal-protein"></th>
          </tr>
          <tr>
            <th>Fats</th>
            <th id="modal-fats"></th>
          </tr>
          <tr>
            <th>Fibre</th>
            <th id="modal-fibre"></th>
          </tr>
        </table>
          </div>

        </div>
        <div class="addon-container">
        </div>
        <div class="bottom-container">
          <div class="button-container">
            <div class="button-position">
              <button type="submit" name="button" class="addToCartBtn">Add to cart</button>
            </div>
          </div>
        </div>
      </div>
    </div>
<!--===================================HEADER=====================================================================================-->
    <?php
      include 'includes/header.php';
     ?>
<!--==================================CAROUSEL====================================================================================-->
    <div class="carousel-container">
      <div class="container">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
          </ol>
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <div class="item active">
              <img src="img/salad.jpg" alt="Los Angeles" style="width:100%;">
            </div>

            <div class="item">
              <img src="img/salmon.jpg" alt="Chicago" style="width:100%;">
            </div>

            <div class="item">
              <img src="img/salad.jpg" alt="New york" style="width:100%;">
            </div>
          </div>
          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </div>
<!--================================ABOUT==========================================================================================-->
    <div class="main-about-container" id="about">
      <div class="about-container">
        <div class="about-who">
          <h2>Who are we?</h2>
          <p>We are basically IT students that are doing this website for assignment, in the same time the project leader of this group are fitness enthusiast that he knows a lot on meal prepping since he cooks for himself everyday and exercise everyday. He has several years of experience on meal prepping and the meal is nice as he can eat that everyday.</p>
        </div>
        <div class="about-what">
          <h2>What we do?</h2>
          <p>We provide healthy meal prepping that allow you freely customized according to your needs, and then all the macronutrients will be counted for you to follow. We provides delivery service to Klang Valley area only, charging less than RM10 depending on the location. We only deliver once a day which is around 7am until 11am.</p>
        </div>
        <div class="about-why">
          <h2>Why we do?</h2>
          <p>The main purpose of this website is to help people in eating the right food as what the society now which their mindset is to eat whatever they like and did not control your diet. This lead to overweight individual as it is noticeable from most of the people nowadays. We provide delivery service in conjunction of supporting the SOP from government related to COVID-19 where individuals are advised not to go out frequently as all the viruses are bound on the air.</p>
        </div>
      </div>
    </div>
<!--==========================================MENU================================================================================-->
    <div class="menu-container" id="menu">
      <div class="menu-h1">
        <h1>Menu</h1>
      </div>
    </div>
<!--=========================================PRODUCTS=============================================================================-->
    <!--CHIMKEN=====================-->
    <div class="product-container">
      <div class="product-description">
        <h2 id=chicken>Chicken</h2>
        <p>A bird</p>
        <p>that walked on two legs and hardly can fly</p>
      </div>

      <div class="a">
        <div class="main-container">
          <?php
            $getMealInfo = 'SELECT * FROM meal WHERE CategoryID = 1';
            $result = mysqli_query($conn, $getMealInfo);

            while ($row = mysqli_fetch_assoc($result)) {
              echo '
          <div class="product">
            <div class="img-container">
              <div class="product-img">
                <img src="'.$row['MealPicture'].'" alt="">
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
                  <tr>
                    <th>Fibre</th>
                    <th>'.$row['MealFibre'].'</th>
                  </tr>
                </table>
              </div>
              <div class="content-price">
                <p>RM'.$row['MealPricePerUnit'].'</p>
              </div>
              <div class="content-button">
                <button name="'.$row['MealID'].'" class="menu-btn" onclick="toggleModal()">View Menu Detail</button>
              </div>
            </div>
          </div>';}
          ?>
        </div>
      </div>
    </div>

    <!--FISHM============-->
    <div class="product-container">
      <div class="product-description">
        <h2 id=fish>Fish</h2>
        <p>A living creature</p>
        <p>that lives underwater and uses gill to perform respiration</p>
      </div>

      <div class="a">
        <div class="main-container">
          <?php
            $getMealInfo = 'SELECT * FROM meal WHERE CategoryID = 2';
            $result = mysqli_query($conn, $getMealInfo);

            while ($row = mysqli_fetch_assoc($result)) {
              echo '
          <div class="product">
            <div class="img-container">
              <div class="product-img">
                <img src="'.$row['MealPicture'].'" alt="">
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
                  <tr>
                    <th>Fibre</th>
                    <th>'.$row['MealFibre'].'</th>
                  </tr>
                </table>
              </div>
              <div class="content-price">
                <p>RM'.$row['MealPricePerUnit'].'</p>
              </div>
              <div class="content-button">
                <button name="'.$row['MealID'].'" class="menu-btn" onclick="toggleModal()">View Menu Detail</button>
              </div>
            </div>
          </div>';}
          ?>
        </div>
      </div>
    </div>


    <!--VEGEMTABLESS=====-->
    <div class="product-container">
      <div class="product-description">
        <h2 id=vegetables>Vegetables</h2>
        <p>A plant</p>
        <p>which most of its color are green and vegan like to eat</p>
      </div>

      <div class="a">
        <div class="main-container">
          <?php
            $getMealInfo = 'SELECT * FROM meal WHERE CategoryID = 3';
            $result = mysqli_query($conn, $getMealInfo);

            while ($row = mysqli_fetch_assoc($result)) {
              echo '
          <div class="product">
            <div class="img-container">
              <div class="product-img">
                <img src="'.$row['MealPicture'].'" alt="">
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
                  <tr>
                    <th>Fibre</th>
                    <th>'.$row['MealFibre'].'</th>
                  </tr>
                </table>
              </div>
              <div class="content-price">
                <p>RM'.$row['MealPricePerUnit'].'</p>
              </div>
              <div class="content-button">
                <button name="'.$row['MealID'].'" class="menu-btn" onclick="toggleModal()">View Menu Detail</button>
              </div>
            </div>
          </div>';}
          ?>
        </div>
      </div>
    </div>
  <!--==================================FOOTER====================================================================================-->
    <?php
      include 'includes/footer.php'
     ?>
  </body>
      <script src="js/test.js" charset="utf-8"></script>
      <script type="text/javascript" async>
      var modalImg = document.getElementById('modal-img');
      var modalTitle = document.getElementById('modal-title');
      var modalDesc = document.getElementById('modal-desc');
      var modalPrice = document.getElementById('modal-price');
      var modalCalories = document.getElementById('modal-calories');
      var modalCarbohydrates = document.getElementById('modal-carbohydrates');
      var modalProtein = document.getElementById('modal-protein');
      var modalFats = document.getElementById('modal-fats');
      var modalFibre = document.getElementById('modal-fibre');
      var jsonMeal = "";

      //load popup modal=====================================
      var menuBtns = document.getElementsByClassName('menu-btn');
      for (i = 0; i < menuBtns.length; i++){
        menuBtn = menuBtns[i];
        menuBtn.addEventListener('click', function(e){
          targetBtn = event.target;
          id = targetBtn.name;
          loadModal(id);
        })
      }

      //loadmoadl=============================================================

      function loadModal(id){
      var xhr = new XMLHttpRequest();

      xhr.open('GET', 'includes/getmealinfo.php?id='+id, true);
      xhr.onload = function(){
        jsonMeal = JSON.parse(this.responseText);

        modalImg.src = jsonMeal.row.MealPicture;
        modalTitle.innerHTML = jsonMeal.row.MealName;
        modalDesc.innerHTML = jsonMeal.row.MealDesc;
        modalPrice.innerHTML = "RM"+jsonMeal.row.MealPricePerUnit;
        modalCalories.innerHTML = jsonMeal.row.MealCalories;
        modalCarbohydrates.innerHTML = jsonMeal.row.MealCarbohydrates;
        modalProtein.innerHTML = jsonMeal.row.MealProtein;
        modalFats.innerHTML = jsonMeal.row.MealFats;
        modalFibre.innerHTML = jsonMeal.row.MealFibre;

        loadAddOns();
      }

      xhr.send();
    }

      //load modal addons=================================================
      function loadAddOns(){
        var jsonAddOns = jsonMeal.boom;
        var numOfAddOns = jsonAddOns.length;
        var arrayAddOns = Object.entries(jsonAddOns);

        for(i=0;i<numOfAddOns;i++){
          var addOn = document.getElementsByClassName('addon-container')[0];
          var addOnRow = document.createElement('div');
          var addOnRowContent = `
            <div class="addon-left">
            <p id="addon-name">`+ jsonAddOns[i].AddOnMenuName +`</p><p2 data-tooltip="
              Price per 10gram = RM` + jsonAddOns[i]["AddOnPricePer10g"] + `
              Calories per 10gram = ` + jsonAddOns[i]["AddOnCalories"] + `kcal
              Carbohydrates per 10gram = ` + jsonAddOns[i]["AddOnCarbohydrates"] + `g
              Protein per 10gram = ` + jsonAddOns[i]["AddOnProtein"] + `g
              Fats per 10gram = ` + jsonAddOns[i]["AddOnFats"] + `g
              Fibre per 10gram = ` + jsonAddOns[i]["AddOnFibre"] + `g
              ">(?)</p2>
            </div>
            <div class="addon-right">
              <button type="submit" name="button" class="left-btn btn-alter">-</button>
              <p>0g</p>
              <button type="submit" name="button" class="right-btn btn-alter">+</button>
            </div>`;

          addOnRow.classList.add('addon');
          addOnRow.innerHTML = addOnRowContent;
          addOn.append(addOnRow);
      }

        //alter addon value ===================================================
        var removeBtn = document.getElementsByClassName('btn-alter');
        for(var i = 0; i < removeBtn.length; i++){
          var button = removeBtn[i];
          button.addEventListener('click', function(e){
            var clickedButton = event.target;
            var jsonButton = clickedButton.parentElement.parentElement.childNodes[1].childNodes[1].innerHTML;
            var value = parseInt(clickedButton.parentElement.childNodes[3].innerHTML);
            var clickedKey = checkKey(jsonAddOns, jsonButton, i);

            if (clickedButton.innerHTML === '+' && value < 300) {
              var newValue = value + 10;
              clickedButton.parentElement.childNodes[3].innerHTML = newValue + 'g';
              addValues(clickedKey, jsonAddOns);
            } else if(clickedButton.innerHTML === '-' && value > 0) {
              var newValue = value - 10;
              minusValues(clickedKey, jsonAddOns);
              clickedButton.parentElement.childNodes[3].innerHTML = newValue + 'g';
            }
          });
        }
      }

      //Add to cart===========================================================
      var cartBtn = document.getElementsByClassName("addToCartBtn");
      cartBtn[0].addEventListener('click', function(){
        cartNumbers();
        setMeals();
        totalPrice();
        clearModal();
      })

      //total price=============================================================
      function totalPrice(){
        var totalPrice = localStorage.getItem('totalPrice');
        var price = parseFloat(modalPrice.innerHTML.slice(2));
        totalPrice = parseFloat(totalPrice);

        if (isNaN(totalPrice)) {
          localStorage.setItem('totalPrice', price);
        } else {
          price += totalPrice;
          localStorage.setItem('totalPrice', price);
        }
      }

      //cartNumbers=============================================================
      function cartNumbers(){
        let mealNumbers = localStorage.getItem('cartNumbers');
        mealNumbers = parseInt(mealNumbers);

        if (mealNumbers) {
          localStorage.setItem('cartNumbers', mealNumbers + 1);
        } else {
          localStorage.setItem('cartNumbers', 1);
        }
      }

      //setMeals================================================================
      function setMeals(){
        var cal = document.getElementById('modal-calories').innerHTML;
        var fats = document.getElementById('modal-fats').innerHTML;
        var protein = document.getElementById('modal-protein').innerHTML;
        var car = document.getElementById('modal-carbohydrates').innerHTML;
        var fib = document.getElementById('modal-fibre').innerHTML;
        var price = parseFloat(document.getElementById('modal-price').innerHTML.slice(2));
        var nutri = {
          cal,fats,protein,car,fib,price
        }
        var addOns = document.querySelectorAll('.left-btn');
        let cartMeals = localStorage.getItem('mealsInCart');
        //var addOn = JSON.stringify(addOnsArray);
        var cartmeals = JSON.parse(cartMeals);
        var addOnsArray = {};
        var remarks = document.getElementById('remarks').value;

        for (i = 0; i < addOns.length; i++){
          if (addOnsArray != undefined) {
            addOnsArray = {
            ...addOnsArray,
            [addOns[i].parentElement.parentElement.childNodes[1].childNodes[1].innerHTML] : parseFloat(addOns[i].parentElement.childNodes[3].innerHTML),
            meals : jsonMeal['row'],
            nutriValues : nutri,
            remarks : remarks
            };
          } else {
            addOnsArray = {
            [addOns[i].parentElement.parentElement.childNodes[1].childNodes[1].innerHTML] : parseFloat(addOns[i].parentElement.childNodes[3].innerHTML),
            meals : jsonMeal['row'],
            nutriValues : nutri,
            remarks : remarks
            };
          }
        }

        if (cartMeals != null) {
          var keys = Object.keys(cartmeals).length;
          cartmeals = {
            ...cartmeals,
            [keys + 1] : addOnsArray
          }
        } else {
          cartmeals = {
            1 : addOnsArray
          }
        }

        localStorage.setItem('mealsInCart', JSON.stringify(cartmeals));
        alert("Added to cart!");
      }

      //checkeys==============================================================
      function checkKey(jsonAddOns, jsonButton){
        var numberOfObjects = Object.keys(jsonAddOns).length;
        for (var i = 0; i < numberOfObjects; i++) {
          if (jsonAddOns[i]["AddOnMenuName"] === jsonButton) {
            return i;
          }
        }
      }

      //close popup modal=====================================================
        document.getElementById('mdiv').addEventListener('click', clearModal);
        function clearModal(){
          toggleModal();
          var clear = null;
          var imgClear = '#';
          document.getElementById('modal-img').src = imgClear;
          document.getElementById('modal-title').innerHTML = clear;
          document.getElementById('modal-desc').innerHTML = clear;
          document.getElementById('modal-price').innerHTML = clear;
          document.getElementById('modal-calories').innerHTML = clear;
          document.getElementById('modal-carbohydrates').innerHTML = clear;
          document.getElementById('modal-protein').innerHTML = clear;
          document.getElementById('modal-fats').innerHTML = clear;
          document.getElementById('modal-fibre').innerHTML = clear;
          document.getElementById('remarks').value = clear;
          var addOn = document.getElementsByClassName("addon");
          while (addOn.length > 0) addOn[0].remove();
        }

        //Carts==============================================================
        function addValues(clickedKey, jsonAddOns){
          var price = jsonAddOns[clickedKey]["AddOnPricePer10g"];
          var calories = jsonAddOns[clickedKey]["AddOnCalories"];
          var carbohydrates = jsonAddOns[clickedKey]["AddOnCarbohydrates"];
          var protein = jsonAddOns[clickedKey]["AddOnProtein"];
          var fats = jsonAddOns[clickedKey]["AddOnFats"];
          var fibre = jsonAddOns[clickedKey]["AddOnFibre"];

          var newPrice = parseFloat(modalPrice.innerHTML.slice(2))  + parseFloat(price);
          var newCalories = parseFloat(modalCalories.innerHTML) + parseFloat(calories);
          var newCarbohydrates = parseFloat(modalCarbohydrates.innerHTML) + parseFloat(carbohydrates);
          var newProtein = parseFloat(modalProtein.innerHTML) + parseFloat(protein);
          var newFats = parseFloat(modalFats.innerHTML) + parseFloat(fats);
          var newFibre = parseFloat(modalFibre.innerHTML) + parseFloat(fibre);

          modalPrice.innerHTML = "RM" + newPrice.toFixed(2);
          modalCalories.innerHTML = newCalories.toFixed(2);
          modalCarbohydrates.innerHTML = newCarbohydrates.toFixed(2);
          modalProtein.innerHTML = newProtein.toFixed(2);
          modalFats.innerHTML = newFats.toFixed(2);
          modalFibre.innerHTML = newFibre.toFixed(2);
        }

        //Minus Values========================================================
        function minusValues(clickedKey, jsonAddOns){
          var price = jsonAddOns[clickedKey]["AddOnPricePer10g"];
          var calories = jsonAddOns[clickedKey]["AddOnCalories"];
          var carbohydrates = jsonAddOns[clickedKey]["AddOnCarbohydrates"];
          var protein = jsonAddOns[clickedKey]["AddOnProtein"];
          var fats = jsonAddOns[clickedKey]["AddOnFats"];
          var fibre = jsonAddOns[clickedKey]["AddOnFibre"];

          var newPrice = parseFloat(modalPrice.innerHTML.slice(2))  - parseFloat(price);
          var newCalories = parseFloat(modalCalories.innerHTML) - parseFloat(calories);
          var newCarbohydrates = parseFloat(modalCarbohydrates.innerHTML) - parseFloat(carbohydrates);
          var newProtein = parseFloat(modalProtein.innerHTML) - parseFloat(protein);
          var newFats = parseFloat(modalFats.innerHTML) - parseFloat(fats);
          var newFibre = parseFloat(modalFibre.innerHTML) - parseFloat(fibre);

          modalPrice.innerHTML = "RM" + newPrice.toFixed(2);
          modalCalories.innerHTML = newCalories.toFixed(2);
          modalCarbohydrates.innerHTML = newCarbohydrates.toFixed(2);
          modalProtein.innerHTML = newProtein.toFixed(2);
          modalFats.innerHTML = newFats.toFixed(2);
          modalFibre.innerHTML = newFibre.toFixed(2);
        }

          var modal = document.getElementsByClassName('modal-overlay')[0];
          modal.addEventListener('click', function(e){
            eventClick = event.target;
            if (eventClick.className === 'modal-overlay') {
              clearModal();
            }
          })



      </script>
</html>
