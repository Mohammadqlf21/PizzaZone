<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pizza Zone - Delicious Pizzas Delivered Fast</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="../css/Home_Page.css">
  <script>
    var isLoggedIn = <?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>;
    console.log('isLoggedIn:', isLoggedIn);
  </script>
  
</head>
<body>
  <header>
    <div class="logo">PIZZA <span>ZONE</span></div>
    <nav class="header-nav">
      <a href="#menu" class="smooth-scroll">MENU</a>
      <a href="#deals" class="smooth-scroll">DEALS</a>
      <a href="#rewards" class="smooth-scroll">REWARDS</a>
      <a href="#locations" class="smooth-scroll">LOCATIONS</a>
    </nav>
  <div class="header-actions">
  

  <?php if (isset($_SESSION['user_id'])) : ?>
    <a href="#menu" >Start Your Order</a>
    <a href="myorders.php">My Orders</a>
    
  <?php endif; ?>

  <?php if (!isset($_SESSION['user_id']) || (isset($_SESSION['guest']) && $_SESSION['guest'] === true)) : ?>
    <a href="index.php">SIGN IN</a>
    <a href="signup_form.php">SIGN UP</a>
  <?php endif; ?>
</div>


  </header>

  <div class="hero">
    <h2>Authentic Italian Pizzas</h2>
    <p>Handcrafted with love using traditional recipes and the freshest ingredients</p>
  </div>

  <div class="promo-banner">
    🎉 Today's Special: 20% Off All Large Pizzas! Use code: BIG20 🎉
  </div>

  <div class="promo">
    <label>Do you have a promo code?</label>
    <div class="promo-input">
      <input type="text" id="promoCode" placeholder="Enter promo code">
      <button onclick="applyPromo()">Apply</button>
    </div>
    <p id="promoMessage" style="margin-top: 0.5rem; color: var(--primary); font-weight: bold;"></p>
  </div>

  <div class="container" id ="menu">
    <h2 class="section-title">Crust Options</h2>
    <div class="pizza-grid">
      <div class="pizza-card">
        <img src="../css/pics/original crust.jpg" alt="Original crust">
        <div class="pizza-info">
          <h3>Original Crust</h3>
          <p>Our signature dough. Fresh, never frozen. Made with 6 simple ingredients & hand-tossed.</p>
          
        </div>
      </div>
      <div class="pizza-card">
        <img src="../css/pics/garlic.jpg" alt="Garlic stuffed crust">

        <div class="pizza-info">
          <h3>Garlic Epic Stuffed Crust</h3>
          <p>Our signature garlic flavor stuffed into and drizzled on the cheesy crust. Served with Special Garlic Dipping Sauce.</p>
          
        </div>
      </div>
      <div class="pizza-card">
        <img src="../css/pics/epic stuffed.jpeg" alt="Epic stuffed crust">
        <div class="pizza-info">
          <h3>Epic Stuffed Crust</h3>
          <p>Our original dough stuffed with melty cheese and baked to a crispy, golden goodness.</p>
          
        </div>
      </div>
      <div class="pizza-card">
        <img src= "../css/pics/new york.jpeg" alt="New York style crust">
        <div class="pizza-info">
          <h3>New York Style Crust</h3>
          <p>Our original dough hand-stretched, and cut into oven foldable slices.</p>
          
        </div>
      </div>
    </div>

    <h2 class="section-title">Most Popular</h2>
    <div class="pizza-grid">
      <div class="pizza-card">
        <img src="../css/pics/BBQ.jpg" alt="BBQ chicken pizza">
        <div class="pizza-info">
          <h3>BBQ Chicken Pizza</h3>
          <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <span class="rating-count" style="color: #666; font-size: 0.8rem;"> (248)</span>
          </div>
          <p>Smoky BBQ sauce, chicken, red onions, cilantro</p>
          <div class="price">From $10.49</div>
          <a href="#" class="order-btn" onclick="checkLoginBeforeOrder('BBQ Chicken Pizza', 'A smoky delight with grilled chicken, red onions, and our signature BBQ sauce', { small: 10.49, medium: 14.49, large: 17.99 })">ORDER NOW</a>
        </div>
      </div>
      <div class="pizza-card">
        <img src="../css/pics/Margherita pizza.jpg" alt="Margherita pizza">
        <div class="pizza-info">
          <h3>Margherita Pizza</h3>
          <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <span class="rating-count" style="color: #666; font-size: 0.8rem;"> (312)</span>
          </div>
          <p>Tomato sauce, mozzarella, fresh basil</p>
          <div class="price">From $7.99</div>
          <a href="#" class="order-btn" onclick="checkLoginBeforeOrder('Margherita Pizza', 'Classic simplicity with fresh tomatoes, mozzarella, and basil', { small: 7.99, medium: 10.99, large: 13.99 })">ORDER NOW</a>
        </div>
      </div>
      <div class="pizza-card">
        <img src="../css/pics/mix cheese.jpg" alt="Mix cheese pizza">
        <div class="pizza-info">
          <h3>Mix Cheese Pizza</h3>
          <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
            <span class="rating-count" style="color: #666; font-size: 0.8rem;"> (189)</span>
          </div>
          <p>Mozzarella, cheddar, parmesan, gouda blend</p>
          <div class="price">From $9.49</div>
          <a href="#" class="order-btn" onclick="checkLoginBeforeOrder('Mix Cheese Pizza', 'A cheese lover\'s dream with four premium cheeses' ,  { small: 9.49, medium: 12.99, large: 15.99 })">ORDER NOW</a>
        </div>
      </div>
    </div>

    <h2 class="section-title">More Choices</h2>
    <div class="pizza-grid">
      <div class="pizza-card">
        <img src="../css/pics/vegtable.jpg" alt="Vegetable pizza">
        <div class="pizza-info">
          <h3>Vegetable Pizza</h3>
          <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="far fa-star"></i>
            <span class="rating-count" style="color: #666; font-size: 0.8rem;"> (156)</span>
          </div>
          <p>Bell peppers, mushrooms, onions, olives, tomatoes</p>
          <div class="price">From $8.49</div>
          <a href="#" class="order-btn" onclick="checkLoginBeforeOrder('Vegetable Pizza', 'Fresh garden vegetables on a crisp crust' ,  { small: 8.49, medium: 11.99, large: 14.99 })">ORDER NOW</a>
        </div>
      </div>
      <div class="pizza-card">
        <img src="../css/pics/alfredo-chicken-pizza.jpg" alt="Alfredo pizza">
        <div class="pizza-info">
          <h3>Alfredo Pizza</h3>
          <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <span class="rating-count" style="color: #666; font-size: 0.8rem;"> (203)</span>
          </div>
          <p>Creamy alfredo sauce, chicken, spinach, mushrooms</p>
          <div class="price">From $10.99</div>
          <a href="#" class="order-btn" onclick="checkLoginBeforeOrder('Alfredo Pizza', 'Creamy alfredo sauce with grilled chicken' , { small: 10.99, medium: 15.99, large: 18.99 })">ORDER NOW</a>
        </div>
      </div>
      <div class="pizza-card">
        <img src="../css/pics/pep.jpg" alt="Pepperoni Pizza">
        <div class="pizza-info">
          <h3>Pepperoni Pizza</h3>
          <div class="rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <span class="rating-count" style="color: #666; font-size: 0.8rem;"> (427)</span>
          </div>
          <p>Double pepperoni, extra cheese, tomato sauce</p>
          <div class="price">From $9.99</div>
          <a href="#" class="order-btn" onclick="checkLoginBeforeOrder('Pepperoni Pizza', 'Classic pepperoni with extra cheese' , { small: 9.99, medium: 13.99, large: 16.99 } )">ORDER NOW</a>
        </div>
      </div>
    </div>
  </div>
<section class="drinks-section">
  <div class="container">
    <h2 class="drinks-title">
      Drinks Options
    </h2>
    <div class="drink-cards">
      <div class="drink-card">
        <img src="../css/pics/matrix.jpeg" alt="Coca Cola" class="drink-img">
        <div class="drink-info">
          <h3 class="drink-name">Matrix</h3>
          <p class="drink-desc">Chilled classic Coke. Refresh your taste.</p>
        </div>
      </div>
      <div class="drink-card">
        <img src="../css/pics/sprite.jpeg" alt="Sprite" class="drink-img">
        <div class="drink-info">
          <h3 class="drink-name">Sprite</h3>
          <p class="drink-desc">Lemon-lime soda for a zesty boost.</p>
        </div>
      </div>
      <div class="drink-card">
        <img src="../css/pics/ice.jpeg" alt="ice tea" class="drink-img">
        <div class="drink-info">
          <h3 class="drink-name">ice tea</h3>
          <p class="drink-desc">Refreshing iced tea with a hint of lemon for a cool, citrusy lift.</p>
        </div>
      </div>
      <div class="drink-card">
        <img src="../css/pics/cocktail.jpeg" alt="Orange Juice" class="drink-img">
        <div class="drink-info">
          <h3 class="drink-name">Orange Juice</h3>
          <p class="drink-desc">Freshly squeezed. A healthy choice!</p>
        </div>
      </div>
    </div>
  </div>
</section>


  <div class="modal" id="orderModal">
    <div class="modal-content">
      <div class="modal-header">
        <h2 id="pizzaTitle">Order Pizza</h2>
        <button class="close-btn" onclick="closeModal()">&times;</button>
      </div>
      <p id="pizzaDescription" class="pizza-description"></p>
      
      <label for="size">Choose Size:</label>
      <select id="size">
        <option value="small">Small - $8.99 (10")</option>
        <option value="medium">Medium - $12.99 (12")</option>
        <option value="large">Large - $15.99 (14")</option>
      </select>

      <label for="crust">Crust Type:</label>
      <select id="crust">
        <option value="Original">Original Hand-Tossed</option>
        <option value="Garlic_Crust">Garlic Epic Stuffed Crust (+$1.00)</option>
        <option value="Epic_Crust">Epic Stuffed Crust (+$1.50)</option>
        <option value="NewYork_Crust">New York Style Crust (+$2.00)</option>
      </select>

      <label for="address">Delivery Address:</label>
      <input type="text" id="address" placeholder="Enter your full address">

      <label>Payment Method:</label>
      <div class="radio-group">
        <div class="radio-option">
          <input type="radio" id="cash" name="payment" value="cash" onclick="toggleVisa(false)" checked>
          <label for="cash">Cash on Delivery</label>
        </div>
        <div class="radio-option">
          <input type="radio" id="visa" name="payment" value="visa" onclick="toggleVisa(true)">
          <label for="visa">Credit/Debit Card</label>
        </div>
      </div>

      <div class="visa-info" id="visaInfo">
        <div class="card-icons">
          <i class="fab fa-cc-visa"></i>
          <i class="fab fa-cc-mastercard"></i>
          <i class="fab fa-cc-amex"></i>
          <i class="fab fa-cc-discover"></i>
        </div>
        <label for="cardNumber">Card Number:</label>
        <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
          <div>
            <label for="expiry">Expiry Date:</label>
            <input type="text" id="expiry" placeholder="MM/YY">
          </div>
          <div>
            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" placeholder="123">
          </div>
        </div>
      </div>

      <label for="instructions">Special Instructions (optional):</label>
      <input type="text" id="instructions" placeholder="Any special requests?">

      <button class="order-btn-modal" onclick="confirmOrder()">
        <i class="fas fa-shopping-cart"></i> Place Order
      </button>
    </div>
  </div>

  <div id="toast" class="toast">
    Order placed successfully! Your pizza will arrive in 30-45 minutes.
  </div>
<section class="hot-deals">
  <div class="hot-deals-inner">
    <h2><span>🔥</span>Hot Deals</h2>
      <h5>Coming Soon!</h5><br>
    <div class="deals-container" id="deals">
      <div class="deal-card">
        <img src="..\css\pics\Buy1get1.jpeg" alt="BOGO Deal">
        <div class="deal-info">
          <p><strong>Buy 1 Get 1 Free:</strong> On all pizzas every Wednesday!</p>
          <button class="claim">Claim Deal</button>
        </div>
      </div>

      <div class="deal-card">
        <img src="..\css\pics\discount.jpeg" alt="20% Off Deal">
        <div class="deal-info">
          <p><strong>20% Off:</strong> First order through our mobile app.</p>
          <button class="download">Download App</button>
        </div>
      </div>

      <div class="deal-card">
        <img src="..\css\pics\Combo.jpeg" alt="Combo Deal">
        <div class="deal-info">
          <p><strong>Combo Deal:</strong> Pizza + Drink + Side for just $9.99</p>
          <button class="order">Order Now</button>
        </div>
      </div>
    </div>
  </div>
  </section>
<section class="rewards-section" id="rewards">
  <h2><span>🎁</span>Rewards Program</h2>

  <div class="reward-card">
    <div class="reward-info">
      <p>Join our loyalty program and earn points with every purchase:</p>

      <ul class="reward-list">
        <li>⭐ 1 point per $1 spent</li>
        <li>🎉 100 points = Free Medium Pizza</li>
        <li>🏆 Exclusive members-only discounts</li>
      </ul>

      <button class="join">Join Now</button>
    </div>

    <div class="reward-image">
      <img src="..\css\pics\Loyalty.jpeg"alt="Rewards Image">
    </div>
  </div>
</section>

<section id="locations" >
  <h2>📍 Our Locations</h2>
  <p>Find a store near you:</p>
  
    amman-queen-alia-street <br>
    madaba-street
    
  
</section>



  <footer>
    <div class="footer-content">
      <div class="footer-section">
        <h3>About Pizza Zone</h3>
        <p>Authentic Italian pizzas made with love since 2010. We use only the freshest ingredients and traditional recipes.</p>
      </div>
      <div class="footer-section">
        <h3>Quick Links</h3>
        <a href="#menu">Menu</a>
        <a href="#">Locations</a>
        
        <a href="https://www.instagram.com/mohammad_qlf21/">About Me</a>
      </div>
      <div class="footer-section">
        <h3>Contact Us</h3>
        
        <p><i class="fas fa-envelope"></i> M.alhasan3@gju.edu.jo</p>
        <p><i class="fas fa-map-marker-alt"></i> Amman-pizza street</p>
        <div class="social-icons">
          
          <a href="https://www.instagram.com/mohammad_qlf21/"><i class="fab fa-instagram"></i></a>
          
        </div>
      </div>
    </div>
    <div class="copyright">
      &copy; 2023 Pizza Zone. All rights reserved.
    </div>
  </footer>

    
<script>
    function checkLoginBeforeOrder(pizzaName, description, prices) {
        if (<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>) {
            openModal(pizzaName, description, prices);
        } else {
            if (confirm('You need to login to order. Go to login page now?')) {
                window.location.href = 'index.php';
          }
      }
  }
</script>

<script>
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });

</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const buttons = document.querySelectorAll(".claim, .download, .join , .order");

    buttons.forEach(button => {
      button.addEventListener("click", function () {
        alert("This feature will be added soon");
      });
    });
  });
</script>

<script src="../javascript/orderModal.js"></script>


</body>
</html>