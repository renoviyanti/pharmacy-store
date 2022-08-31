<?php $link = new mysqli("localhost", "root", "", "farmasinaviha"); ?>
<!DOCTYPE html>
<html>
<head>
	<title>daftar</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

	<!-- navbar -->
	<nav class="navbar navbar-default">
		<div class="container">
			<ul class="nav navbar-nav">
				<li><a href="index.php">Home</a></li>
				<li><a href="keranjang.php">Keranjang</a></li>
				<li><a href="checkout.php">Checkout</a></li>

				<!-- jk sudah login (ada session pelanggan) -->
				<?php if (isset($_SESSION["pelanggan"])): ?>
					<li><a href="riwayat.php">Riwayat Belanja</a></li>
					<li><a href="logout.php">Logout</a></li>

					<!-- selain itu (blm login) -->
					<?php else: ?>
						<li><a href="login.php">Login</a></li>
						<li><a href="daftar.php">Daftar</a></li>
					<?php endif ?>

					<li><a href="tentangkami.php">Tentang Kami</a></li>

					</ul>

				</div>
			</nav>


		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Daftar Pelanggan</h3>
						</div>
						<div class="panel-body">
							<form method="post" class="form-horizontal">
								<div class="form-group">
									<label class="control-label col-md-3">Nama</label>
									<div class="col-md-7">
										<input type="text" class="form-control" name="nama">
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Email</label>
									<div class="col-md-7">
										<input type="email" class="form-control" name="email" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Password</label>
									<div class="col-md-7">
										<input type="text" class="form-control" name="password" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Alamat</label>
									<div class="col-md-7">
										<textarea class="form-control" name="alamat" required></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Kota</label>
									<div class="col-md-7">
										<input type="text" class="form-control" name="kota" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Provinsi</label>
									<div class="col-md-7">
										<input type="text" class="form-control" name="provinsi" required>
									</div>
								</div>
								<div class="form-group">
									<label class="control-label col-md-3">Kode Pos</label>
									<div class="col-md-7">
										<input type="text" class="form-control" name="kodepos"required>
									</div>
								</div>					
									<div class="form-group">
									<label class="control-label col-md-3">Telp/HP</label>
									<div class="col-md-7">
										<input type="number" class="form-control" name="telepon" required>
									</div>
								</div>
								<div class="form-group">
									<div class="col-md-7 col-md-offset-3">
										<button class="btn btn-primary" name="daftar">Daftar</button>
									</div>
								</div>
							</form>

							<?php 

							 // jika tombol daftar ditekan
							if (isset($_POST["daftar"])) 
							{
								// mengambil data pada kolom daftar
								$nama = $_POST["nama"];
								$email = $_POST["email"];
								$password = $_POST["password"];
								$alamat = $_POST["alamat"];
								$kota = $_POST["kota"];
								$provinsi = $_POST["provinsi"];
								$kodepos = $_POST["kodepos"];
								$telepon = $_POST["telepon"];


								// cek apakah email sudah digunakan
								$ambil = $link->query("SELECT * FROM pelanggan WHERE email_plg='$email'");
								$yangcocok = $ambil->num_rows;

								if ($yangcocok==1) 
								{
									echo "<script>alert('pendaftaran gagal, email sudah digunakan');</script>";
									echo "<script>location='daftar.php';</script>";
								}
								else
								{
									// query insert kedalam tabel pelanggan yuhu
									$link->query("INSERT INTO pelanggan (email_plg, password_plg, nama_plg, alamat_plg, kota_plg, provinsi_plg, kodepos_plg, telp_plg) VALUES ('$email', '$password', '$nama', '$alamat', '$kota', '$provinsi','$kodepos', '$telepon')");

									echo "<script>alert('pendaftaran sukses, silahkan login'); </script>"; 
									echo "<script>location='login.php'; </script>";

								}
							}
							?>



							
							
						</div>
					</div>
				</div>
			</div>
		</div>
</body>
</html>