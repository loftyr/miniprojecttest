<?php 
	$conn = mysqli_connect("localhost", "root", "", "travel_db");

	// Crud User
	// Read User
	function queryuser($queryuser) {
		global $conn;

		$result = mysqli_query($conn, $queryuser);
		$rows = [];

		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		return $rows;
	}

	// Create User
	function querytambahuser($data) {
		global $conn;

		$nama = (@$data["nama"]);
		$email = (@$data["email"]);
		$password = (@$data["password"]);
		$level = (@$data["level"]);

		$query = "INSERT INTO user VALUES ('', '$nama', '$email', '$password', '$level');";

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}

	// Hapus User
	function queryhapususer($id) {
		global $conn;

		mysqli_query($conn, "DELETE FROM user WHERE id = $id ");
		return mysqli_affected_rows($conn);
	}

	// Edit User
	function queryedituser($data) {
		global $conn;

		$id = (@$data["id"]);
		$nama = (@$data["namaedit"]);
		$email = (@$data["emailedit"]);
		$password = (@$data["passwordedit"]);
		$level = (@$data["leveledit"]);

		$query = "UPDATE user SET name = '$nama', email = '$email', password = '$password', level = '$level' WHERE id = '$id' ";

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}
	// Akhir Crud User

	// Crud Service
	// Read Service
	function queryservice($queryservice) {
		global $conn;

		$result = mysqli_query($conn, $queryservice);
		$rows = [];

		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		return $rows;
	}

	// Create Service
	function querytambahservice($data) {
		global $conn;

		$userid = (@$data["userid"]);
		$tipe = (@$data["tipe"]);
		$namaservice = (@$data["namaservice"]);

		$query = "INSERT INTO service VALUES ('', '$userid', '$tipe', '$namaservice');";

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}

	// Hapus Service
	function queryhapusservice($id) {
		global $conn;

		mysqli_query($conn, "DELETE FROM service WHERE id = $id ");
		return mysqli_affected_rows($conn);
	}

	// Edit Service
	function queryeditservice($data) {
		global $conn;

		$id = (@$data["id"]);
		$tipe = (@$data["tipeedit"]);
		$namaservice = (@$data["namaserviceedit"]);
		
		$query = "UPDATE service SET type = '$tipe', name_service = '$namaservice' WHERE id = '$id' ";

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}
	// Akhir Crud Service


	// Crud Car
	// Read Car
	function querycar($querycar) {
		global $conn;

		$result = mysqli_query($conn, $querycar);
		$rows = [];

		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		return $rows;
	}

	// Create Car
	function querytambahcar($data) {
		global $conn;

		$serviceid = (@$data["serviceid"]);
		$lokasi = (@$data["lokasi"]);
		$tipecar = (@$data["tipecar"]);
		$price = (@$data["price"]);
		$additional = (@$data["additional"]);
		$seat = (@$data["seat"]);

		$query = "INSERT INTO car VALUES ('', '$serviceid', '$lokasi', '$tipecar', '$price', '$additional', '$seat' );";

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}

	// Hapus Car
	function queryhapuscar($id) {
		global $conn;

		mysqli_query($conn, "DELETE FROM car WHERE id = $id ");
		return mysqli_affected_rows($conn);
	}

	// Edit Car
	function queryeditcar($data) {
		global $conn;

		$id = (@$data["id"]);
		$lokasi = (@$data["lokasiedit"]);
		$tipecar = (@$data["tipecaredit"]);
		$price = (@$data["priceedit"]);
		$additional = (@$data["additionaledit"]);
		$seat = (@$data["seatedit"]);
		
		$query = "UPDATE car SET location = '$lokasi', type_car = '$tipecar', price = '$price', additional_services = '$additional', seat = '$seat' WHERE id = '$id' ";

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}
	// Akhir Crud Car

	// Crud Guides
	// Read Guides
	function queryguides($queryguides) {
		global $conn;

		$result = mysqli_query($conn, $queryguides);
		$rows = [];

		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		return $rows;
	}

	// Create Guides
	function querytambahguides($data) {
		global $conn;

		$serviceid = (@$data["serviceid"]);
		$lokasi = (@$data["lokasi"]);
		$costservice = (@$data["costservice"]);
		$hour = (@$data["hour"]);
		$halfday = (@$data["halfday"]);
		$day = (@$data["day"]);

		$query = "INSERT INTO guides VALUES ('', '$serviceid', '$lokasi', '$costservice', '$hour', '$halfday', '$day' );";

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}

	// Hapus Guides
	function queryhapusguides($id) {
		global $conn;

		mysqli_query($conn, "DELETE FROM guides WHERE id = $id ");
		return mysqli_affected_rows($conn);
	}

	// Edit Guides
	function queryeditguides($data) {
		global $conn;

		$id = (@$data["id"]);
		$lokasi = (@$data["lokasiedit"]);
		$costservice = (@$data["costserviceedit"]);
		$hour = (@$data["houredit"]);
		$halfday = (@$data["halfdayedit"]);
		$day = (@$data["dayedit"]);
		
		$query = "UPDATE guides SET location = '$lokasi', cost_service = '$costservice', hour = '$hour', half_day = '$halfday', day = '$day' WHERE id = '$id' ";

		mysqli_query($conn, $query);
		return mysqli_affected_rows($conn);
	}
	// Akhir Crud Guides


	function querycaricar($querycaricar) {
		global $conn;

		$result = mysqli_query($conn, $querycaricar);
		$rows = [];

		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		return $rows;
	}

	function querycariguides($querycariguides) {
		global $conn;

		$result = mysqli_query($conn, $querycariguides);
		$rows = [];

		while ($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		return $rows;
	}
?>