<!DOCTYPE html>
<html>
<head>
	<title>Edit Data Obat</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
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

	if ($_POST) {
		// Jika ada data POST, maka proses update data obat
		$id_obat = $_POST['id_obat'];
		$nama_obat = $_POST['nama_obat'];
		$harga = $_POST['harga'];

		$sql = "UPDATE obat SET nama_obat=?, harga=? WHERE id_obat=?";
		$stmt = $koneksi->prepare($sql);
		$stmt->bind_param("sss", $nama_obat, $harga, $id_obat);

		if ($stmt->execute()) {
			// Jika query berhasil dieksekusi, arahkan kembali ke halaman utama
			echo "<script>
				window.location.href='index.php?lihat=obat/index';
				</script>";
		} else {
			echo "Gagal: " . $stmt->error;
		}

		$stmt->close();
		$koneksi->close();
	} else {
		// Jika tidak ada data POST, maka tampilkan data obat yang akan diedit
		$id_obat = $_GET['id_obat'];

		$query = $koneksi->prepare("SELECT * FROM obat WHERE id_obat=?");
		$query->bind_param("s", $id_obat);
		$query->execute();
		$result = $query->get_result();

		if ($result->num_rows > 0) {
			$data = $result->fetch_object();
		} else {
			echo "Data tidak tersedia";
			die();
		}

		$query->close();
	}
	?>

	<div class="container mx-auto py-8">
		<h3 class="text-primary text-2xl font-bold">Edit Data Obat</h3>
		<hr class="border-t-2 border-gray-300 my-4">
		<form action="" method="POST">
			<input type="hidden" name="id_obat" value="<?= $data->id_obat ?>">
			<div class="mb-4">
				<label for="nama_obat" class="text-gray-600 required">Nama Obat</label>
				<input type="text" value="<?= $data->nama_obat ?>" id="nama_obat" class="form-input mt-1 block w-full border border-gray-300 rounded-md" name="nama_obat" required>
			</div>

			<div class="mb-4">
				<label for="harga" class="text-gray-600 required">Harga</label>
				<input type="text" value="<?= $data->harga ?>" id="harga" class="form-input mt-1 block w-full border border-gray-300 rounded-md" name="harga" required>
			</div>

			<button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md">
				Ubah
			</button>
		</form>
	</div>
</body>
</html>