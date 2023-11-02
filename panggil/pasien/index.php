<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
</head>
<body>
	<?php
	/*Skrip ini tidak menggunakan OOP
	/*Memanggil file koneksi hanya satu kali*/
	require_once('koneksi.php');

	$query 	= "SELECT * FROM pasien";
	$link 	= "index.php?lihat=pasien/";
	?>

	<div class="container mx-auto">
		<div class="py-8">
			<h3 class="text-primary text-2xl font-bold mb-4">Data Pasien</h3>
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
							<th class="border-b border-gray-300 px-4 py-2">Id Pasien</th>
							<th class="border-b border-gray-300 px-4 py-2">Nama Pasien</th>
							<th class="border-b border-gray-300 px-4 py-2">Jenis Kelamin</th>
							<th class="border-b border-gray-300 px-4 py-2">No Telp</th>
							<th class="border-b border-gray-300 px-4 py-2">Alamat</th>
							<th class="border-b border-gray-300 px-4 py-2">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						if($data = mysqli_query($koneksi,$query)){
							$no=1;
							while($tampil = mysqli_fetch_object($data)){
							?>

								<tr>
									<td class="border-b border-gray-300 px-4 py-2"><?= $no ?></td>
									<td class="border-b border-gray-300 px-4 py-2"><?= $tampil->id_pasien ?></td>
									<td class="border-b border-gray-300 px-4 py-2"><?= $tampil->nama_pasien?></td>
									<td class="border-b border-gray-300 px-4 py-2"><?= $tampil->jk ?></td>
									<td class="border-b border-gray-300 px-4 py-2"><?= $tampil->no_telp ?></td>
									<td class="border-b border-gray-300 px-4 py-2"><?= $tampil->alamat ?></td>
									<td class="border-b border-gray-300 px-4 py-2">
										<a href="<?= $link.'edit&id_pasien='.$tampil->id_pasien ?>" class="bg-blue-500 text-white rounded-md py-1 px-2 mr-2">
											<span class="glyphicon glyphicon-edit">edit</span>
										</a>
										<a onclick="return confirm('Apakah yakin data akan dihapus?')" href="<?= $link.'hapus&id_pasien='.$tampil->id_pasien ?>" class="bg-red-500 text-white rounded-md py-1 px-2">
											<span class="glyphicon glyphicon-trash">delete</span>
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