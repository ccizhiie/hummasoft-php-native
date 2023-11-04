<?php
	require_once('koneksi.php');
	
	try {
		$sql = "DELETE FROM obat WHERE id_obat=".$_GET['id_obat'];
		
		$koneksi->query($sql);
	} 

	catch (Exception $error) {
		echo "<script>
                alert('Data masih digunakan dan tidak dapat dihapus');
                window.location.href = 'index.php?lihat=inap/index';
            </script>";
	}

  	echo "<script>
			window.location.href='index.php?lihat=obat/index';
	</script>";
?>