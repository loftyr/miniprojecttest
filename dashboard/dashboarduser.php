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
            <a href="../dashboard/dashboarduser.php" class="nav-link active">CRUD User</a>
          </li>
          <li class="nav-item tanda">
            <a href="../dashboard/dashboardservice.php" class="nav-link">CRUD Service</a>
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
          <li class="breadcrumb-item active" aria-current="page">CRUD User</li>
        </ol>
      </nav>
      
      <?php 
        // Query Simpan Data
        if ( isset($_POST["simpan"]) ) {
          if ( querytambahuser($_POST) > 0 ) {
            ?>
              <div id="boxalert" class="alert alert-primary alert-dismissible fade show" role="alert">
                Data <strong>Berhasil Disimpan !!!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
          ;
          } else {
            ?>
              <div class="alert alert-primary alert-dismissible fade show" role="alert">
                Data <strong>Gagal Disimpan !!!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
          } 
        }


        // Query Edit Data
        if ( isset($_POST["edit"]) ) {
          if ( queryedituser($_POST) > 0 ) {
            ?>
              <div id="boxalert" class="alert alert-primary alert-dismissible fade show" role="alert">
                Data <strong>Berhasil DiEdit !!!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
          } else {
            ?>
              <div id="boxalert" class="alert alert-primary alert-dismissible fade show" role="alert">
                Data <strong>Gagal DiEdit !!!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            <?php
          } 
        }

        // query Ambil Data User
        $data = queryuser("SELECT * FROM user ");

      ?>
      
      <button type="button" class="btn btn-primary" style="margin-bottom: 20px;" data-toggle="modal" data-target="#modaluser">
        Tambah User
      </button>

      <div class="table-responsive" style="margin-bottom: 50px;">
        <table class="table-hover table-bordered" id="tableuser">
          <thead>
            <tr>
              <th style="width: 5%;">ID</th>
              <th style="width: 20%;">Nama</th>
              <th style="width: 25%;">Email</th>
              <th style="width: 25%;">Password</th>
              <th style="width: 10%;">Level</th>
              <th style="width: 15%;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ( $data as $d ) : ?>
              <tr>
                <td><?= $d["id"] ?></td>
                <td><?= $d["name"] ?></td>
                <td><?= $d["email"] ?></td>
                <td><?= $d["password"] ?></td>
                <td><?= $d["level"] ?></td>
                <td>
                  <a href="../include/hapususer.php?id=<?= $d["id"]; ?>" onclick="return confirm('Apakah Anda Yakin Menghapus User <?= $d["name"]; ?> ?');" class="btn btn-danger btn-sm">Hapus</a> / 
                  <a href="" id="edit" class="btn btn-info btn-sm"
                    data-toggle="modal"
                    data-target="#modaledit"
                    data-id="<?= $d["id"]; ?>"
                    data-name="<?= $d["name"]; ?>"
                    data-email="<?= $d["email"]; ?>"
                    data-password="<?= $d["password"]; ?>"
                    data-level="<?= $d["level"]; ?>"
                  >Edit</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
    
    <!-- Modal Tambah User -->
    <div class="modal fade" tabindex="-1" role="dialog" id="modaluser" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          
          <div class="modal-body">
            <form action="" method="post">
              <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="form-group">
                <label for="level">Level</label>
                <select id="level" class="form-control" name="level" required>
                  <option value="vendor">Vendor</option>
                  <option value="member">Member</option>
                </select>
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
            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>

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
                <label for="namaedit">Nama</label>
                <input type="text" class="form-control" id="namaedit" name="namaedit" required>
              </div>
              <div class="form-group">
                <label for="emailedit">Email</label>
                <input type="email" class="form-control" id="emailedit" name="emailedit" required>
              </div>
              <div class="form-group">
                <label for="passwordedit">Password</label>
                <input type="password" class="form-control" id="passwordedit" name="passwordedit" required>
              </div>
              <div class="form-group">
                <label for="leveledit">Level</label>
                <select name="leveledit" id="leveledit" class="form-control" name="leveledit" required>
                  <option value="vendor">Vendor</option>
                  <option value="member">Member</option>
                </select>
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
        var name = $(this).data('name');
        var email = $(this).data('email');
        var password = $(this).data('password');
        var level = $(this).data('level');
        
        $(".modal-body #id").val(id);
        $(".modal-body #namaedit").val(name);
        $(".modal-body #emailedit").val(email);
        $(".modal-body #passwordedit").val(password);
        $(".modal-body #leveledit").val(level);

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