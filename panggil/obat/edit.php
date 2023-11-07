<!DOCTYPE html>
<html>
<head>
	<title>Edit Data Obat</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<style>
		.required::before {
			content: "*";
			color: red;
		}
	</style>
</head>
<body>
	<?php
	// Menggunakan file koneksi.php
	require_once('koneksi.php');

	$data = null;

	if ($_POST) {
		// Jika ada data POST, maka proses update data obat
		$sql = "UPDATE obat SET nama_obat='" . $_POST['nama_obat'] . "', harga='" . $_POST['harga'] . "' WHERE id_obat=" . $_POST['id_obat'];

		if ($koneksi->query($sql) === TRUE) {
			// Jika query berhasil dieksekusi, tampilkan SweetAlert
			echo "<script>
				Swal.fire({
					title: 'Data berhasil diubah',
					icon: 'success',
					confirmButtonColor: '#10B981',
					confirmButtonText: 'OK'
				}).then(() => {
					window.location.href = 'index.php?lihat=obat/index';
				});
			</script>";
		} else {
			echo "Gagal: " . $koneksi->error;
		}

		$koneksi->close();
	} else {
		// Jika tidak ada data POST, maka tampilkan data obat yang akan diedit
		$id_obat = $_GET['id_obat'];

		$query = $koneksi->query("SELECT * FROM obat WHERE id_obat=$id_obat");

		if ($query->num_rows > 0) {
			$data = $query->fetch_assoc();
		} else {
			// Data tidak ditemukan, mungkin akan mengarahkan ke halaman lain atau menampilkan pesan kesalahan
			echo "Data tidak ditemukan";
			die();
		}
	}
	?>

	<div class="container mx-auto py-8">
		<h3 class="text-primary text-2xl font-bold">Edit Data Obat</h3>
		<hr class="border-t-2 border-gray-300 my-4">
		<form action="" method="POST">
			<input type="hidden" name="id_obat" value="<?= $data['id_obat'] ?>">
			<div class="mb-4">
				<label for="nama_obat" class="text-gray-600 required">Nama Obat</label>
				<input type="text" value="<?= isset($data['nama_obat']) ? $data['nama_obat'] : '' ?>" id="nama_obat" class="form-input mt-1 block w-full border border-gray-300 rounded-md" name="nama_obat" required>
			</div>

			<div class="mb-4">
				<label for="harga" class="text-gray-600 required">Harga</label>
				<input type="text" value="<?= isset($data['harga']) ? $data['harga'] : '' ?>" id="harga" class="form-input mt-1 block w-full border border-gray-300 rounded-md" name="harga" required>
			</div>

			<button type="submit" class="bg-green-500 hover-bg-green-600 text-white py-2 px-4 rounded-md">
				Ubah
			</button>
		</form>
	</div>
</body>
</html>
