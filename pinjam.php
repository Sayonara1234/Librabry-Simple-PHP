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
// Cek apakah ada parameter id buku dari halaman list buku
if (isset($_GET['id_buku'])) {
    // Ambil id buku dari parameter
    $id_buku = $_GET['id_buku'];
} else {
    // Jika tidak ada parameter, redirect ke halaman list buku
    header("Location: list_buku.php");
}
// Cek apakah form di submit
if (isset($_POST['nama_peminjam']) && isset($_POST['nim']) && isset($_POST['jurusan']) 
&& isset($_POST['tanggal_pinjam']) && isset($_POST['tanggal_kembali'])) {
    // Ambil data dari form
    $nama_peminjam = $_POST['nama_peminjam'];
    $nim = $_POST['nim'];
    $jurusan = $_POST['jurusan'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];
    $tanggal_kembali = $_POST['tanggal_kembali'];
    // Cek apakah peminjam sudah terdaftar
    $sql = "SELECT * FROM peminjam_buku WHERE nim = '$nim'";
    $result = mysqli_query($conn, $sql) or die("Query gagal");
    if (mysqli_num_rows($result) > 0) {
        // Jika peminjam sudah terdaftar, tampilkan pesan error
        echo "<script>alert('Anda sudah meminjam buku ini');</script>";
    } else {
        // Jika peminjam belum terdaftar, cek apakah buku tersedia
        $sql = "SELECT stok, judul FROM buku WHERE id_buku = $id_buku";
        $result = mysqli_query($conn, $sql) or die("Query gagal");
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $stok = $row['stok'];
            $judul_buku = $row['judul'];
            if ($stok > 0) {
                // Jika buku tersedia, kurangi stok buku
                $stok--;
                $sql = "UPDATE buku SET stok = $stok WHERE id_buku = $id_buku";
                mysqli_query($conn, $sql) or die("Query gagal");
                // Simpan data peminjaman ke database
                $sql = "INSERT INTO peminjam_buku (judul, nama, nim, jurusan, tanggal_pinjam, tanggal_kembali) VALUES 
                ('$judul_buku', '$nama_peminjam', '$nim', '$jurusan', '$tanggal_pinjam', '$tanggal_kembali')";
                mysqli_query($conn, $sql) or die("Query gagal");
                // Simpan data pengembalian ke database
                $sql = "INSERT INTO pengembalian_buku (judul, nama, nim, jurusan, tanggal_pinjam, tanggal_kembali) VALUES 
                ('$judul_buku', '$nama_peminjam', '$nim', '$jurusan', '$tanggal_pinjam', '$tanggal_kembali')";
                mysqli_query($conn, $sql) or die("Query gagal");
                // Tampilkan pesan sukses
                echo "<script>alert('Peminjaman berhasil');</script>";
            } else {
                // Jika buku tidak tersedia, tampilkan pesan error
                echo "<script>alert('Buku tidak tersedia');</script>";
            }
        } else {
            // Jika buku tidak ditemukan, tampilkan pesan error
            echo "<script>alert('Buku tidak ditemukan');</script>";
        }
    }
}
?>
<html>
<head>
    <title>Peminjaman</title>
    <style>
body {
    background-color: #f0f0f0;
    font-family: 'Inter', sans-serif;
}
h1 {
    text-align: center;
    color: #4e994d;
    font-weight: 700;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
}
form {
    width: 300px;
    margin: 0 auto;
    padding: 20px;
    border: 5px solid #4e994d;
    background-color: white;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}
input {
    display: block;
    width: 100%;
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #4e994d;
    border-radius: 5px;
}
input[type="submit"] {
    background-color: #4e994d;
    color: white;
    font-weight: 700;
    transition: 0.3s;
}
input[type="submit"]:hover {
    background-color: #3c7f3c;
    transform: scale(1.1);
}
a {
    color: #4e994d;
    font-weight: 400;
    text-decoration: none;
    transition: 0.3s;
}
a:hover {
    color: #3c7f3c;
    text-decoration: underline;
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
tr:nth-child(even) {
    background-color: #f0f0f0;
}
tr:hover {
    background-color: #e0e0e0;
}
</style>
</head>
<body>
    <h1>Peminjaman</h1>
    <p style="margin-left: 500px; margin-top: 40px;">Silakan isi formulir berikut:</p>
    <form action="" method="post">
        <p>Nama Peminjam: <input type="text" name="nama_peminjam" required></p>
        <p>NIM: <input type="text" name="nim" required></p>
        <p>Jurusan: <input type="text" name="jurusan" required></p>
        <p>Tanggal Pinjam: <input type="date" name="tanggal_pinjam" required></p>
        <p>Tanggal Kembali: <input type="date" name="tanggal_kembali" required></p>
        <p><input type="submit" value="Pinjam"></p>
    </form>
    <p><a style="margin-left: 500px;" href="list_buku.php">Kembali ke halaman list buku</a></p>
</body>
</html>