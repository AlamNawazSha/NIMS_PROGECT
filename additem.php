
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

    </div>
</div>

<img src="./assets/images/shape-4.png" width="179" height="359" loading="lazy" alt="" class="shape shape-1">
<img src="./assets/images/shape-9.png" width="351" height="462" loading="lazy" alt="" class="shape shape-2">






          
        <!-- 
          - #FOOTER
        -->
      
        <footer class="footer section has-bg-image text-center"
          style="background-image: url('./assets/images/footer-bg.jpg')">
          <div class="container">
      
            <div class="footer-top grid-list">
      
              <div class="footer-brand has-before has-after">
      
                <a href="#" class="logo">
                  <img src="./assets/images/logo.svg" width="160" height="50" loading="lazy" alt="grilli home">
                </a>
      
                <address class="body-4">
                  Infantry Road, Bellary City, Karnataka 5830101, India
                </address>
      
                <a href="mailto:alamalam83802@gmail.com" class="body-4 contact-link">alamalam83802@gmail.com</a>
      
                <a href="tel:+91-9590337483" class="body-4 contact-link">Booking Request : +91-9590337483</a>
      
                <p class="body-4">
                  Open : 09:00 am - 01:00 pm
                </p>
      
                <div class="wrapper">
                  <div class="separator"></div>
                  <div class="separator"></div>
                  <div class="separator"></div>
                </div>
      
                <p class="title-1">Get News & Offers</p>
      
                <p class="label-1">
                  Subscribe us & Get <span class="span">25% Off.</span>
                </p>
      
                <form action="" class="input-wrapper">
                  <div class="icon-wrapper">
                    <ion-icon name="mail-outline" aria-hidden="true"></ion-icon>
      
                    <input type="email" name="email_address" placeholder="Your email" autocomplete="off" class="input-field">
                  </div>
      
                  <a  class="btn btn-secondary" onclick="showPopup()">
             
                    <span class="text text-1">Subscribe</span>
      
                    <span class="text text-2" aria-hidden="true">Subscribe</span>
                    
                  </a>
                
                </form>
                <div class="popup" id="popup">
                  <h2>Subscription Successful!</h2>
                  <p>Thank you for subscribing to our newsletter. Stay tuned for updates!</p>
                  <a  class="close-btn" onclick="closePopup()">Close</a>
              </div>
              
              </div>
      
              <ul class="footer-list">
      
                <li>
                  <a href="#" class="label-2 footer-link hover-underline">Home</a>
                </li>
      
                <li>
                  <a href="#menu" class="label-2 footer-link hover-underline">Menus</a>
                </li>
      
                <li>
                  <a href="#about" class="label-2 footer-link hover-underline">About Us</a>
                </li>
      
                <li>
                  <a href="#booking-table" class="label-2 footer-link hover-underline">Contact</a>
                </li>
      
              </ul>
      
              <ul class="footer-list">
      
                <li>
                  <a href="https://bcanims.blogspot.com/" class="label-2 footer-link hover-underline">Facebook</a>
                </li>
      
                <li>
                  <a href="https://bcanims.blogspot.com/" class="label-2 footer-link hover-underline">Instagram</a>
                </li>
      
                <li>
                  <a href="https://bcanims.blogspot.com/" class="label-2 footer-link hover-underline">Twitter</a>
                </li>
      
                <li>
                  <a href="https://bcanims.blogspot.com/" class="label-2 footer-link hover-underline">Youtube</a>
                </li>
      
                <li>
                  <a href="https://bcanims.blogspot.com/" class="label-2 footer-link hover-underline">Google Map</a>
                </li>
      
              </ul>
      
            </div>
      
            <div class="footer-bottom">
      
              <p class="copyright">
                &copy; 2025 ALAM. All Rights Reserved | Crafted by <a href="https://github.com/AlamNawazSha"
                  target="_blank" class="link">ALAM NAWAZ SHA</a>
              </p>
      
            </div>
      
          </div>
        </footer>
      
      
      
      
      
        <!-- 
          - custom js link
        -->
        <script src="./assets/js/script.js"></script>
      
        <!-- 
          - ionicon link
        -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>




</body>
</html>
