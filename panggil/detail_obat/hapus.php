<?php
	require_once('koneksi.php');
	
	try {
		$sql = "DELETE FROM detail_obat WHERE id_detail=".$_GET['id_detail'];
		// Membuat blok try untuk menangani eksekusi perintah SQL DELETE. Mengambil nilai 'id_detail' dari parameter yang diterima melalui URL untuk mengidentifikasi data yang akan dihapus.
		$koneksi->query($sql);
		// Mengeksekusi perintah SQL DELETE yang telah dibuat sebelumnya ke dalam database.


	} 
		catch (Exception $error) {
			echo "<script>
					alert('Data masih digunakan!');
					window.location.href='index.php?lihat=pasien/index';
				</script>";
		// Jika terjadi kesalahan selama eksekusi perintah SQL, kesalahan akan ditangkap dan ditampilkan sebagai pesan. Kemudian, eksekusi skrip PHP akan dihentikan (die()).


	}

  	echo "<script>
			window.location.href='index.php?lihat=detail_obat/index';
	</script>";
	
// Setelah penghapusan berhasil, skrip PHP akan mengarahkan pengguna kembali ke halaman 'index.php?lihat=detail_obat/index' menggunakan JavaScript. Ini akan membawa pengguna ke halaman yang sesuai setelah operasi penghapusan selesai.
?>