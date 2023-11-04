<?php
	require_once('koneksi.php');
	
	try {
		$sql = "DELETE FROM pembayaran WHERE id_pembayaran=".$_GET['id_pembayaran'];
		
		$koneksi->query($sql);
	} 

	catch (Exception $error) {
		echo "<script>
                alert('Data masih digunakan dan tidak dapat dihapus');
                window.location.href = 'index.php?lihat=inap/index';
            </script>";
	}

  	echo "<script>
			window.location.href='index.php?lihat=pembayaran/index';
	</script>";
?>