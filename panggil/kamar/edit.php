<!DOCTYPE html>
<html>
<head>
	<title>Edit Data Kamar</title>
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
		// Jika ada data POST, maka proses update data kamar
		$id_kamar = $_POST['id_kamar'];
		$nama_kamar = $_POST['nama_kamar'];
		$kelas = $_POST['kelas'];
		$kapasitas = $_POST['kapasitas'];
		$harga = $_POST['harga'];

		$sql = "UPDATE kamar SET nama_kamar=?, kelas=?, kapasitas=?, harga=? WHERE id_kamar=?";
		$stmt = $koneksi->prepare($sql);
		$stmt->bind_param("ssisi", $nama_kamar, $kelas, $kapasitas, $harga, $id_kamar);

		if ($stmt->execute()) {
			// Jika query berhasil dieksekusi, arahkan kembali ke halaman utama
			echo "<script>
				window.location.href='index.php?lihat=kamar/index';
				</script>";
		} else {
			echo "Gagal: " . $stmt->error;
		}

		$stmt->close();
		$koneksi->close();
	} else {
		// Jika tidak ada data POST, maka tampilkan data kamar yang akan diedit
		$id_kamar = $_GET['id_kamar'];

		$query = $koneksi->prepare("SELECT * FROM kamar WHERE id_kamar=?");
		$query->bind_param("i", $id_kamar);
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
		<h3 class="text-primary text-2xl font-bold">Edit Data Kamar</h3>
		<hr class="border-t-2 border-gray-300 my-4">
		<form action="" method="POST">
			<input type="hidden" name="id_kamar" value="<?= $data->id_kamar ?>">
			<div class="mb-4">
				<label for="nama_kamar" class="text-gray-600 required">Nama Kamar</label>
				<input type="text" value="<?= $data->nama_kamar ?>" id="nama_kamar" class="form-input mt-1 block w-full border border-gray-300 rounded-md" name="nama_kamar" required>
			</div>

			<div class="mb-4">
				<label for="kelas" class="text-gray-600 required">Kelas</label>
				<input type="text" value="<?= $data->kelas ?>" id="kelas" class="form-input mt-1 block w-full border border-gray-300 rounded-md" name="kelas" required>
			</div>

			<div class="mb-4">
				<label for="kapasitas" class="text-gray-600 required">Kapasitas</label>
				<input type="text" value="<?= $data->kapasitas ?>" id="kapasitas" class="form-input mt-1 block w-full border border-gray-300 rounded-md" name="kapasitas" required>
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