
<?php
session_start();
require 'config.php'; // Ensure database connection

if (!isset($_GET['id'])) {
    die("Error: No item ID provided.");
}

$item_id = $_GET['id'];

// Fetch item details from the database
$stmt = $pdo->prepare("SELECT * FROM menu WHERE id = ?");
$stmt->execute([$item_id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    die("Item not found in database!");
}

// Add to cart logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    $cart_item = [
        'id' => $item['id'],
        'name' => $item['name'],
        'price' => $item['price'],
        'image' => $item['image'],
        'quantity' => 1
    ];

    // Check if cart exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if item already exists in cart
    if (isset($_SESSION['cart'][$item_id])) {
        $_SESSION['cart'][$item_id]['quantity']++; // Increase quantity if already added
    } else {
        $_SESSION['cart'][$item_id] = $cart_item; // Add new item to cart
    }

    header("Location: cart.php"); // Redirect to cart
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
        <!-- 
          - primary meta tags
        -->
        <title>ALam Restaurant</title>
        <meta name="title" content="Grilli - Amazing & Delicious Food">
        <meta name="description" content="This is a Restaurant html template made by codewithsadee">
      
        <!-- 
          - favicon
        -->
        <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">
      
        <!-- 
          - google font link
        -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Forum&display=swap" rel="stylesheet">
      
        <!-- 
          - custom css link
        -->
        <link rel="stylesheet" href="assets/css/style.css">
      
        <!-- 
          - preload images
        -->
        <link rel="preload" as="image" href="assets/images/images/hero-slider-1.jpg">
        <link rel="preload" as="image" href="assets/images/images/hero-slider-2.jpg">
        <link rel="preload" as="image" href="assets/images/images/hero-slider-3.jpg">

        <style>
          /* Feed Back*/

/* Feedback Popup Styling */
.feedback-btn {
  margin-top: 1rem;
  background-color: var(--gold-crayola);
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: var(--radius-pill);
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.feedback-btn:hover {
  background-color: #d1a35a;
}

.feedback-popup {
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: var(--black);
  border: 2px solid var(--gold-crayola);
  padding: 2rem;
  border-radius: var(--radius-md);
  z-index: 1000;
  width: 90%;
  max-width: 500px;
  box-shadow: 0 0 20px rgba(0,0,0,0.7);
}

.feedback-popup h3 {
  margin-bottom: 1rem;
  font-size: 1.8rem;
  color: var(--white);
}

.feedback-popup label,
.feedback-popup select,
.feedback-popup textarea {
  display: block;
  width: 100%;
  margin-bottom: 1rem;
  font-size: 1rem;
}

.feedback-popup select,
.feedback-popup textarea {
  padding: 0.5rem;
  border: 1px solid var(--gold-crayola);
  background: #222;
  color: var(--white);
  border-radius: 5px;
}

.feedback-popup button {
  padding: 10px 15px;
  border: none;
  background-color: var(--gold-crayola);
  color: white;
  border-radius: 5px;
  font-weight: bold;
  cursor: pointer;
  margin-right: 10px;
  transition: background-color 0.3s ease;
}

.feedback-popup button:hover {
  background-color: #d1a35a;
}

.feedback-overlay {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.7);
  z-index: 999;
}
        </style>
      
      </head>
<body>
<!-- 
          - #PRELOADER
          in the start of the web site
        -->
      
        <div class="preload" data-preaload>
            <div class="circle"></div>
            <p class="text">Alam</p>
          </div>
          <!-- 
            - #TOP BAR
          -->
        
          <div class="topbar">
            <div class="container">
        
              <address class="topbar-item">
                <div class="icon">
                  <ion-icon name="location-outline" aria-hidden="true"></ion-icon>
                </div>
        
                <span class="span">
                  Infantry Road, Bellary City, Karnataka 5830101, India
                </span>
              </address>
        
              <div class="separator"></div>
        
              <div class="topbar-item item-2">
                <div class="icon">
                  <ion-icon name="time-outline" aria-hidden="true"></ion-icon>
                </div>
        
                <span class="span">Daily : 8.00 am to 10.00 pm</span>
              </div>
        
              <a href="tel:+91-9590337483" class="topbar-item link">
                <div class="icon">
                  <ion-icon name="call-outline" aria-hidden="true"></ion-icon>
                </div>
        
                <span class="span">+91-9590337483</span>
              </a>
        
              <div class="separator"></div>
        
              <a href="mailto:alamalam83802@gmail.com" class="topbar-item link">
                <div class="icon">
                  <ion-icon name="mail-outline" aria-hidden="true"></ion-icon>
                </div>
        
                <span class="span">alamalam83802@gmail.com</span>
              </a>
        
            </div>
          </div>
          <section class="special-dish text-center" aria-labelledby="dish-label">

          <div class="special-dish-banner">
    <img src="uploads/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" width="940" height="900" class="img-cover">
</div>

<header class="header" data-header>
              <div class="container">
            <!-- we have to change the logo -->
                <a href="#" class="logo">
                  <img src="./assets/images/logo.svg" width="160" height="50" alt="Grilli - Home">
                </a>

                <nav class="navbar" data-navbar>

                  <button class="close-btn" aria-label="close menu" data-nav-toggler>
                    <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
                  </button>

                  <a href="#" class="logo">
                    <img src="./assets/images/logo.svg" width="160" height="50" alt="Grilli - Home">
                  </a>

                  <ul class="navbar-list">

                    <li class="navbar-item">
                      <a href="home.php" class="navbar-link hover-underline">
                        <div class="separator"></div>

                        <span class="span">Home</span>
                      </a>
                    </li>
                    
                    <li class="navbar-item">
                      <a href="cart.php" class="navbar-link hover-underline">
                        <div class="separator"></div>

                        <span class="span">Cart</span>
                      </a>
                    </li>

                    <!-- <a href="notifications.php">🔔 </a> -->

                    
                    <li class="navbar-item">
                      <a href="notifications.php" class="navbar-link hover-underline">
                        <div class="separator"></div>

                        <span class="span">Notifications</span>
                      </a>
                    </li>

                    <li class="navbar-item">
                      <a href="user_orders.php" class="navbar-link hover-underline">
                        <div class="separator"></div>

                        <span class="span">Your Orders</span>
                      </a>
                    </li>
                  </ul>

                  <div class="text-center">
                    <p class="headline-1 navbar-title">Visit Us</p>

                    <address class="body-4">
                      Infantry Road, Bellary City, <br>
                      Karnataka 5830101, India
                    </address>

                    <p class="body-4 navbar-text">Open: 9.30 am - 2.30pm</p>

                    <a href="mailto:alamalam83802@grilli.com" class="body-4 sidebar-link">alamalam83802@grilli.com</a>

                    <div class="separator"></div>

                    <p class="contact-label">Booking Request</p>

                    <a href="tel:+91-9590337483" class="body-1 contact-number hover-underline">
                      +91-9590337483
                    </a>
                  </div>

                </nav>

                <button class="nav-open-btn" aria-label="open menu" data-nav-toggler>
                  <span class="line line-1"></span>
                  <span class="line line-2"></span>
                  <span class="line line-3"></span>
                </button>

                <div class="overlay" data-nav-toggler data-overlay></div>

           </div>
  </header>

<div class="special-dish-content bg-black-10">
    <div class="container">
        <img src="./assets/images/badge-1.png" width="28" height="41" loading="lazy" alt="badge" class="abs-img">
        
        <h2 class="headline-1 section-title"><?= htmlspecialchars($item['name']) ?></h2>

        <p class="section-text">
            <?= htmlspecialchars($item['description']) ?>
        </p>

        <div class="wrapper">
            <span class="span body-1">Price: ₹<?= htmlspecialchars($item['price']) ?></span>
        </div>

        <!-- Form to add item to cart -->
        <form action="cart.php" method="post">
    <input type="hidden" name="id" value="<?= isset($item['id']) ? $item['id'] : ''; ?>">
    <input type="hidden" name="name" value="<?= isset($item['name']) ? $item['name'] : ''; ?>">
    <input type="hidden" name="price" value="<?= isset($item['price']) ? $item['price'] : ''; ?>">
    <input type="hidden" name="image" value="<?= isset($item['image']) ? $item['image'] : ''; ?>">
    <label for="quantity" class="span body-1">Quantity</label>
    <input type="number" class="span body-1" name="quantity" id="quantity" value="1" min="1" required>
    
    <button type="submit" name="add_to_cart" class="btn btn-primary">
        <span class="text text-1">Add to Cart</span>
        <span class="text text-2" aria-hidden="true">Add to Cart</span>
</button>


</form>
<!-- Feedback Button -->
<button class="btn btn-primary" onclick="openFeedback()" style="margin-top: 10px; ">
<span class="text text-1">Give Feedback</span>
<span class="text text-2" aria-hidden="true">Give Feedback</span>
</button>

<!-- Feedback Popup Form -->
<div class="feedback-overlay" id="feedbackOverlay"></div>
<div class="feedback-popup" id="feedbackPopup">
  <h3>Rate and Give Feedback</h3>
  <form method="post" action="submit_feedback.php">
    <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
    <label for="rating">Rating (1-5):</label>
    <select name="rating" id="rating" required>
      <option value="">Select</option>
      <?php for ($i = 1; $i <= 5; $i++): ?>
        <option value="<?= $i ?>"><?= $i ?></option>
      <?php endfor; ?>
    </select>
    <label for="comment">Your Feedback:</label>
    <textarea name="comment" id="comment" rows="4" required></textarea>

    <button type="submit" class="btn btn-primary">
    <span class="text text-1">Submit</span>
    <span class="text text-2" aria-hidden="true">Submit</span>
    </button>

    <button type="button" onclick="closeFeedback()" class="btn btn-primary" style="margin-top: 10px; ">
    <span class="text text-1">Cancel</span>
    <span class="text text-2" aria-hidden="true">Cancel</span>
    </button>
  </form>
</div>



    </div>
</div>


<img src="./assets/images/shape-4.png" width="179" height="359" loading="lazy" alt="" class="shape shape-1">
<img src="./assets/images/shape-9.png" width="351" height="462" loading="lazy" alt="" class="shape shape-2">






    
       
      
      
      
      
      
        <!-- 
          - custom js link
        -->
        <script src="./assets/js/script.js"></script>
      
        <!-- 
          - ionicon link
        -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  
<script>
            function openFeedback() {
                document.getElementById('feedbackPopup').style.display = 'block';
                document.getElementById('feedbackOverlay').style.display = 'block';
            }

            function closeFeedback() {
                document.getElementById('feedbackPopup').style.display = 'none';
                document.getElementById('feedbackOverlay').style.display = 'none';
            }
</script>


<!-- Display Feedback Section -->
<h2>User Feedback</h2>
<?php
$stmt = $pdo->prepare("SELECT * FROM feedback WHERE item_id = ? ORDER BY created_at DESC");
$stmt->execute([$item_id]);
$feedbacks = $stmt->fetchAll();

if ($feedbacks):
    foreach ($feedbacks as $fb):
?>
    <div style="border: 1px solid #ccc; padding: 10px; margin: 10px 0;">
        <strong><?= htmlspecialchars($fb['username']) ?></strong>
        <p>Rating: <?= str_repeat("⭐", $fb['rating']) ?> (<?= $fb['rating'] ?>/5)</p>
        <p><?= nl2br(htmlspecialchars($fb['comment'])) ?></p>
        <small><?= $fb['created_at'] ?></small>
    </div>
<?php
    endforeach;
else:
    echo "<p>No feedback yet. Be the first to review!</p>";
endif;
?>



</body>
</html>
