<?php
	session_start();
	if(isset($_POST['masuk'])){
		include 'function.php';

		$user = mysqli_real_escape_string($conn, $_POST['email']);
		$pass = mysqli_real_escape_string($conn, $_POST['password']);

		
		$sql = "SELECT * FROM user WHERE email = '$user'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);

		if ($resultCheck < 1) {
			echo "
			<script>
				alert('Email Tidak Terdaftar!!!');
				document.location.href = '../login.php';
			</script>
			";
			exit();
		}else {
			if ($row = mysqli_fetch_assoc($result)) {
				if ($row['password'] != $pass) {
					echo "
					<script>
						alert('Password Salah !!!');
						document.location.href = '../login.php';
					</script>
					";
					exit();
				}elseif ($row['password'] == $pass) {

					$_SESSION['id'] = $row['id'];
					$_SESSION['name'] = $row['name'];
					$_SESSION['level'] = $row['level'];
					$_SESSION['status'] = "Login";
					
					if ($row['level'] == "vendor") {
						header("location:../dashboard/dashboarduser.php");
					}elseif ($row['level'] == "member") {
						header("location:../page/home.php");
					}
				}
			}
		}
	}
?>