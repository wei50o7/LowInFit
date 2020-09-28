<?php
  session_start();
  if (!isset($_SESSION['customerId'])) {
    header("Location: knowmore.php");
  }
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/checkoutcart.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
    <title></title>
  </head>
  <body>
    <div class="modal-hidden" id="modal-hidden">
      <div class="checkout-modal">
        <div class="modal-header">
          <p>Add Credit Card Detail</p>
        </div>
        <div class="modal-main">
          <div class="name">
            <input id="name" type="text" name="Name" placeholder="Name on Card" required>
          </div>
          <div class="card">
            <input id="card" type="text" name="number" placeholder="Credit Card Number" required>
          </div>
          <div class="expire">
            <div class="date">
              <p>Expires On</p>
              <input type="date" name="date" placeholder="MM/YY" required>
            </div>
            <div class="cvv">
              <p>CVV</p>
              <input id="cvv" type="password" name="cvv" placeholder="000" maxlength="3" required>
            </div>
          </div>
          <div class="modal-address">
            <input type="address" name="address" placeholder="Address" required>
          </div>
          <div class="modal-postal">
            <input id="postal" type="text" name="postal" placeholder="Postal Code" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" name="button" onclick="checkoutModal()">Cancel</button>
          <button type="button" name="button" onclick="validate()">Submit</button>
        </div>
      </div>
    </div>
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
             <p>Address</p>
           </div>
           <div class="address-info">
             <?php if (isset($_SESSION['customerId'])) {echo '<p>'.$row["Address"].'</p>';} else {echo "Please Login/Register to set Address";}?>
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

         <div class="delivery-container">
           <div class="delivery">
             <p>Delivery Date</p>
           </div>
           <div class="date">
             <p><?php
              echo $_GET['date'];
              ?></p>
           </div>
         </div>

       </div>
       <div class="button-container">
         <?php
         if (!isset($_SESSION['userId'])) {
           echo '<a href="login.php"><button type="submit" name="button">Checkout</button></a>';
         } else {
           echo '<button type="submit" name="button" class="checkoutBtn">Checkout</button>';
         }
          ?>
          <a href="cart.php?date=<?php echo $_GET['date'] ?>"><button type="button" name="button">Back</button></a>
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
  var mealInfoExtract = JSON.parse(localStorage.getItem('mealsInCart'));

  window.onload = function displayCart(){
      //loop cart container====================================================
      for (i = 1; i <= numberOfMeals; i++){
        var addMenu = document.getElementsByClassName('container-wrapper')[0];
        var addOnMenuRow = document.createElement('div');
        var addOnMenuRowContent = `
         <div class="left-container">
           <div class="product-img">
             <img src="` + mealInfoExtract[i]["meals"]["MealPicture"] + `" alt="">
           </div>
           <div class="product-description">
             <div class="prod-title">
               <p>` + mealInfoExtract[i]["meals"]["MealName"] + `</p>
             </div>
             <p>` + mealInfoExtract[i]["remarks"] + `</p>
           </div>
           <div class="add-ons"></div>
         </div>
         <div class="right-container">
           <div class="prod-nutri">
             <table>
             <tr>
               <th>Calories</th>
               <th>` + mealInfoExtract[i]["nutriValues"]["cal"] + `</th>
             </tr>
             <tr>
               <th>Carbohydrates</th>
               <th>` + mealInfoExtract[i]["nutriValues"]["car"] + `</th>
             </tr>
             <tr>
               <th>Protein</th>
               <th>` + mealInfoExtract[i]["nutriValues"]["protein"] + `</th>
             </tr>
             <tr>
               <th>Fats</th>
               <th>` + mealInfoExtract[i]["nutriValues"]["fats"] + `</th>
             </tr>
             <tr>
               <th>Fibre</th>
               <th>` + mealInfoExtract[i]["nutriValues"]["fib"] + `</th>
             </tr>
           </table>
           </div>
           <div class="price">
             <p>Price : RM` + mealInfoExtract[i]["nutriValues"]["price"] + `</p>
           </div>
         </div>`;

        addOnMenuRow.classList.add('main-container');
        addOnMenuRow.classList.add(i - 1);
        addOnMenuRow.innerHTML = addOnMenuRowContent;
        addMenu.append(addOnMenuRow);
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
                 <p>` + b[z] + 'g' +`</p>
               </div>`;

          addOnMenuRow.classList.add('addon');
          addOnMenuRow.innerHTML = addOnMenuRowContent;
          addMenu.append(addOnMenuRow);
        }
      }
    }

    var checkOut = document.getElementsByClassName('checkoutBtn')[0];
    checkOut.addEventListener('click', checkoutModal);

    function checkoutModal (){
      var modal = document.getElementById('modal-hidden');
      modal.classList.toggle('modal-hidden');
      modal.classList.toggle('checkout-overlay');
    }

    function validate() {
      var name = document.getElementById("name").value;
      var card = document.getElementById("card").value;
      var cvv = document.getElementById("cvv").value;
      var postal = document.getElementById("postal").value;

      if (!isNaN(name) || isNaN(card) || isNaN(cvv) || isNaN(postal)) {
        alert("Invalid Entries!");
        document.getElementById("name").value = null;
        document.getElementById("card").value = null;
        document.getElementById("cvv").value = null;
        document.getElementById("postal").value = null;
      } else {
        checkout();
      }
    }

    function checkout() {
      var totalPrice = 0;
      var jsondata;
      var data = JSON.parse(localStorage.getItem('mealsInCart'));
      var newData = JSON.parse(localStorage.getItem('mealsInCart'));
      var mealNumber = parseInt(localStorage.getItem('cartNumbers'));
      var jsonArray = {};

      for (i = 1; i <= mealNumber; i++){
        delete data[i]['meals'];
        delete data[i]['nutriValues'];
        var addOnValues = Object.values(data[i]);
        var addOnKeys = Object.keys(data[i]);
        var addOn = data[i];
        var newAddOn = newData[i]
        var array = {};
        var indexArray = [];

        for (j = 0; j < addOnValues.length; j++){
          if (addOnValues[j] === 0) {
            delete addOnValues[j];
            delete addOnKeys[j];
          } else {
            indexArray.push(j);
          }
        }

        if (indexArray == '') {
          array = {
            ...array,
            meals : newAddOn['meals'],
            nutriValues : newAddOn['nutriValues']
          }
        } else if (indexArray !== '') {
          for (z = 0; z < indexArray.length; z++){
            array = {
            ...array,
            [addOnKeys[indexArray[z]]]: addOnValues[indexArray[z]],
            meals : newAddOn['meals'],
            nutriValues : newAddOn['nutriValues']
          }
          }

        }

        jsonArray = {
          ...jsonArray,
          [i] : array
        }

        //get total price in cart
        var price = newAddOn['nutriValues']['price'];
        totalPrice += price;

        //update localstorage totalprice
        localStorage.setItem('totalPrice', totalPrice);
      }

      var xhr = new XMLHttpRequest();

      xhr.open("POST", "includes/checkout.php?date=<?php echo $_GET['date']; ?>&totalPrice="+localStorage.getItem('totalPrice'));
      xhr.setRequestHeader("Content-Type", "application/json");
      xhr.send(JSON.stringify(jsonArray));

      xhr.onload = function() {
        console.log(JSON.parse(this.responseText));
      }

      localStorage.removeItem('mealsInCart');
      localStorage.removeItem('cartNumbers');
      localStorage.removeItem('totalPrice');

      alert('Thank you for your purchase!');

      location.href = "order.php";


    }

  </script>
</html>
