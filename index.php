<!DOCTYPE html>
<html>

<head>
  <title>Rumah Sakit Opon</title>

  <!-- Panggil Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-white">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <!-- Logo -->
      <a class="navbar-brand" href="#">
        <img src="https://th.bing.com/th?id=OIP.YKY8sKGTpEL81DAibyXOsgHaHa&w=250&h=250&c=8&rs=1&qlt=90&o=6&dpr=1.3&pid=3.1&rm=2" width="30" height="30" class="d-inline-block align-text-top">
        Rumah Sakit Opon
      </a>

      <!-- Daftar menu yang diinginkan -->
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <span class="glyphicon glyphicon-home"></span> Beranda
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <span class="glyphicon glyphicon-folder-open"></span> Menu
          </a>
          <ul class="dropdown-menu" aria-labelledby="menuDropdown">
            <li><a class="dropdown-item" href="index.php?lihat=pasien/index"><span
                  class="glyphicon glyphicon-user"></span> Pasien</a></li>
            <li><a class="dropdown-item" href="index.php?lihat=obat/index"><span
                  class="glyphicon glyphicon-hourglass"></span> Obat</a></li>
            <li><a class="dropdown-item" href="index.php?lihat=kamar/index"><span
                  class="glyphicon glyphicon-bed"></span> Kamar</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?lihat=inap/index">
            <span class="glyphicon glyphicon-list-alt"></span> Rawat Inap
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?lihat=detail_obat/index">
            <span class="glyphicon glyphicon-tag"></span> Detail Obat
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.php?lihat=pembayaran/index">
            <span class="glyphicon glyphicon-usd"></span> Pembayaran
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">
            <span class="glyphicon glyphicon-off"></span> Logout
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container">
    

    <?php
    /* memanggil perintah sesuai nama file */
    if (!empty($_GET['lihat'])) {
      include('panggil/' . $_GET['lihat'] . '.php');
    } else {
      include 'beranda.php';
    }
    ?>

  </div>

  <!-- Panggil Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>