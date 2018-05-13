<?php 
  session_start();

  if(isset($_SESSION ['status']) != "Login"){
    echo "
      <script>
        alert('Harap Login Terlebih Dahulu !!!');
        document.location.href = '../login.php';
      </script>
    ";
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

    <title>Aplikasi Tiket Dan Travel</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #BFD1DB;">
      <span class="navbar-brand mb-0 h1">Mini Project Tiket Dan Travel</span>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a href="../page/home.php" class="nav-link">Home</a>
          </li>
        </ul>
        <ul class="navbar-nav" id="login">
          <li class="nav-item">
            <a href="../include/proseslogout.php" class="nav-link">Logout</a>
          </li>
        </ul>
      </div>
    </nav>

    <div class="main">
      <h3 class="text-center">Selamat Datang Member <?= $_SESSION ['name']; ?> Di Mini Project Tiket Dan Travel</h3>
      <p class="text-center">Service yang kami tawarkan !!!</p>

      <div class="panel" id="satu">
        <h2 class="text-center">Car</h2>

        <form action="hasilcari.php" method="POST">
          <div class="form-group">
            <label for="car">Input Type Car</label>
            <input type="text" name="car" class="form-control" id="car" placeholder="Car" required>
          </div>
          
          <div class="form-group">
            <label for="lokasi">Input Lokasi</label>
            <input type="text" name="lokasi" class="form-control" id="lokasi" placeholder="Lokasi" required>
          </div>

          <div class="form-group">
            <label for="tarif">Tarif Harga Lebih Kecil</label>
            <select class="form-control" id="tarif" name="tarif" required>
              <option value="price < 500000"> < Rp. 500.000</option>
              <option value="price BETWEEN 500000 AND 600000">Rp. 500.000 - Rp. 600.000</option>
              <option value="price BETWEEN 600000 AND 700000">Rp. 600.000 - Rp. 700.000</option>
              <option value="price > 700000"> > Rp. 700.000</option>
            </select>
          </div>

          <button type="submit" class="btn btn-primary" id="cari" name="cari">Cari</button>
        </form>
      </div>

      <div class="panel" id="dua">
        <h2 class="text-center">Guides</h2>

        <form action="hasilcariguides.php" method="POST">       
          <div class="form-group">
            <label for="lokasi">Input Lokasi</label>
            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi" required>
          </div>

          <div class="form-group">
            <label for="tarif-day">Tarif Harga Per Hari</label>
            <select class="form-control" id="tarif-day" name="tarif-day" required>
              <option value="day < 250000"> < Rp. 250.000</option>
              <option value="day BETWEEN 250000 AND 350000">Rp. 250.000 - Rp. 350.000</option>
              <option value="day BETWEEN 350000 AND 500000">Rp. 350.000 - Rp. 500.000</option>
              <option value="day > 500000"> > Rp. 500.000</option>
            </select>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="tarif-jam">Tarif Harga Per Jam</label>
                <select class="form-control" id="tarif-jam" name="tarif-jam" required>
                  <option value="hour < 25000"> < Rp. 25.000</option>
                  <option value="hour BETWEEN 25000 AND 50000">Rp. 25.000 - Rp. 50.000</option>
                  <option value="hour BETWEEN 50000 AND 75000">Rp. 50.000 - Rp. 75.000</option>
                  <option value="hour > 75000"> > Rp. 75.000</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="tarif-half">Tarif Harga Per Half-Day</label>
                <select class="form-control" id="tarif-half" name="tarif-half" required>
                  <option value="half_day < 100000"> < Rp. 100.000</option>
                  <option value="half_day BETWEEN 100000 AND 150000">Rp. 100.000 - Rp. 150.000</option>
                  <option value="half_day BETWEEN 150000 AND 200000">Rp. 150.000 - Rp. 200.000</option>
                  <option value="half_day > 200000"> > Rp. 200.000</option>
                </select>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary" name="cariguides" id="cariguides">Cari</button>
        </form>
      </div>
    </div>
    
    <footer class="text-center">
      <h5>Copyright Lofty Razani</h5>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.js"></script>
  </body>
</html>