<?php 
	require 'function.php';

	$id = @$_GET["id"];

	if ( queryhapuscar($id) > 0 ) {
		echo "
			<script>
				alert('Data Service Berhasil Dihapus!!!');
				document.location.href = '../dashboard/dashboardcar.php';
			</script>
		";
	}else {
		echo "
			<script>
				alert('Data Service Gagal Dihapus!!!');
				document.location.href = '../dashboard/dashboardcar.php';
			</script>
		";
	}

?>