<?php
    session_start();  // Memulai atau melanjutkan sesi PHP yang ada.

    // Menghubungkan ke database menggunakan mysqli.
    $koneksi = new mysqli('localhost', 'root', '','rumah_sakit');

    // Mengambil data username dan password yang dikirimkan melalui metode POST dari formulir login.
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mengeksekusi query SQL untuk mencocokkan username dan password yang dimasukkan pengguna.
    $query = mysqli_query($koneksi, "select * from users where uname='$username' and upass='$password'");

    // Memeriksa apakah query di atas berhasil dijalankan (TRUE) atau tidak (FALSE).
    if($query == TRUE) {  // Jika query berhasil dieksekusi:
        $_SESSION['username'] = $username; // Menyimpan username dalam sesi untuk mengidentifikasi pengguna yang sudah login.
        header("location:index.php"); // Mengarahkan pengguna ke halaman index.php setelah berhasil login.
    } else { // Jika query gagal dijalankan:
        echo "gagal login"; // Menampilkan pesan "gagal login".
    }
?>
