<!DOCTYPE html>
<html>
<head>
	<title></title>
	</style>
</head>
<body>
</body>
</html>

<!-- Form untuk menambah data obat -->
<div class="row">
	<div class="col-lg-6">
		<h3 class="text-primary">Tambah Data Obat</h3>
		<hr style="border-top:1px dotted #000;"/>
		<form action="" method="POST">
			<div class="form-group">
				<label>Nama Obat</label>
				<input type="text" class="form-control" name="nama_obat" placeholder="Masukan Nama Obat" required>
			</div>
			<div class="form-group">
				<label>Harga</label>
				<input type="text" class="form-control" name="harga" placeholder="Masukan Harga" required>
			</div>
        	<button type="submit" class="btn btn-success">
          		<span class="glyphicon glyphicon-floppy-disk"></span> Simpan
        	</button>
		</form>
	</div>
</div>

<?php
require_once('koneksi.php');

if($_POST){
	try {
		// Menuliskan query tambah data obat
		$sql = "INSERT INTO obat (id_obat, nama_obat, harga) VALUES ('".$_POST['id_obat']."', '".$_POST['nama_obat']."', '".$_POST['harga']."')";

		// Cek jika query salah
		if(!$koneksi->query($sql)){
			echo $koneksi->error;
			die();
		}
	} 
	catch (Exception $error) {
		// Cek jika terjadi error
		echo $error;
		die();
	}
	 
	// Redirect ke halaman data obat setelah data ditambahkan
	// echo "<script>
	// 		window.location.href='index.php?lihat=obat/index';
	// 	  </script>";
}
?>
