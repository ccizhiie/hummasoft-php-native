<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body>
	<div class="flex justify-center items-center min-h-screen">
		<div class="w-1/2 bg-white p-8 shadow-md">
			<h3 class="text-primary text-2xl font-bold mb-4">Tambah Data Pasien</h3>
			<hr class="border-t-2 border-gray-300 mb-4">

			<form action="" method="POST">
				<div class="mb-4">
					<label class="block text-gray-700 font-bold mb-2" for="nama_pasien">Nama</label>
					<input type="text" class="border border-gray-300 rounded-md p-2 w-full" name="nama_pasien" placeholder="Masukkan Nama" required>
				</div>
				<div class="mb-4">
					<label class="block text-gray-700 font-bold mb-2">Jenis Kelamin</label>
					<div>
						<input name="jk" type="radio" value="Laki-laki" id="jk_laki" required>
						<label for="jk_laki" class="mr-2">Laki-laki</label>
						<input name="jk" type="radio" value="Perempuan" id="jk_perempuan" required>
						<label for="jk_perempuan">Perempuan</label>
					</div>
				</div>
				<div class="mb-4">
					<label class="block text-gray-700 font-bold mb-2" for="no_telp">No Telp</label>
					<input type="text" class="border border-gray-300 rounded-md p-2 w-full" name="no_telp" placeholder="Masukkan No Telp" required>
				</div>
				<div class="mb-4">
					<label class="block text-gray-700 font-bold mb-2" for="alamat">Alamat</label>
					<textarea class="border border-gray-300 rounded-md p-2 w-full" name="alamat" placeholder="Masukkan Alamat" required></textarea>
				</div>

				<button type="submit" class="bg-green-500 text-white rounded-md py-2 px-4">
					<span class="glyphicon glyphicon-floppy-disk"></span> Simpan
				</button>
			</form>
		</div>
	</div>

	<?php
	require_once('koneksi.php');

	if($_POST){
		try {

			// Menuliskan query tambah
			$sql = "INSERT INTO pasien (id_pasien, nama_pasien, jk, no_telp, alamat) VALUES ('".$_POST['id_pasien']."','".$_POST['nama_pasien']."','".$_POST['jk']."','".$_POST['no_telp']."','".$_POST['alamat']."')";

			// Cek jika query salah
			if(!$koneksi->query($sql)){
				echo $koneksi->error;
				die();
			}

		} 

		// Cek jika terjadi error
		catch (Exception $error) {
			echo $error;
			die();
		}
		 
		echo "<script>
				window.location.href='index.php?lihat=pasien/index';
			  </script>";
	}
	?>
</body>
</html>

