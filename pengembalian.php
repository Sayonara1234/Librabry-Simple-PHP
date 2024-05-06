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
// Cek apakah ada aksi pengembalian
if (isset($_GET['kembali'])) {
    // Ambil id peminjam dari parameter
    $id_peminjam = $_GET['kembali'];
    // Query untuk mendapatkan data peminjaman
    $sql = "SELECT * FROM peminjam_buku WHERE id_peminjam = $id_peminjam";
    $result = mysqli_query($conn, $sql) or die("Query gagal");
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Ambil data peminjaman
        $judul = $row['judul'];
        $nama = $row['nama'];
        $nim = $row['nim'];
        $jurusan = $row['jurusan'];
        $tanggal_pinjam = $row['tanggal_pinjam'];
        $tanggal_kembali = $row['tanggal_kembali'];
        // Hitung denda jika ada
        $denda = 0;
        $hari_ini = date('Y-m-d');
        $selisih = strtotime($hari_ini) - strtotime($tanggal_kembali);
        $selisih_hari = floor($selisih / (60 * 60 * 24));
        if ($selisih_hari > 0) {
            // Jika terlambat, denda Rp. 1000 per hari
            $denda = $selisih_hari * 1000;
        }
        // Query untuk menghapus data peminjaman
        $sql = "DELETE FROM peminjam_buku WHERE id_peminjam = $id_peminjam";
        mysqli_query($conn, $sql) or die("Query gagal");
        // Query untuk menghapus data pemngembalian
        $sql = "DELETE FROM pengembalian_buku WHERE id_peminjam = $id_peminjam";
        mysqli_query($conn, $sql) or die("Query gagal");
        // Query untuk menambahkan stok buku di database buku
        $sql = "UPDATE buku SET stok = stok + 1 WHERE judul = '$judul'";
        mysqli_query($conn, $sql) or die("Query gagal");
        // Tampilkan pesan sukses
        echo "<script>alert('Pengembalian berhasil. Denda: Rp. $denda');</script>";
    } else {
        // Jika peminjam tidak ditemukan, tampilkan pesan error
        echo "<script>alert('Peminjam tidak ditemukan');</script>";
    }
}
// Query untuk mendapatkan data peminjam buku
$sql = "SELECT * FROM peminjam_buku";
$result = mysqli_query($conn, $sql) or die("Query gagal");
?>
<html>
<head>
    <title>Pengembalian Buku</title>
    <style>
    .tabs {
      display: flex;
      justify-content: center;
      margin: 20px 0;
    }
    .tab {
      background-color: white;
      padding: 10px 20px;
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
    table {
      width: 80%;
      margin: 0 auto;
      border-collapse: collapse;
    }
    th, td {
      padding: 10px;
      border: 1px solid #4e994d;
      text-align: center;
    }
    th {
      background-color: #4e994d;
      color: white;
    }
    tr:hover {
      background-color: #e0e0e0;
    }
    .aksi {
      display: flex;
      justify-content: space-around;
    }
    .aksi a {
      padding: 5px 10px;
      border: 1px solid #4e994d;
      border-radius: 5px;
      color: #4e994d;
      font-weight: 400;
      text-decoration: none;
      transition: 0.3s;
    }
    .aksi a:hover {
      background-color: #4e994d;
      color: white;
    }
    .aksi a.delete {
      background-color: #ff0000;
      color: white;
    }
    .login-Gmf {
  width: 100%;
  height: 10rem;
  overflow: hidden;
  position: relative;
  background-color: #ffffff;
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
  left: 480px;
  top: 2.5rem;
  object-fit: contain;
  vertical-align: top;
}
.login-Gmf .group-4-omb .title-qTP .libple-6u7 {
  width: 10rem;
  height: 6rem;
  position: absolute;
  left: 590px;
  top: -2rem;
  font-size: 5rem;
  font-weight: 300;
  line-height: 1.2125;
  font-family: Inter, 'Source Sans Pro';
  white-space: nowrap;
}
  </style>
  <div class="login-Gmf">
<div class="group-4-omb">
  <div class="title-qTP">
            <img class="uiw-global-NiD" src="./assets/uiw-global-169.png"/>
            <p class="libple-6u7">Libple</p>
        </div>
      </div>
</head>
<body>
</div>
<div class="tabs">
    <a href="list_buku.php" class="tab">List Buku</a>
    <a href="peminjaman.php" class="tab">Peminjaman</a>
    <a href="pengembalian.php" class="tab active">Pengembalian</a>
    <a href="kehadiran_petugas.php" class="tab">Kehadiran</a>
  </div>
    <h1 style="margin-left: 525px;">Pengembalian Buku</h1>
    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>Judul Buku</th>
            <th>Nama Peminjam</th>
            <th>NIM</th>
            <th>Jurusan</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <?php
        // Menampilkan data peminjam buku
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no . "</td>";
            echo "<td>" . $row['judul'] . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['nim'] . "</td>";
            echo "<td>" . $row['jurusan'] . "</td>";
            echo "<td>" . $row['tanggal_pinjam'] . "</td>";
            echo "<td>" . $row['tanggal_kembali'] . "</td>";
            // Menambahkan link untuk mengembalikan buku
            echo "<td><a href='?kembali=" . $row['id_peminjam'] . "'>Kembalikan</a></td>";
            echo "</tr>";
            $no++;
        }
        ?>
    </table>
    <p><a style="margin-left: 135px;" href="beranda.php">Kembali ke halaman beranda</a></p>
</body>
</html>
