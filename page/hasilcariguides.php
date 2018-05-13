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

  if (isset($_POST['cariguides'])) {
    $lokasi = $_POST['lokasi'];
    $hour = $_POST['tarif-jam'];
    $half = $_POST['tarif-half'];
    $day = $_POST['tarif-day'];

    $data = querycariguides("SELECT * FROM guides WHERE location = '$lokasi' OR $hour OR $half OR $day ");

  }elseif (isset($_POST['cariulang'])) {
    $lokasi = $_POST['input-lokasi'];
    $hour = $_POST['per-jam'];
    $half = $_POST['half-day'];
    $day = $_POST['per-day'];

    $data = querycariguides("SELECT * FROM guides WHERE location = '$lokasi' OR $hour OR $half OR $day ");
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
    <link rel="stylesheet" href="../css/hasilcari.css">
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
          <div class="row">
            <div class="col-sm-4">
              <div class="form-group">
                <label for="input-lokasi">Input Lokasi</label>
                <input type="text" class="form-control" name="input-lokasi" id="input-lokasi" required>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <label for="per-jam">Tarif Per Jam</label>
                <select class="form-control" id="per-jam" name="per-jam" required>
                  <option value="hour < 25000"> < Rp. 25.000</option>
                  <option value="hour BETWEEN 25000 AND 50000">Rp. 25.000 - Rp. 50.000</option>
                  <option value="hour BETWEEN 50000 AND 75000">Rp. 50.000 - Rp. 75.000</option>
                  <option value="hour > 75000"> > Rp. 75.000</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <label for="half-day">Tarif Per Half-Day</label>
                <select class="form-control" id="half-day" name="half-day" required>
                  <option value="half_day < 100000"> < Rp. 100.000</option>
                  <option value="half_day BETWEEN 100000 AND 150000">Rp. 100.000 - Rp. 150.000</option>
                  <option value="half_day BETWEEN 150000 AND 200000">Rp. 150.000 - Rp. 200.000</option>
                  <option value="half_day > 200000"> > Rp. 200.000</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2">
              <div class="form-group">
                <label for="per-day">Tarif Per Day</label>
                <select class="form-control" id="per-day" name="per-day" required>
                  <option value="day < 250000"> < Rp. 250.000</option>
                  <option value="day BETWEEN 250000 AND 350000">Rp. 250.000 - Rp. 350.000</option>
                  <option value="day BETWEEN 350000 AND 500000">Rp. 350.000 - Rp. 500.000</option>
                  <option value="day > 500000"> > Rp. 500.000</option>
                </select>
              </div>
            </div>
            <div class="col-sm-2">
              <button class="btn btn-primary" id="cariulang" name="cariulang">Cari</button>
            </div>
          </div>
        </form>       
      </div>

      <br>
      
      <?php foreach ( $data as $d ) :?>
        <div class="animated flipInX card float-left" style="width: 16.5rem; margin-right: 10px; margin-bottom: 10px;">
          <div class="card-body">
            <h5 class="card-title">Guides ID : <?= $d['id'];  ?></h5>
            <p class="card-text">Lokasi : <?= $d['location'];  ?></p>
            <p class="card-text">Cost Service : <?= $d['cost_service'];  ?></p>
            <p class="card-text">Tarif Per Jam : <?= $d['hour'];  ?></p>
            <p class="card-text">Tarif Per Half-Day : <?= $d['half_day'];  ?></p>
            <p class="card-text">Tarif Per Day : <?= $d['day'];  ?></p>
            
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