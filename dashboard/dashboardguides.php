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
            <a href="../dashboard/dashboardcar.php" class="nav-link">CRUD Car Service</a>
          </li>
          <li class="nav-item">
            <a href="../dashboard/dashboardguides.php" class="nav-link active">CRUD Guides</a>
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
          <li class="breadcrumb-item active" aria-current="page">CRUD Guides</li>
        </ol>
      </nav>
      
      <?php 
        // Query Simpan Data
        if ( isset($_POST["simpan"]) ) {
          if ( querytambahguides($_POST) > 0 ) {
            ?>
              <div id="boxalert" class="alert alert-primary alert-dismissible fade show" role="alert">
                Data Guides <strong>Berhasil Disimpan !!!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
          ;
          } else {
            ?>
              <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Data Guides <strong>Gagal Disimpan !!!</strong> Atau <strong>Data Sudah Ada !!!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
          } 
        }


        // Query Edit Data
        if ( isset($_POST["edit"]) ) {
          if ( queryeditguides($_POST) > 0 ) {
            ?>
              <div id="boxalert" class="alert alert-primary alert-dismissible fade show" role="alert">
                Data Guides <strong>Berhasil DiEdit !!!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
          } else {
            ?>
              <div id="boxalert" class="alert alert-primary alert-dismissible fade show" role="alert">
                Data Guides <strong>Gagal DiEdit !!!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
          } 
        }

        // query Ambil Data User
        $data = queryguides("SELECT * FROM guides");

      ?>
      
      <button type="button" class="btn btn-primary" style="margin-bottom: 20px;" data-toggle="modal" data-target="#modalguides">
        Tambah Guides
      </button>

      <div class="table-responsive" style="margin-bottom: 50px;">
        <table class="table-hover table-bordered" id="tableuser">
          <thead>
            <tr>
              <th style="width: 5%;">ID</th>
              <th style="width: 5%;">Service ID</th>
              <th style="width: 15%;">Location</th>
              <th style="width: 15%;">Cost Service</th>
              <th style="width: 15%;">Per Hour</th>
              <th style="width: 15%;">Per Half-Day</th>
              <th style="width: 15%;">Per Day</th>
              <th style="width: 15%;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ( $data as $d ) : ?>
              <tr>
                <td><?= $d["id"] ?></td>
                <td><?= $d["service_id"] ?></td>
                <td><?= $d["location"] ?></td>
                <td><?= $d["cost_service"] ?></td>
                <td><?= $d["hour"] ?></td>
                <td><?= $d["half_day"] ?></td>
                <td><?= $d["day"] ?></td>
                <td>
                  <a href="../include/hapusguides.php?id=<?= $d["id"]; ?>" onclick="return confirm('Apakah Anda Yakin Menghapus Service <?= $d["service_id"]; ?> ?');" class="btn btn-danger btn-sm">Hapus</a> / 
                  <a href="" id="edit" class="btn btn-info btn-sm"
                    data-toggle="modal"
                    data-target="#modaledit"
                    data-id="<?= $d["id"]; ?>"
                    data-lokasi="<?= $d["location"]; ?>"
                    data-costservice="<?= $d["cost_service"]; ?>"
                    data-hour="<?= $d["hour"]; ?>"
                    data-halfday="<?= $d["half_day"]; ?>"
                    data-day="<?= $d["day"]; ?>"

                  >Edit</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    
    <!-- Modal Tambah User -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalguides" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Guides</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body">
            <form action="" method="post">
              <?php 
                $serviceid = queryservice("SELECT * FROM service WHERE type = 'guides' ");
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
                <label for="costservice">Cost Service</label>
                <input type="number" class="form-control" id="costservice" name="costservice" required>
              </div>

              <div class="form-group">
                <label for="hour">Per Hour</label>
                <input type="number" class="form-control" id="hour" name="hour" required>
              </div>

              <div class="form-group">
                <label for="halfday">Per Half-Day</label>
                <input type="number" class="form-control" id="halfday" name="halfday" required>
              </div>

              <div class="form-group">
                <label for="day">Per Day</label>
                <input type="number" class="form-control" id="day" name="day" required>
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
            <h5 class="modal-title" id="exampleModalLabel">Edit Guides</h5>

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
                <label for="costserviceedit">Cost Service</label>
                <input type="number" class="form-control" id="costserviceedit" name="costserviceedit" required>
              </div>

              <div class="form-group">
                <label for="houredit">Per Hour</label>
                <input type="number" class="form-control" id="houredit" name="houredit" required>
              </div>

              <div class="form-group">
                <label for="halfdayedit">Per Half-Day</label>
                <input type="number" class="form-control" id="halfdayedit" name="halfdayedit" required>
              </div>

              <div class="form-group">
                <label for="dayedit">Per Day</label>
                <input type="number" class="form-control" id="dayedit" name="dayedit" required>
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
        var costservice = $(this).data('costservice');
        var hour = $(this).data('hour');
        var halfday = $(this).data('halfday');
        var day = $(this).data('day');
        
        $(".modal-body #id").val(id);
        $(".modal-body #lokasiedit").val(lokasi);
        $(".modal-body #costserviceedit").val(costservice);
        $(".modal-body #houredit").val(hour);
        $(".modal-body #halfdayedit").val(halfday);
        $(".modal-body #dayedit").val(day);

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