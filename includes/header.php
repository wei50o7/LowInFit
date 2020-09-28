<?php
if(!isset($_SESSION)) {
  session_start();
  }
 ?>
<header>
  <div class="blank">

  </div>
<div class="header-container sticky" id="navbar">
  <nav class="header-nav">
    <?php
      if (isset($_SESSION['roleId'])) {
        $rid = $_SESSION['roleId'];
        if ($rid === 1 || $rid === 2) {
          echo '<div class="nav-logo">
            <h4><a href="../../LowInFit/index.php">LowInFit</a></h4>
          </div>

          <ul class="nav-ul">
            <li>
              <div class="header-menu-container">
                <a href="../../LowInFit/index.php#menu">Menu</a>
                <div class="menu-dropdown">
                  <ul>
                    <li><a href="../../LowInFit/index.php#chicken">Chicken</a></li>
                    <li><a href="../../LowInFit/index.php#fish">Fish</a></li>
                    <li><a href="../../LowInFit/index.php#vegetables">Vegetables</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li><a href="../../LowInFit/index.php#about">About</a></li>
            <li><a href="../../LowInFit/admin/manageorder.php">Manage</a></li>
            <li><a href="../../LowInFit/includes/logout.php">Logout</a></li>
          </ul>';
        } else if($rid == 3 && $_SESSION['active'] == 1){
          echo '<div class="nav-logo">
            <h4><a href="../../LowInFit/index.php">LowInFit</a></h4>
          </div>

          <ul class="nav-ul">
            <li>
              <div class="header-menu-container">
                <a href="../../LowInFit/index.php#menu">Menu</a>
                <div class="menu-dropdown">
                  <ul>
                    <li><a href="index.php#chicken">Chicken</a></li>
                    <li><a href="index.php#fish">Fish</a></li>
                    <li><a href="index.php#vegetables">Vegetables</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li><a href="index.php#about">About</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="includes/logout.php">Logout</a></li>
            <li>
              <div class="before-hover" id="cart-hover">
                <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
                <div class="overlay">
                  <div class="whole-cart1">
                    <div class="cart-conatainer">
                      <div class="cart-header">
                        <h2>Cart</h2>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>';
        } else {
          echo '<div class="nav-logo">
            <h4><a href="index.php">LowInFit</a></h4>
          </div>

          <ul class="nav-ul">
            <li>
              <div class="header-menu-container">
                <a href="index.php#menu">Menu</a>
                <div class="menu-dropdown">
                  <ul>
                    <li><a href="index.php#chicken">Chicken</a></li>
                    <li><a href="index.php#fish">Fish</a></li>
                    <li><a href="index.php#vegetables">Vegetables</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li><a href="index.php#about">About</a></li>
            <li><a href="login.php">Login/Signup</a></li>
            <li>
              <div class="before-hover" id="cart-hover">
                <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
                <div class="overlay">
                  <div class="whole-cart1">
                    <div class="cart-conatainer">
                      <div class="cart-header">
                        <h2>Cart</h2>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>';
        }
      } else {
        echo '<div class="nav-logo">
          <h4><a href="index.php">LowInFit</a></h4>
        </div>

        <ul class="nav-ul">
          <li>
            <div class="header-menu-container">
              <a href="index.php#menu">Menu</a>
              <div class="menu-dropdown">
                <ul>
                  <li><a href="index.php#chicken">Chicken</a></li>
                  <li><a href="index.php#fish">Fish</a></li>
                  <li><a href="index.php#vegetables">Vegetables</a></li>
                </ul>
              </div>
            </div>
          </li>
          <li><a href="index.php#about">About</a></li>
          <li><a href="login.php">Login/Signup</a></li>
          <li>
            <div class="before-hover" id="cart-hover">
              <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
              <div class="overlay">
                <div class="whole-cart1">
                  <div class="cart-conatainer">
                    <div class="cart-header">
                      <h2>Cart</h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
        </ul>';
      }
     ?>
    <div class="burger">
      <div class="line-1"></div>
      <div class="line-2"></div>
      <div class="line-3"></div>
    </div>
  </nav>
  </div>
</header>

<script src="js/main.js"></script>
<script async>

  var hover = document.getElementById('cart-hover');
  hover.addEventListener('mouseenter', loadCart);
  hover.addEventListener('mouseleave', clearCart);

  function loadCart(){
    var cartNumbers = JSON.parse(localStorage.getItem('cartNumbers'));
    var mealsInCart = JSON.parse(localStorage.getItem('mealsInCart'));
    var totalPrice = JSON.parse(localStorage.getItem('totalPrice'));

    if (!cartNumbers) {
      var addOn = document.getElementsByClassName('whole-cart1')[0];
      var addOnRow = document.createElement('div');
      var addOnRowContent = `
      <div class="emptycart-img">
        <img src="img/emptycart.png">
        <div class="emptycart-p">
          <p>Woops, nothing to see here</p>
        </div>
      </div>
        `;

      addOnRow.classList.add('items-container');
      addOnRow.innerHTML = addOnRowContent;
      addOn.append(addOnRow);
    } else {
      for(i=1;i<=cartNumbers;i++){
        var addOn = document.getElementsByClassName('whole-cart1')[0];
        var addOnRow = document.createElement('div');
        var addOnRowContent = `
        <div class="cart-item">
        <div class="left-cart-pic">
                      <img src="`+ mealsInCart[i]['meals']['MealPicture'] +`" alt="">
                    </div>
                    <div class="right-cart-detail">
                      <div class="right-cart-detail-header">
                        <h6>`+ mealsInCart[i]['meals']['MealName'] +`</h6>
                      </div>
                        <div class="nutrition-detail-container">
                          <div class="left-part-nutrition">
                          <div class="nutrition-row100">
                            <div class="nutrition-detail">Calories&nbsp;&nbsp;&nbsp;`+ mealsInCart[i]['nutriValues']['cal'] +`g </div>
                          </div>
                          <div class="nutrition-row100">
                            <div class="nutrition-detail">Carbohydrates&nbsp;&nbsp;&nbsp;`+ mealsInCart[i]['nutriValues']['car'] +`g </div>
                          </div>
                          <div class="nutrition-row100">
                            <div class="nutrition-detail">Protein&nbsp;&nbsp;&nbsp;`+ mealsInCart[i]['nutriValues']['protein'] +`g </div>
                          </div>
                          <div class="nutrition-row100">
                            <div class="nutrition-detail">Fats&nbsp;&nbsp;&nbsp;`+ mealsInCart[i]['nutriValues']['fats'] +`g </div>
                          </div>
                          <div class="nutrition-row100">
                            <div class="nutrition-detail">Fibres&nbsp;&nbsp;&nbsp;`+ mealsInCart[i]['nutriValues']['fib'] +`g </div>
                          </div>
                        </div>
                        <div class="right-part-detail">
                          <div class="meal-price">Total: RM75</div>
                        </div>
                        </div>
                    </div>
                    </div>
          `;

        addOnRow.classList.add('items-container');
        addOnRow.innerHTML = addOnRowContent;
        addOn.append(addOnRow);
    }
    }

  }

  function clearCart(){

    var wholeCart = document.getElementsByClassName('whole-cart1')[0];
    wholeCart.innerHTML = "";
    var addOnRow = document.createElement('div');
    var addOnRowContent = `
      <div class="cart-header">
        <h2>Cart</h2>
      </div>
    `;

    addOnRow.classList.add('cart-conatainer');
    addOnRow.innerHTML = addOnRowContent;
    wholeCart.append(addOnRow);

    }


</script>
