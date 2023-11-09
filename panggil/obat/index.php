<!DOCTYPE html>
<html>
<head>
	<title>Data Obat</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body>
	<?php	
require_once('koneksi.php');

$query 	= "SELECT * FROM obat";
	$link 	= "index.php?lihat=obat/";
	?>

	<div class="container mx-auto">
		<div class="py-8">
			<h3 class="text-primary text-2xl font-bold mb-4">Data Obat</h3>
			<hr class="border-t-2 border-gray-300 mb-4">

			<!-- Tombol Tambah -->
			<a href="<?= $link.'tambah' ?>" class="bg-green-500 text-white rounded-md py-2 px-4 inline-block mb-4">
				<span class="glyphicon glyphicon-plus"></span> Tambah
			</a>

			<!-- Menampilkan Tabel -->
			<div class="overflow-x-auto">
				<table class="border border-gray-300 w-full">
					<thead>
						<tr class="bg-gray-200">
							<th class="border-b border-gray-300 px-4 py-2">No</th>
							<th class="border-b border-gray-300 px-4 py-2">Id Obat</th>
							<th class="border-b border-gray-300 px-4 py-2">Nama Obat</th>
							<th class="border-b border-gray-300 px-4 py-2">Harga</th>
							<th class="border-b border-gray-300 px-4 py-2">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if ($data = mysqli_query($koneksi, $query)) {
							$no = 1;
							//mengambil data dan dikoneksikan 
							while ($tampil = mysqli_fetch_object($data)) {
								// Membersihkan karakter yang tidak diinginkan
								$harga_clean = preg_replace('/[^0-9.,]/', '', $tampil->harga);
								?>

								<tr>
									<td class="border-b border-gray-300 px-4 py-2"><?= $no ?></td>
									<td class="border-b border-gray-300 px-4 py-2"><?= $tampil->id_obat ?></td>
									<td class="border-b border-gray-300 px-4 py-2"><?= $tampil->nama_obat ?></td>
									<td class="border-b border-gray-300 px-4 py-2">
										<?= 'Rp ' . number_format($harga_clean, 0, ',', '.') ?>
									</td>
									<td class="border-b border-gray-300 px-4 py-2">
										<a href="<?= $link.'edit&id_obat='.$tampil->id_obat ?>" class="bg-blue-500 text-white rounded-md py-1 px-2 mr-2">
											<span class="glyphicon glyphicon-edit">edit</span>
										</a>
										<a onclick="return confirm('Apakah yakin data akan dihapus?')" href="<?= $link.'hapus&id_obat='.$tampil->id_obat ?>" class="bg-red-500 text-white rounded-md py-1 px-2">
											<span class="glyphicon glyphicon-trash">hapus</span>
										</a>
									</td>
								</tr>

								<?php
								$no++;
							}//Tutup while
						}//Tutup if
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
