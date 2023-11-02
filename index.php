<?php
session_start();
if (empty($_SESSION['username'])) {
  header("location:login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Rumah Sakit Opon</title>

  <!-- Panggil Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-white">
  <nav class="bg-gray-900">
    <div class="container mx-auto">
      <div class="flex items-center justify-between py-4">
        <div class="flex items-center">
          <!-- Logo -->
          <a class="text-2xl font-bold text-white" href="index.php">Rumah Sakit Opon</a>
        </div>
        
        <!-- Daftar menu yang diinginkan-->
        <div class="flex items-center">
          <ul class="flex space-x-4 text-white">
            <li>
              <a href="index.php">
                <span class="glyphicon glyphicon-home"></span> Beranda
              </a>
            </li>
            <li class="relative">
              <a href="#" class="dropdown-toggle">
                <span class="glyphicon glyphicon-folder-open"></span> &nbsp;Menu
              </a>
              <ul class="absolute left-0 mt-2 bg-black border border-gray-300 rounded-md shadow hidden">
                <li>
                  <a href="index.php?lihat=pasien/index" class="block px-4 py-2 hover:bg-gray-100">
                    <span class="glyphicon glyphicon-user"></span> &nbsp;Pasien</a>
                </li>
                <li>
                  <a href="index.php?lihat=obat/index" class="block px-4 py-2 hover:bg-gray-100">
                    <span class="glyphicon glyphicon-hourglass"></span> &nbsp;Obat</a>
                </li>
                <li>
                  <a href="index.php?lihat=kamar/index" class="block px-4 py-2 hover:bg-gray-100">
                    <span class="glyphicon glyphicon-bed"></span> &nbsp;Kamar</a>
                </li>
              </ul>
            </li>
            <li>
              <a href="index.php?lihat=inap/index">
                <span class="glyphicon glyphicon-list-alt"></span> Rawat Inap
              </a>
            </li>
            <li>
              <a href="index.php?lihat=detail_obat/index">
                <span class="glyphicon glyphicon-tag"></span> Detail Obat
              </a>
            </li>
            <li>
              <a href="index.php?lihat=pembayaran/index">
                <span class="glyphicon glyphicon-usd"></span> Pembayaran
              </a>
            </li>
            <li>
              <a href="logout.php">
                <span class="glyphicon glyphicon-off"></span> Logout
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <div class="container mx-auto">
  

        <!-- Tombol navigasi -->
        <div class="absolute bottom-0 left-0 right-0 flex justify-center space-x-2 mt-4">
          <button @click="activeSlide = Math.max(activeSlide - 1, 0)" class="p-2 bg-gray-900 text-white rounded-full">
            &#8249;
          </button>
          <button @click="activeSlide = Math.min(activeSlide + 1, 2)" class="p-2 bg-gray-900 text-white rounded-full">
            &#8250;
          </button>
        </div>
      </div>
    </div>

    <?php
    /* memanggil perintah sesuai nama file */
if (!empty($_GET['lihat'])) {
	$file = 'panggil/' . $_GET['lihat'] . '.php';
	if (file_exists($file)) {
		include($file);
	} else {
		echo "File tidak ditemukan";
	}
} else {
	include('beranda.php');
}
?>
</div>

  <!-- Panggil JavaScript -->
  <script src="jquery/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script>
    // Fungsi untuk menampilkan dan menyembunyikan dropdown
    document.addEventListener("DOMContentLoaded", function() {
      var dropdownToggle = document.querySelectorAll(".dropdown-toggle");
      dropdownToggle.forEach(function(element) {
        element.addEventListener("click", function() {
          var dropdownMenu = this.nextElementSibling;
          dropdownMenu.classList.toggle("hidden");
        });
      });
    });
  </script>
</body>

</html>