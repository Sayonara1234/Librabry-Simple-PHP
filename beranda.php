<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db = "perpustakaan";
$conn = mysqli_connect($host, $user, $pass, $db) or die("Koneksi gagal");

// Cek apakah user sudah login
session_start();
if (!isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: login.php");
}
// Ambil nama user dari session
$username = $_SESSION['username'];
?>
<html>
<head>
    <title>Halaman Beranda</title>
    <style>
.login-Gmf {
  width: 100%;
  height: 102.4rem;
  overflow: hidden;
  position: relative;
  background-color: #ffffff;
}
.login-Gmf .group-4-omb .unsplash-fnglt13xxns-Zkm {
  width: 50%;
  height: 80rem;
  position: relative;
  vertical-align: top;
}
.login-Gmf .group-4-omb .unsplash-fnglt13xxns-hc5 {
  width: 50%;
  height: 80rem;
  position: absolute;
  vertical-align: top;
}
.login-Gmf .group-4-omb .title-qTP {
  width: 144rem;
  height: 10rem;
  position: absolute;
  left: 0;
  top: 0;
  background-color: #4e994d;
}
.login-Gmf .group-4-omb .title-qTP .uiw-global-NiD {
  width: 6rem;
  height: 6rem;
  position: absolute;
  left: 23rem;
  top: 2.5rem;
  object-fit: contain;
  vertical-align: top;
}
.login-Gmf .group-4-omb .title-qTP .libple-6u7 {
  width: 10rem;
  height: 6rem;
  position: absolute;
  left: 26rem;
  top: -2rem;
  font-size: 5rem;
  font-weight: 300;
  line-height: 1.2125;
  font-family: Inter, 'Source Sans Pro';
  white-space: nowrap;
}
.label {
    width: 935px;
    height: 165px;
}
.label .text-wrapper {
margin-top: 5rem;
margin-right: -50;
margin-left: -100;
position: absolute;
top: 15rem;
left: 20rem;
font-family: "Inknut Antiqua-ExtraBold", Helvetica;
font-weight: 800;
color: #ffffff;
font-size: 64px;
letter-spacing: 0;
line-height: normal;
}
.label .text-wrapper2 {
top: 15rem;
margin-right: -50;
margin-left: -50;
right:0;
position: absolute;
font-family: "Inknut Antiqua-ExtraBold", Helvetica;
font-weight: 800;
color: #ffffff;
font-size: 30px;
letter-spacing: 0;
line-height: normal;
}
.tabs {
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 20px 0;
      z-index: 1; /* Menambahkan z-index 1 untuk tab */
    }
    .tab {
      width: 5%; /* Mengurangi width menjadi 5% */
      background-color: white;
      padding: 5px 15px; /* Mengurangi padding menjadi 5px 10px */
      border: 2px solid white;
      border-radius: 10px;
      color: #4e994d;
      font-weight: 400;
      text-decoration: none;
      transition: 0.3s;
    }

    .tab:hover {
      background-color: #4e994d;
      color: white;
    }
    .tab.active {
      background-color: #4e994d;
      color: white;
      border-bottom: none;
      border-radius: 10px 10px 0 0;
    }
    </style>
</head>
<body>
<div class="login-Gmf">
<div class="group-4-omb">
        <background><img class="unsplash-fnglt13xxns-Zkm" src="./assets/unsplash-fnglt13xxns-ZKf.png"/>
        <img class="unsplash-fnglt13xxns-hc5" src="./assets/unsplash-fnglt13xxns-Q1P.png"/></background>
        
        <div class="title-qTP">
            <img class="uiw-global-NiD" src="./assets/uiw-global-169.png"/>
            <p class="libple-6u7">Library Simple</p>
        </div>
    </div>
</div>
    <div class="label">
      <div class="text-wrapper">
        <div class="tabs">
          Selamat Datang di Libple</div>
          <div class="text-wrapper2">
      <a href="list_buku.php" class="tab">List Buku</a>
      <a href="peminjaman.php" class="tab">Peminjaman</a>
      <a href="pengembalian.php" class="tab">Pengembalian</a>
      <a href="kehadiran_petugas.php" class="tab">Kehadiran</a>
      <a href="login.php" class="tab">Log Out</a>
    </div>
    </div>
</body>
</html>