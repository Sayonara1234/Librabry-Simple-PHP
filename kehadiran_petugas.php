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
// Cek apakah form di submit
if (isset($_POST['submit'])) {
    // Ambil data dari form
    // Mengubah id_petugas, nama, jabatan, shift menjadi array
    $id_petugas = $_POST['id_petugas'];
    $nama = $_POST['nama'];
    $jabatan = $_POST['jabatan'];
    $shift = $_POST['shift'];
    // Mengubah hadir menjadi array yang berisi id_petugas yang hadir
    $hadir = $_POST['hadir'];
    $tanggal = date('Y-m-d'); // Menambahkan tanggal saat ini
    // Simpan data kehadiran ke database
    // Menggunakan loop untuk menyimpan setiap data petugas
    for ($i = 0; $i < count($id_petugas); $i++) {
        // Cek apakah petugas hadir atau tidak
        if (in_array($id_petugas[$i], $hadir)) {
            // Jika hadir, simpan nilai 1
            $hadir_value = 1;
        } else {
            // Jika tidak hadir, simpan nilai 0
            $hadir_value = 0;
        }
        // Membuat query untuk setiap petugas
        $sql = "INSERT INTO kehadiran (id_petugas, nama, jabatan, shift, hadir, tanggal) VALUES 
        ('$id_petugas[$i]', '$nama[$i]', '$jabatan[$i]', '$shift[$i]', '$hadir_value', '$tanggal')";
        // Menambahkan error handling untuk query
        if (mysqli_query($conn, $sql)) {
            // Tampilkan pesan sukses
            echo "<script>alert('Kehadiran berhasil disimpan');</script>";
        } else {
            // Tampilkan pesan error
            echo "<script>alert('Query gagal: " . mysqli_error($conn) . "');</script>";
        }
    }
}
// Cek apakah ada aksi hapus
if (isset($_GET['hapus'])) {
    // Ambil id kehadiran yang akan dihapus
    $id = $_GET['hapus'];
    // Membuat query untuk menghapus data kehadiran
    $sql = "DELETE FROM kehadiran WHERE no = '$id'";
    // Menambahkan error handling untuk query
    if (mysqli_query($conn, $sql)) {
        // Tampilkan pesan sukses
        echo "<script>alert('Kehadiran berhasil dihapus');</script>";
    } else {
        // Tampilkan pesan error
        echo "<script>alert('Query gagal: " . mysqli_error($conn) . "');</script>";
    }
}
// Query data petugas
$sql = "SELECT * FROM petugas";
$result = mysqli_query($conn, $sql) or die("Query gagal");
?>
<html>
<head>
    <title>Kehadiran</title>
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
      width: 80% auto;
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
    <a href="pengembalian.php" class="tab">Pengembalian</a>
    <a href="kehadiran_petugas.php" class="tab active">Kehadiran</a>
  </div>
  <form action="" method="post">
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Shift</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Hadir</th>
        </tr>
        <?php
        // Menampilkan data petugas
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['jabatan'] . "</td>";
            echo "<td>" . $row['shift'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['no_hp'] . "</td>";
            // Menambahkan checkbox untuk menandakan hadir
            // Menambahkan atribut name berupa array untuk mengirim banyak data
            echo "<td><input type='checkbox' name='hadir[]' value='" . $row['id_petugas'] . "'></td>";
            // Menyimpan data petugas ke form
            echo "<input type='hidden' name='id_petugas[]' value='" . $row['id_petugas'] . "'>";
            echo "<input type='hidden' name='nama[]' value='" . $row['nama'] . "'>";
            echo "<input type='hidden' name='jabatan[]' value='" . $row['jabatan'] . "'>";
            echo "<input type='hidden' name='shift[]' value='" . $row['shift'] . "'>";
            echo "</tr>";
            $no++;
        }
        ?>
    </table>
    <p><input style="margin-left: 57rem;" type="submit" name="submit" value="Simpan"></p>
    </form>
    <p><a style="margin-left: 275px;" href="beranda.php">Kembali ke halaman beranda</a></p>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Shift</th>
            <th>Tanggal</th>
            <th>Aksi</th> <!-- Menambahkan kolom aksi -->
        </tr>
        <?php
        // Query data kehadiran
        // Menambahkan klausa WHERE untuk memfilter data yang hadir saja
        $sql = "SELECT * FROM kehadiran WHERE hadir = 1";
        $result = mysqli_query($conn, $sql) or die("Query gagal");

        // Menampilkan data kehadiran
        $no = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $no . "</td>";
            echo "<td>" . $row['nama'] . "</td>";
            echo "<td>" . $row['jabatan'] . "</td>";
            echo "<td>" . $row['shift'] . "</td>";
            // Menghapus kolom hadir karena sudah tidak diperlukan
            // if ($row['hadir'] == 1) {
            //     echo "<td>Hadir</td>";
            // } else {
            //     echo "<td>Tidak Hadir</td>";
            // }
            echo "<td>" . $row['tanggal'] . "</td>";
            // Menambahkan link untuk menghapus data kehadiran
            echo "<td><a href='?hapus=" . $row['no'] . "'>Hapus</a></td>";
            echo "</tr>";
            $no++;
        }
        ?>
    </table>
</body>
</html>