<?php 
	require 'function.php';

	$id = @$_GET["id"];

	if ( queryhapusguides($id) > 0 ) {
		echo "
			<script>
				alert('Data Berhasil Dihapus!!!');
				document.location.href = '../dashboard/dashboardguides.php';
			</script>
		";
	}else {
		echo "
			<script>
				alert('Data Gagal Dihapus!!!');
				document.location.href = '../dashboard/dashboardguides.php';
			</script>
		";
	}

?>