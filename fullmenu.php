<?php
        include 'config.php'; // Include database connection

        $stmt = $pdo->query("SELECT * FROM menu ORDER BY created_at DESC");
        $menu_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
<style></style>

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



  <main>
       <article>  




       
      
       <section class="section menu" aria-label="menu-label" id="menu">
        <div class="container">
      

          <h2 class="headline-1 section-title text-center" style="margin-top: 30px;">Delicious Menu</h2>

          <ul class="grid-list">

          <?php foreach ($menu_items as $item): ?>
            <li>
            <a href="additem.php?id=<?= $item['id'] ?>">
              <div class="menu-card hover:card">

                <figure class="card-banner img-holder" style="--width: 100; --height: 100;">
                  <!-- <img src="./assets/images/menu-1.png" width="100" height="100" loading="lazy" alt="Greek Salad" class="img-cover"> -->
                  <img src="uploads/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" width="100" height="100">
                </figure>

                <div>


                  <div class="title-wrapper">
                    
                      <h3 class="title-3"><?= htmlspecialchars($item['name']) ?></h3>
                   

                  
                      <span class="span title-2">₹<?= htmlspecialchars($item['price']) ?></span>

                  </div>

                 
                  <p class="card-text label-1"><?= htmlspecialchars($item['description']) ?></p>
               

                </div>

              </div>
              </a>
            </li>
          <?php endforeach; ?>
          </ul>

          <p class="menu-text text-center">
            During winter daily from <span class="span">7:00 pm</span> to <span class="span">9:00 pm</span>
          </p>
          <img src="./assets/images/shape-5.png" width="921" height="1036" loading="lazy" alt="shape"
            class="shape shape-2 move-anim">
          <img src="./assets/images/shape-6.png" width="343" height="345" loading="lazy" alt="shape"
            class="shape shape-3 move-anim">
        
        </div>
      </section>
    </article>
  </main>  
    
      
        <!-- 
          - #FOOTER
        -->
          
      
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
                Soon <span class="span">25% Off.</span>
              </p>
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
      
        
      
      
      
      
      
        <!-- 
          - custom js link
        -->
        <script src="./assets/js/script.js"></script>
      
        <!-- 
          - ionicon link
        -->
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </main>
</body>
</html>