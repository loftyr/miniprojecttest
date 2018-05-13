<?php 
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
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/dashboardstyle.css">
    <link rel="stylesheet" href="../datatabel/css/jquery.dataTables.min.css">

    <title>Dashboard</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #EF9E44;">
      <span class="navbar-brand mb-0 h1">Dashboard</span>
      <span style="font-weight: bold; padding-right: 10px;">Selamat Datang <?= $_SESSION ['name']; ?></span>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item tanda">
            <a href="../dashboard/dashboarduser.php" class="nav-link">CRUD User</a>
          </li>
          <li class="nav-item tanda">
            <a href="../dashboard/dashboardservice.php" class="nav-link">CRUD Service</a>
          </li>
          <li class="nav-item tanda">
            <a href="../dashboard/dashboardcar.php" class="nav-link active">CRUD Car Service</a>
          </li>
          <li class="nav-item">
            <a href="../dashboard/dashboardguides.php" class="nav-link">CRUD Guides</a>
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
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">CRUD Service Car</li>
        </ol>
      </nav>
      
      <?php 
        // Query Simpan Data
        if ( isset($_POST["simpan"]) ) {
          if ( querytambahcar($_POST) > 0 ) {
            ?>
              <div id="boxalert" class="alert alert-primary alert-dismissible fade show" role="alert">
                Data Service <strong>Berhasil Disimpan !!!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
          ;
          } else {
            ?>
              <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Data Service <strong>Gagal Disimpan !!!</strong> Atau <strong>Data Sudah Ada !!!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
          } 
        }


        // Query Edit Data
        if ( isset($_POST["edit"]) ) {
          if ( queryeditcar($_POST) > 0 ) {
            ?>
              <div id="boxalert" class="alert alert-primary alert-dismissible fade show" role="alert">
                Data Service Car <strong>Berhasil DiEdit !!!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
          } else {
            ?>
              <div id="boxalert" class="alert alert-primary alert-dismissible fade show" role="alert">
                Data Service Car <strong>Gagal DiEdit !!!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
          } 
        }

        // query Ambil Data User
        $data = querycar("SELECT * FROM car");

      ?>
      
      <button type="button" class="btn btn-primary" style="margin-bottom: 20px;" data-toggle="modal" data-target="#modalcar">
        Tambah Service
      </button>

      <div class="table-responsive" style="margin-bottom: 50px;">
        <table class="table-hover table-bordered" id="tableuser">
          <thead>
            <tr>
              <th style="width: 5%;">ID</th>
              <th style="width: 5%;">Service ID</th>
              <th style="width: 20%;">Location</th>
              <th style="width: 15%;">Type Car</th>
              <th style="width: 15%;">Price</th>
              <th style="width: 20%;">Additional Service</th>
              <th style="width: 5%;">Seat</th>
              <th style="width: 15%;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ( $data as $d ) : ?>
              <tr>
                <td><?= $d["id"] ?></td>
                <td><?= $d["service_id"] ?></td>
                <td><?= $d["location"] ?></td>
                <td><?= $d["type_car"] ?></td>
                <td><?= $d["price"] ?></td>
                <td><?= $d["additional_services"] ?></td>
                <td><?= $d["seat"] ?></td>
                <td>
                  <a href="../include/hapuscar.php?id=<?= $d["id"]; ?>" onclick="return confirm('Apakah Anda Yakin Menghapus Service <?= $d["service_id"]; ?> ?');" class="btn btn-danger btn-sm">Hapus</a> / 
                  <a href="" id="edit" class="btn btn-info btn-sm"
                    data-toggle="modal"
                    data-target="#modaledit"
                    data-id="<?= $d["id"]; ?>"
                    data-lokasi="<?= $d["location"]; ?>"
                    data-tipecar="<?= $d["type_car"]; ?>"
                    data-price="<?= $d["price"]; ?>"
                    data-additional="<?= $d["additional_services"]; ?>"
                    data-seat="<?= $d["seat"]; ?>"

                  >Edit</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    
    <!-- Modal Tambah User -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalcar" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Car Service</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body">
            <form action="" method="post">
              <?php 
                $serviceid = queryservice("SELECT * FROM service WHERE type = 'car' ");
              ?>
              <div class="form-group">
                <label for="serviceid">Service ID</label>
                <select name="serviceid" id="serviceid" class="form-control">
                  <?php foreach ($serviceid as $si) :?>
                    <option value="<?= $si['id'] ?>"><?= $si['id'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="form-group">
                <label for="lokasi">Lokasi</label>
                <input type="text" class="form-control" id="lokasi" name="lokasi" required>
              </div>              
              
              <div class="form-group">
                <label for="tipecar">Type Car</label>
                <input type="text" class="form-control" id="tipecar" name="tipecar" required>
              </div>

              <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
              </div>

              <div class="form-group">
                <label for="additional">Additional Service</label>
                <input type="text" class="form-control" id="additional" name="additional" required>
              </div>

              <div class="form-group">
                <label for="seat">Seat</label>
                <input type="number" class="form-control" id="seat" name="seat" required>
              </div>

              <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
            </form>
          </div>

          <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
    <!-- Akhir Modal Tambah User -->

    <!-- Modal Edit User -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modaledit" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Service Car</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body">
            <form action="" method="post">
              <div class="form-group" style="display: none;">
                <label for="id">ID</label>
                <input type="text" class="form-control" id="id" name="id" required>
              </div>

              <div class="form-group">
                <label for="lokasiedit">Lokasi</label>
                <input type="text" class="form-control" id="lokasiedit" name="lokasiedit" required>
              </div>              
              
              <div class="form-group">
                <label for="tipecaredit">Type Car</label>
                <input type="text" class="form-control" id="tipecaredit" name="tipecaredit" required>
              </div>

              <div class="form-group">
                <label for="priceedit">Price</label>
                <input type="number" class="form-control" id="priceedit" name="priceedit" required>
              </div>

              <div class="form-group">
                <label for="additionaledit">Additional Service</label>
                <input type="text" class="form-control" id="additionaledit" name="additionaledit" required>
              </div>

              <div class="form-group">
                <label for="seatedit">Seat</label>
                <input type="number" class="form-control" id="seatedit" name="seatedit" required>
              </div>         

              <button class="btn btn-primary" type="submit" name="edit">Update</button>
            </form>
          </div>

          <div class="modal-footer">
            <button class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>

        </div>
      </div>
    </div>
    <!-- Akhir Modal Edit User -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script language="JavaScript" type="text/javascript" src="../js/jquery-3.3.1.js"></script>
    <script language="JavaScript" type="text/javascript" src="../js/popper.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="../js/bootstrap.js"></script>
    <script language="JavaScript" type="text/javascript" src="../datatabel/js/jquery.dataTables.min.js"></script>
     
    <!-- JS Edit -->
    <script type="text/javascript">
      $(document).on("click", "#edit", function() {
        var id = $(this).data('id');
        var lokasi = $(this).data('lokasi');
        var tipecar = $(this).data('tipecar');
        var price = $(this).data('price');
        var additional = $(this).data('additional');
        var seat = $(this).data('seat');
        
        $(".modal-body #id").val(id);
        $(".modal-body #lokasiedit").val(lokasi);
        $(".modal-body #tipecaredit").val(tipecar);
        $(".modal-body #priceedit").val(price);
        $(".modal-body #additionaledit").val(additional);
        $(".modal-body #seatedit").val(seat);

      })
    </script>


    <!-- JS DataTable -->
    <script language="JavaScript" type="text/javascript">
      $(document).ready( function() {
        $("#tableuser").DataTable({
          "info" : false,
          "ordering" : false
        });
      });
    </script>
  </body>
</html>