<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/confirmcart.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <title></title>
  </head>
  <body>
    <?php
      include 'includes/header.php';
      include 'includes/dbh.php';
      //sql
      if (isset($_SESSION['customerId'])) {
        $cid = $_SESSION['customerId'];
        $sql = "SELECT * FROM customer where CustomerID = '$cid';";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
      }

     ?>
     <!-- Container -->

     <div class="container-wrapper">
       <div class="info-container">
         <div class="address-container">
           <div class="address">
             <input type="hidden" id="sneaky" value="0">
             <p>Address</p>
           </div>
           <div class="address-info">
             <?php if (isset($_SESSION['customerId'])) {echo '<p>'.$row["Address"].'</p>';} else {echo "Please Login/Register to set Address";};?>
           </div>
         </div>
         <div class="phone-container">
           <div class="phone">
             <p>Phone Number</p>
           </div>
           <div class="number">
             <?php if (isset($_SESSION['customerId'])) {echo '<p>'.$row["Phone"].'</p>';} else {echo "Please Login/Register to set Phone Number";}?>
           </div>
         </div>
       </div>
       <div class="button-container">
         <form name="inputDate" method="post" id="form">
           <div class="deliverDate">
             <p>Delivery Date</p>
             <input type="text" name="date" required id="datebit" placeholder="Date" autocomplete="off" value="<?php if(isset($_GET['date'])){
               $split = explode('-',$_GET['date']);$arrange = array($split[2],$split[1],$split[0]);$merge = implode('/',$arrange);echo $merge;
             } ?>">
           </div>
           <button type="submit" name="button" id="confirmBtn">Confirm</button>
         </form>
       </div>
     </div>

     <?php
      include 'includes/footer.php';
      ?>

  </body>
  <script async>
  var numberOfMeals = JSON.parse(localStorage.getItem('cartNumbers'));
  var mealInfo = JSON.parse(localStorage.getItem('mealsInCart'));
  var totalPrice = JSON.parse(localStorage.getItem('totalPrice'));
  var jsonMeal = "";
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'includes/getmealinfo.php?id=2', true);
  xhr.onload = function(){
    jsonMeal = JSON.parse(this.responseText);

    if (!numberOfMeals) {
      emptyCart();
    } else {
      //loop cart container====================================================
        for (i = 1; i <= numberOfMeals; i++){
          var addMenu = document.getElementsByClassName('container-wrapper')[0];
          var addOnMenuRow = document.createElement('div');
          var addOnMenuRowContent = `
          <div class="left-container">
           <div class="product-img">
             <img src="`+ mealInfo[i]['meals']['MealPicture'] +`" alt="">
           </div>
           <div class="product-description">
             <div class="prod-title">
               <p>`+ mealInfo[i]['meals']['MealName'] +`</p>
             </div>
             <textarea rows="5" class="remarks" maxlength="100" placeholder="Remarks">`+ mealInfo[i]['remarks'] +`</textarea>
           </div>
           <div class="add-ons"></div>
         </div>
         <div class="right-container">
          <div class="orangeBox">
            &times
          </div>
           <div class="prod-nutri">
             <table>
             <tr>
               <th>Calories</th>
               <th class="calories">`+ mealInfo[i]['nutriValues']['cal'] +`</th>
             </tr>
             <tr>
               <th>Carbohydrates</th>
               <th class="carbohydrates">`+ mealInfo[i]['nutriValues']['car'] +`</th>
             </tr>
             <tr>
               <th>Protein</th>
               <th class="protein">`+ mealInfo[i]['nutriValues']['protein'] +`</th>
             </tr>
             <tr>
               <th>Fats</th>
               <th class="fats">`+ mealInfo[i]['nutriValues']['fats'] +`</th>
             </tr>
             <tr>
               <th>Fibre</th>
               <th class="fibre">`+ mealInfo[i]['nutriValues']['fib'] +`</th>
             </tr>
           </table>
           </div>
           <div class="price">
             <p class="prices">RM`+ mealInfo[i]['nutriValues']['price'] +`</p>
           </div>
         </div>`;

          addOnMenuRow.classList.add('main-container');
          addOnMenuRow.classList.add(i - 1);
          addOnMenuRow.innerHTML = addOnMenuRowContent;
          addMenu.append(addOnMenuRow);
        }
    }


        //loop addons container==================================================
        for (i = 0; i < Object.keys(document.getElementsByClassName('add-ons')).length; i++) {
          delete mealInfo[i + 1]['meals'];
          delete mealInfo[i + 1]['nutriValues'];
          delete mealInfo[i + 1]['remarks'];
          var a = Object.keys(mealInfo[i + 1]);
          var b = Object.values(mealInfo[i + 1]);
          loadAddOns(mealInfo, i, a, b);
        }

        //alter addon value ===================================================
        var removeBtn = document.getElementsByClassName('btn-alter');
        var jsonAddOns = jsonMeal.boom;
        for(var i = 0; i < removeBtn.length; i++){
          var button = removeBtn[i];
          button.addEventListener('click', function(e){
            var clickedButton = event.target;
            var jsonButton = clickedButton.parentElement.parentElement.childNodes[1].childNodes[1].innerHTML;
            var value = parseInt(clickedButton.parentElement.childNodes[3].innerHTML);
            var clickedKey = checkKey(jsonAddOns, jsonButton);
            var index = clickedButton.parentElement.parentElement.parentElement.parentElement.parentElement.className[15];

            if (clickedButton.innerHTML === '+' && value < 300) {
              var newValue = value + 10;
              clickedButton.parentElement.childNodes[3].innerHTML = newValue + 'g';
              addValues(clickedKey, jsonAddOns, index);
            } else if(clickedButton.innerHTML === '-' && value > 0) {
              var newValue = value - 10;
              minusValues(clickedKey, jsonAddOns, index);
              clickedButton.parentElement.childNodes[3].innerHTML = newValue + 'g';
            }
          });
        }
      }
  xhr.send();

    //checkeys==============================================================
    function checkKey(jsonAddOns, jsonButton){
      var numberOfObjects = Object.keys(jsonAddOns).length;
      for (var i = 0; i < numberOfObjects; i++) {
        if (jsonAddOns[i]["AddOnMenuName"] === jsonButton) {
          return i;
        }
      }
    }

    //Carts==============================================================
    function addValues(clickedKey, jsonAddOns, i){
      var price = jsonAddOns[clickedKey]["AddOnPricePer10g"];
      var calories = jsonAddOns[clickedKey]["AddOnCalories"];
      var carbohydrates = jsonAddOns[clickedKey]["AddOnCarbohydrates"];
      var protein = jsonAddOns[clickedKey]["AddOnProtein"];
      var fats = jsonAddOns[clickedKey]["AddOnFats"];
      var fibre = jsonAddOns[clickedKey]["AddOnFibre"];

      var newPrice = parseFloat(parseFloat(document.getElementsByClassName('prices')[i].innerHTML.slice(2)) + parseFloat(price));
      var newCalories = parseInt(parseFloat(document.getElementsByClassName('calories')[i].innerHTML) + parseFloat(calories));
      var newCarbohydrates = parseInt(parseFloat(document.getElementsByClassName('carbohydrates')[i].innerHTML) + parseFloat(carbohydrates));
      var newProtein = parseInt(parseFloat(document.getElementsByClassName('protein')[i].innerHTML) + parseFloat(protein));
      var newFats = parseInt(parseFloat(document.getElementsByClassName('fats')[i].innerHTML) + parseFloat(fats));
      var newFibre = parseInt(parseFloat(document.getElementsByClassName('fibre')[i].innerHTML) + parseFloat(fibre));

      document.getElementsByClassName('prices')[i].innerHTML = "RM" + newPrice.toFixed(2);
      document.getElementsByClassName('calories')[i].innerHTML = newCalories.toFixed(2);
      document.getElementsByClassName('carbohydrates')[i].innerHTML = newCarbohydrates.toFixed(2);
      document.getElementsByClassName('protein')[i].innerHTML = newProtein.toFixed(2);
      document.getElementsByClassName('fats')[i].innerHTML = newFats.toFixed(2);
      document.getElementsByClassName('fibre')[i].innerHTML = newFibre.toFixed(2);
    }

    //Minus Values========================================================
    function minusValues(clickedKey, jsonAddOns, i){
      var price = jsonAddOns[clickedKey]["AddOnPricePer10g"];
      var calories = jsonAddOns[clickedKey]["AddOnCalories"];
      var carbohydrates = jsonAddOns[clickedKey]["AddOnCarbohydrates"];
      var protein = jsonAddOns[clickedKey]["AddOnProtein"];
      var fats = jsonAddOns[clickedKey]["AddOnFats"];
      var fibre = jsonAddOns[clickedKey]["AddOnFibre"];

      var newPrice = parseFloat(parseFloat(document.getElementsByClassName('prices')[i].innerHTML.slice(2)) - parseFloat(price));
      var newCalories = parseInt(parseFloat(document.getElementsByClassName('calories')[i].innerHTML) - parseFloat(calories));
      var newCarbohydrates = parseInt(parseFloat(document.getElementsByClassName('carbohydrates')[i].innerHTML) - parseFloat(carbohydrates));
      var newProtein = parseInt(parseFloat(document.getElementsByClassName('protein')[i].innerHTML) - parseFloat(protein));
      var newFats = parseInt(parseFloat(document.getElementsByClassName('fats')[i].innerHTML) - parseFloat(fats));
      var newFibre = parseInt(parseFloat(document.getElementsByClassName('fibre')[i].innerHTML) - parseFloat(fibre));

      document.getElementsByClassName('prices')[i].innerHTML = "RM" + newPrice.toFixed(2);
      document.getElementsByClassName('calories')[i].innerHTML = newCalories.toFixed(2);
      document.getElementsByClassName('carbohydrates')[i].innerHTML = newCarbohydrates.toFixed(2);
      document.getElementsByClassName('protein')[i].innerHTML = newProtein.toFixed(2);
      document.getElementsByClassName('fats')[i].innerHTML = newFats.toFixed(2);
      document.getElementsByClassName('fibre')[i].innerHTML = newFibre.toFixed(2);
    }

    //loadaddOns===============================================================
    function loadAddOns(mealInfo, loopNumber, a, b){
      for (z = 0; z < Object.keys(mealInfo[loopNumber + 1]).length; z++){
        var addMenu = document.getElementsByClassName('add-ons')[loopNumber];
        var addOnMenuRow = document.createElement('div');
        var addOnMenuRowContent = `
             <div class="addon-left">
               <p>` + a[z] + `</p>
             </div>
             <div class="addon-right">
               <button type="submit" name="button" class="left-btn btn-alter">-</button>
               <p>` + b[z] + 'g' +`</p>
               <button type="submit" name="button" class="right-btn btn-alter">+</button>
             </div>`;

        addOnMenuRow.classList.add('addon');
        addOnMenuRow.innerHTML = addOnMenuRowContent;
        addMenu.append(addOnMenuRow);
      }
    }
    //click confrim cart======================================================
    var confirmBtn = document.getElementById('confirmBtn');
    confirmBtn.addEventListener('click', function(){
      var date = document.getElementById('datebit').value;
      var parts = date.split("/");
      var selectedDate = new Date(parseInt(parts[2], 10),
                        parseInt(parts[1], 10) - 1,
                        parseInt(parts[0], 10));
      var currentTime = new Date();
      var datePlusTwo = new Date();
      datePlusTwo.setDate(currentTime.getDate() + 2);
      var datePlusSixty = new Date();
      datePlusSixty.setDate(currentTime.getDate() + 60);
      var numberOfMeals = JSON.parse(localStorage.getItem('cartNumbers'));
      if (!numberOfMeals) {
        document.getElementById('datebit').required = false;
        alert('No Items in Cart!');
      } else if (selectedDate <= datePlusTwo || selectedDate >= datePlusSixty) {
        alert("Invalid Delivery Date: Can only choose starting from the next 3 days");
      } else if (numberOfMeals && (selectedDate >= datePlusTwo || selectedDate <= datePlusSixty)) {
        document.getElementById('form').action = "includes/inputdateprocess.php";
        setMeals();
      }
      //location.href = 'checkout.php';
    })

    //setMeals================================================================
    function setMeals(){
      var mealNumbers = parseInt(localStorage.getItem('cartNumbers'));
      let cartMeals = localStorage.getItem('mealsInCart');
      var cartmeals = JSON.parse(cartMeals);

      var insertMeals = {};
      for (i = 1; i <= mealNumbers; i++){
        var cal = document.getElementsByClassName('calories')[i - 1].innerHTML;
        var fats = document.getElementsByClassName('fats')[i - 1].innerHTML;
        var protein = document.getElementsByClassName('protein')[i - 1].innerHTML;
        var car = document.getElementsByClassName('carbohydrates')[i - 1].innerHTML;
        var fib = document.getElementsByClassName('fibre')[i - 1].innerHTML;
        var price = parseFloat(document.getElementsByClassName('prices')[i - 1].innerHTML.slice(2));
        var remark = document.getElementsByClassName('remarks')[i-1].value;
        var nutri = {
          cal,fats,protein,car,fib,price
        }
        var addOns = document.querySelectorAll('.left-btn');
        var addOnsValue = document.getElementsByClassName('add-ons');
        var addOn = JSON.stringify(addOnsArray);
        var addOnsArray = {};
        var price1 = parseFloat(document.getElementsByClassName('prices')[0].innerHTML.slice(2));;
        var price2 = price1 + price;

        for (z = 0; z < addOns.length/mealNumbers; z++){
          if (addOnsArray != undefined) {
            addOnsArray = {
            ...addOnsArray,
            [addOnsValue[i-1].childNodes[z].childNodes[1].childNodes[1].innerHTML] : parseFloat(addOnsValue[i-1].childNodes[z].childNodes[3].childNodes[3].innerHTML),
            meals : cartmeals[i]['meals'],
            nutriValues : nutri,
            remarks : remark
            };
          } else {
            addOnsArray = {
            [addOnsValue[i-1].childNodes[z].childNodes[1].childNodes[1].innerHTML] : parseFloat(addOnsValue[i-1].childNodes[z].childNodes[3].childNodes[3].innerHTML),
            meals : cartmeals[i]['meals'],
            nutriValues : nutri,
            remarks : remark
            };
          };
        };

        if (cartMeals != null) {
          var keys = Object.keys(JSON.parse(localStorage.getItem('mealsInCart'))).length;
          insertMeals = {
            ...insertMeals,
            [i] : addOnsArray
          }
        } else {
          console.log('no');
        }

        localStorage.removeItem('mealsInCart');
        localStorage.setItem('mealsInCart', JSON.stringify(insertMeals));
        localStorage.setItem('totalPrice', JSON.stringify(price2));
      }
    }

    window.onload = function(){
      var removeMeals = document.getElementsByClassName('orangeBox');
      for (i = 0; i < removeMeals.length; i++){
        var removeMeal = removeMeals[i];
        removeMeal.addEventListener('click', function(e){

          var clickedRemoveMeal = event.target;
          var removeDiv = clickedRemoveMeal.parentElement.parentElement;
          var removeIndex = parseInt(removeDiv.className[15]) + 1;
          var readMeal = JSON.parse(localStorage.getItem('mealsInCart'));
          var readMealNew = JSON.parse(localStorage.getItem('mealsInCart'));
          var readNumber = JSON.parse(localStorage.getItem('cartNumbers'));
          var newMeal = {};

          delete readMeal[removeIndex];

          var deleteMealLength = Object.keys(readMeal).length;
          var array = [];

          for (j = 1; j <= removeMeals.length;){
            if (j !== removeIndex) {
              array.push(j);
            }
            j++;
          }

          for (z = 1; z <= deleteMealLength; z++){
            newMeal = {
              ...newMeal,
              [z] : readMealNew[array[z - 1]]
            }
          }

          var container = document.getElementsByClassName('main-container');
          for (h = removeIndex + 1; h <= container.length; h++){
            container[h - 1].classList.remove(h - 1);
            container[h - 1].classList.add(h - 2);
          }

          localStorage.setItem('mealsInCart', JSON.stringify(newMeal));
          localStorage.setItem('cartNumbers', parseInt(readNumber) - 1);
          removeDiv.remove();
          if (readNumber - 1 == 0) {
            emptyCart();
          }
        })
      }

  }

  function emptyCart(){
    var addMenu = document.getElementsByClassName('container-wrapper')[0];
    var addOnMenuRow = document.createElement('div');
    var addOnMenuRowContent = `
      <img src="img/emptycart.png" alt="emptycart">
      <div class="emptycart-pp">
        <p>0 is the loneliest numbers<br>Shop now!</p>
      </div>
    `;

    addOnMenuRow.classList.add('emptycart');
    addOnMenuRow.innerHTML = addOnMenuRowContent;
    addMenu.append(addOnMenuRow);
  }

  </script>
  <script src="js/jquery.js" charset="utf-8"></script>
  <script src="js/jquery-ui.js" charset="utf-8"></script>
  <script src="js/datescript.js" type="text/javascript"></script>
</html>
