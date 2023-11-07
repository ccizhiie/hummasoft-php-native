<!DOCTYPE html>
<html>
<head>
	<title>Edit Data Kamar</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
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
			// Jika query berhasil dieksekusi, arahkan kembali ke halaman utama dan tampilkan SweetAlert
			echo "<script>
				Swal.fire({
					icon: 'success',
					title: 'Sukses',
					text: 'Data berhasil diubah',
					confirmButtonColor: '#3085d6',
					confirmButtonText: 'OK'
				}).then((result) => {
					if (result.isConfirmed) {
						window.location.href = 'index.php?lihat=kamar/index';
					}
				});
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
			<input type="hidden" name="id_kamar" value="<?= $data->id_kamar ?? '' ?>">
			<div class="mb-4">
				<label for="nama_kamar" class="text-gray-600 required">Nama Kamar</label>
				<input type="text" value="<?= isset($data->nama_kamar) ? $data->nama_kamar : '' ?>" id="nama_kamar" class="form-input mt-1 block w-full border border-gray-300 rounded-md" name="nama_kamar" required>
			</div>

			<div class="mb-4">
				<label for="kelas" class="text-gray-600 required">Kelas</label>
				<input type="text" value="<?= isset($data->kelas) ? $data->kelas : '' ?>" id="kelas" class="form-input mt-1 block w-full border border-gray-300 rounded-md" name="kelas" required>
			</div>

			<div class="mb-4">
				<label for="kapasitas" class="text-gray-600 required">Kapasitas</label>
				<input type="text" value="<?= isset($data->kapasitas) ? $data->kapasitas : '' ?>" id="kapasitas" class="form-input mt-1 block w-full border border-gray-300 rounded-md" name="kapasitas" required>
			</div>

			<div class="mb-4">
				<label for="harga" class="text-gray-600required">Harga</label>
				<input type="text" value="<?= isset($data->harga) ? $data->harga : '' ?>" id="harga" class="form-input mt-1 block w-full border border-gray-300 rounded-md" name="harga" required>
			</div>

			<div class="mt-6">
				<button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan</button>
				<a href="index.php?lihat=kamar/index" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Batal</a>
			</div>
		</form>
	</div>
</body>
</html>