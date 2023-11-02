<?php
	require_once('koneksi.php');
	
	try {
		$sql = "DELETE FROM pasien WHERE id_pasien=".$_GET['id_pasien'];
		
		$koneksi->query($sql);
	} 

	catch (Exception $error) {
		echo "<script>
				alert('Data masih digunakan!');
				window.location.href='index.php?lihat=pasien/index';
			</script>";
		die();
	}

	echo "<script>
			window.location.href='index.php?lihat=pasien/index';
		</script>";
?>