<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coolex - Home</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap">
  <link rel="stylesheet" href="css/mdb.min.css">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      color: #383330;
      background-color: #f5f5f5;
    }

    .navbar,
    .footer {
      background-color: #383330;
      color: white;
    }

    .hero-section {
      background-image: url('https://mdbcdn.b-cdn.net/img/new/slides/041.webp');
      background-size: cover;
      background-position: center;
      height: 100vh;
      color: #D4BDA1;
      display: flex;
      align-items: center;
      justify-content: center;
      animation: fadeIn 2s ease-in-out;
    }

    .hero-section h1 {
      font-size: 5rem;
      font-weight: 900;
      animation: slideInDown 2s ease-in-out;
    }

    .hero-section p {
      font-size: 1.5rem;
      margin-top: 20px;
      font-weight: 300;
      animation: slideInUp 2s ease-in-out;
    }

    .about-section {
      padding: 60px 30px;
      text-align: center;
      background-color: #D4BDA1;
      animation: fadeIn 2s ease-in-out;
    }

    .about-section h2 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 20px;
    }

    .about-section p {
      font-size: 1.2rem;
      line-height: 1.6;
    }

    .products-section {
      padding: 60px 30px;
      animation: fadeIn 2s ease-in-out;
    }

    .products-section h2 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 40px;
      text-align: center;
      color: #864622;
    }

    .product-card {
      background-color: white;
      border: 1px solid #ddd;
      border-radius: 8px;
      overflow: hidden;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      animation: fadeInUp 1s ease-in-out;
    }

    .product-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .product-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .product-card .card-body {
      padding: 20px;
      text-align: center;
    }

    .product-card h5 {
      font-size: 1.25rem;
      font-weight: 700;
      margin-bottom: 10px;
    }

    .product-card p {
      font-size: 1rem;
      margin-bottom: 10px;
    }

    .product-card .btn {
      background-color: #864622;
      color: white;
      transition: background-color 0.3s ease;
    }

    .product-card .btn:hover {
      background-color: #C78853;
    }

    .footer {
      padding: 20px 30px;
      text-align: center;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    @keyframes slideInDown {
      from {
        transform: translateY(-50px);
        opacity: 0;
      }

      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    @keyframes slideInUp {
      from {
        transform: translateY(50px);
        opacity: 0;
      }

      to {
        transform: translateY(0);
        opacity: 1;
      }
    }

    @keyframes fadeInUp {
      from {
        transform: translateY(10px);
        opacity: 0;
      }

      to {
        transform: translateY(0);
        opacity: 1;
      }
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Coolex</a>
      <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="registration/login.php">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero-section text-center">
    <div class="container">
      <h1>Welcome to Coolex</h1>
      <p>Your Comfort, Our Priority</p>
    </div>
  </section>

  <!-- About Section -->
  <section class="about-section">
    <div class="container">
      <h2>About Us</h2>
      <p>At Coolex, we strive to bring you the highest quality mattresses and bedding accessories. Our products are designed to provide you with unparalleled comfort and support, ensuring a good night's sleep every night.</p>
    </div>
  </section>

  <!-- Products Section -->
  <section class="products-section">
    <div class="container">
      <h2>Featured Products</h2>
      <div class="row">
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="product-card">
          <img src="https://images.unsplash.com/photo-1560807707-8cc77767d783" alt="Mattress">            <div class="card-body">
              <h5>Deluxe Mattress</h5>
              <p>High-quality mattress for supreme comfort.</p>
              <a href="#" class="btn">Buy Now</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="product-card">
            <img src="https://images.unsplash.com/photo-1560807707-8cc77767d783" alt="Pillow">
            <div class="card-body">
              <h5>Luxury Pillow</h5>
              <p>Luxurious pillows for the best sleep experience.</p>
              <a href="#" class="btn">Buy Now</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="product-card">
            <img src="https://images.unsplash.com/photo-1560807707-8cc77767d783" alt="Bedding Accessories">
            <div class="card-body">
              <h5>Bedding Accessories</h5>
              <p>Durable and stylish bedding accessories.</p>
              <a href="#" class="btn">Buy Now</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <p>&copy; 2024 Coolex. All Rights Reserved.</p>
    </div>
  </footer>

  <script type="text/javascript" src="js/mdb.umd.min.js"></script>
</body>

</html>
