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
            <a href="../dashboard/dashboardservice.php" class="nav-link active">CRUD Service</a>
          </li>
          <li class="nav-item tanda">
            <a href="../dashboard/dashboardcar.php" class="nav-link">CRUD Car Service</a>
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
          <li class="breadcrumb-item active" aria-current="page">CRUD Service</li>
        </ol>
      </nav>
      
      <?php 
        // Query Simpan Data
        if ( isset($_POST["simpan"]) ) {
          if ( querytambahservice($_POST) > 0 ) {
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
                Data Service <strong>Gagal Disimpan !!!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
          } 
        }


        // Query Edit Data
        if ( isset($_POST["edit"]) ) {
          if ( queryeditservice($_POST) > 0 ) {
            ?>
              <div id="boxalert" class="alert alert-primary alert-dismissible fade show" role="alert">
                Data Service <strong>Berhasil DiEdit !!!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
          } else {
            ?>
              <div id="boxalert" class="alert alert-primary alert-dismissible fade show" role="alert">
                Data Service <strong>Gagal DiEdit !!!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
          } 
        }

        // query Ambil Data User
        $data = queryservice("SELECT * FROM service");

      ?>
      
      <button type="button" class="btn btn-primary" style="margin-bottom: 20px;" data-toggle="modal" data-target="#modalservice">
        Tambah Service
      </button>

      <div class="table-responsive" style="margin-bottom: 50px;">
        <table class="table-hover table-bordered" id="tableuser">
          <thead>
            <tr>
              <th style="width: 5%;">ID</th>
              <th style="width: 10%;">User ID</th>
              <th style="width: 35%;">Type Service</th>
              <th style="width: 35%;">Nama Service</th>
              <th style="width: 15%;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ( $data as $d ) : ?>
              <tr>
                <td><?= $d["id"] ?></td>
                <td><?= $d["user_id"] ?></td>
                <td><?= $d["type"] ?></td>
                <td><?= $d["name_service"] ?></td>
                <td>
                  <a href="../include/hapusservice.php?id=<?= $d["id"]; ?>" onclick="return confirm('Apakah Anda Yakin Menghapus Service <?= $d["name_service"]; ?> ?');" class="btn btn-danger btn-sm">Hapus</a> / 
                  <a href="" id="edit" class="btn btn-info btn-sm"
                    data-toggle="modal"
                    data-target="#modaledit"
                    data-id="<?= $d["id"]; ?>"
                    data-tipe="<?= $d["type"]; ?>"
                    data-namaservice="<?= $d["name_service"]; ?>"
                  >Edit</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    
    <!-- Modal Tambah User -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modalservice" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Service</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body">
            <form action="" method="post">
              <div class="form-group">
                <label for="userid">User ID</label>
                <input value="<?= $_SESSION ['id']; ?>" type="text" class="form-control" id="userid" name="userid" required readonly>
              </div>
              <div class="form-group">
                <label for="tipe">Type Service</label>
                <select name="tipe" id="tipe" class="form-control" required>
                  <option value="car">Car Service</option>
                  <option value="guides">Guides Service</option>
                </select>
              </div>
              <div class="form-group">
                <label for="namaservice">Nama Service</label>
                <input type="text" class="form-control" id="namaservice" name="namaservice" required>
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
            <h5 class="modal-title" id="exampleModalLabel">Edit Service</h5>

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
                <label for="userid">User ID</label>
                <input value="<?= $_SESSION ['id']; ?>" type="text" class="form-control" id="userid" name="userid" required readonly>
              </div>
              <div class="form-group">
                <label for="tipeedit">Type Service</label>
                <select name="tipeedit" id="tipeedit" class="form-control" required>
                  <option value="car">Car Service</option>
                  <option value="guides">Guides Service</option>
                </select>
              </div>
              <div class="form-group">
                <label for="namaserviceedit">Nama Service</label>
                <input type="text" class="form-control" id="namaserviceedit" name="namaserviceedit" required>
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
        var tipe = $(this).data('tipe');
        var namaservice = $(this).data('namaservice');
        
        $(".modal-body #id").val(id);
        $(".modal-body #tipeedit").val(tipe);
        $(".modal-body #namaserviceedit").val(namaservice);

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