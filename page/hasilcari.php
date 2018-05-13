<?php 
  error_reporting(0);
  require '../include/function.php';

  session_start();

  if(isset($_SESSION ['status']) != "Login"){
    echo "
      <script>
        alert('Harap Login Terlebih Dahulu !!!');
        document.location.href = '../login.php';
      </script>
    ";
  }
  if (isset($_POST['cari'])) {
    $tipecar = $_POST['car'];
    $lokasi = $_POST['lokasi'];
    $price = $_POST['tarif'];

    $datacar = querycaricar("SELECT * FROM car WHERE type_car = '$tipecar' OR location = '$lokasi' OR $price ");

  }elseif (isset($_POST['cariulang'])) {
    $tipecar = $_POST['inputcar'];
    $lokasi = $_POST['inputlokasi'];
    $price = $_POST['input-tarif'];

    $datacar = querycaricar("SELECT * FROM car WHERE type_car = '$tipecar' OR location = '$lokasi' OR $price ");
  }
  
  
  

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/hasil.css">
    <link rel="stylesheet" href="../css/animate.css">

    <title>Aplikasi Tiket Dan Travel</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #EF9E44;">
      <span class="navbar-brand mb-0 h1">Mini Project Tiket Dan Travel</span>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="home.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <span class="nav-link">Halo Member <?= $_SESSION ['name']; ?></span>
          </li>
        </ul>
        <ul class="navbar-nav" id="login">
          <li class="nav-item">
            <a href="../include/proseslogout.php" class="nav-link">Logout</a>
          </li>
        </ul>
      </div>
    </nav>
    
    <div class="container">
      <br>
      <div class="box">
        <form action="" method="POST">
          <div class="form-group form-inline">
            <label for="inputcar">Input Type Car :</label>
            <input type="text" class="form-control" id="inputcar" name="inputcar" required>
            
            <label for="inputlokasi">Input Lokasi :</label>
            <input type="text" class="form-control" id="inputlokasi" name="inputlokasi" required>

            <label for="input-tarif">Tarif :</label>
            <select class="form-control" id="input-tarif" name="input-tarif" required>
              <option value="price < 500000"> < Rp. 500.000</option>
              <option value="price BETWEEN 500000 AND 600000">Rp. 500.000 - Rp. 600.000</option>
              <option value="price BETWEEN 600000 AND 700000">Rp. 600.000 - Rp. 700.000</option>
              <option value="price > 700000"> > Rp. 700.000</option>
            </select>

            <button class="btn btn-primary" id="cariulang" name="cariulang">Cari</button>
          </div>   
        </form>       
      </div>

      <br>
      
      <?php foreach ( $datacar as $dc ) :?>
        <div class="animated flipInX card float-left" style="width: 16.5rem; margin-right: 10px; margin-bottom: 10px;">
          <div class="card-body">
            <h5 class="card-title">Car ID : <?= $dc['id'];  ?></h5>
            <p class="card-text">Lokasi : <?= $dc['location'];  ?></p>
            <p class="card-text">Type Car : <?= $dc['type_car'];  ?></p>
            <p class="card-text">Price : <?= $dc['price'];  ?></p>
            <p class="card-text">Additional Service : <?= $dc['additional_services'];  ?></p>
            <p class="card-text">Seat : <?= $dc['seat'];  ?></p>
            
            <a href="#" class="card-link">Pesan</a>
          </div>
        </div>
      <?php endforeach; ?>

      
  
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>
  </body>
</html>