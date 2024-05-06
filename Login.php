<?php
// Koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$db = "perpustakaan";
$conn = mysqli_connect($host, $user, $pass, $db) or die("Koneksi gagal");
// Cek apakah form di submit
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Ambil data dari form
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Cek apakah username dan password sesuai
    if ($username == "admin" && $password == "admin") {
        // Jika sesuai, mulai session dan simpan username
        session_start();
        $_SESSION['username'] = $username;
        // Redirect ke halaman beranda
        header("Location: beranda.php");
    } else {
        // Jika tidak sesuai, tampilkan pesan error
        echo "<script>alert('Username atau password salah');</script>";
    }
}
// Tutup koneksi
mysqli_close($conn);
?>
<html>
<head>
    <title>Halaman Login</title>
    <style>
html {
	font-size:62.5%;
}
* {
	margin: 0;
	padding: 0;
}
ul, li {
	list-style: none;
}
input {
	border: none;
}
body {
  width: 144rem;
}
body {
  font-family: 'Roboto', sans-serif; 
  background-color: #f0f0f0; 
}
h1 {
  position: absolute;
  left: 47rem ;
  top: 16rem;
  align-items: center;
  display: flex;
  margin: 0rem 0rem 6.8rem 2.5rem;
  font-size: 6.4rem;
  font-weight: 700;
  font-family: Inter, 'Source Sans Pro';
  text-align: center;
  color: #4e994d; 
  font-weight: 700; 
  text-shadow: 2px 2px 4px rgba(0,0,0,0.1); 
}
form {
  position: absolute;
  left: 53rem ;
  top: 28rem;
  align-items: center;
  display: flex;
  flex-direction: column;
  width: 300px;
  margin: 0 auto;
  padding: 20px;
  border: 5px solid #4e994d; 
  background-color: white; 
  box-shadow: 0 0 10px rgba(0,0,0,0.1); 
}
p {
  color: #4e994d; 
  font-weight: 400; 
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
.login-Gmf {
  width: 100%;
  height: 102.4rem;
  overflow: hidden;
  position: relative;
  background-color: #ffffff;
}
.login-Gmf .group-4-omb {
  width: 100%;
  height: 100%;
  position: relative;
}
.login-Gmf .group-4-omb .unsplash-fnglt13xxns-Zkm {
  width: 70.7rem;
  height: 80rem;
  position: absolute;
  left: 0;
  top: 0;
  object-fit: cover;
  vertical-align: top;
}
.login-Gmf .group-4-omb .unsplash-fnglt13xxns-hc5 {
  width: 73.3rem;
  height: 80rem;
  position: absolute;
  left: 70.7rem;
  top: 0;
  object-fit: cover;
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
  left: 59.6rem;
  top: 2rem;
  object-fit: contain;
  vertical-align: top;
}
.login-Gmf .group-4-omb .title-qTP .libple-6u7 {
  width: 10rem;
  height: 6rem;
  position: absolute;
  left: 63.5rem;
  top: 2rem;
  font-size: 5rem;
  font-weight: 300;
  line-height: 1.2125;
  color: #ffffff;
  font-family: Inter, 'Source Sans Pro';
  white-space: nowrap;
}
    </style>
</head>
<body>
<div class="login-Gmf">
    <div class="group-4-omb">
        <img class="unsplash-fnglt13xxns-Zkm" src="./assets/unsplash-fnglt13xxns-ZKf.png"/>
        <img class="unsplash-fnglt13xxns-hc5" src="./assets/unsplash-fnglt13xxns-Q1P.png"/>
        <div class="title-qTP">
            <img class="uiw-global-NiD" src="./assets/uiw-global-169.png"/>
            <p class="libple-6u7">Libple</p>
        </div>
    </div>
</div>
        <h1>Selamat Datang</h1>
    <form action="" method="post">
        <p>Username: <input type="text" name="username" required></p>
        <p>Password: <input type="password" name="password" required></p>
        <p><input type="submit" value="Login"></p>
    </form>
</body>
</html>
