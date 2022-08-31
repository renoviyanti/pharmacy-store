<?php
session_start();
$link = new mysqli("localhost", "root", "", "farmasinaviha"); 

//jika tdk ada session pelanggan (blm login) maka dilarikan ke login.php
if (!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('Silahkan Login');</script>";
	echo "<script>location='login.php';</script>";
}

if (empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
	echo "<script>alert('Tidak bisa checkout, keranjang kosong. Silahkan belanja dulu.');</script>";
	echo "<script>location='index.php';</script>";
}

?>

<html>
<head>
	<title>Checkout</title>
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
		<section class="konten">
			<div class="container">
				<h1>Keranjang Belanja<h1>
					<hr>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Obat</th>
								<th>Harga</th>
								<th>Jumlah</th>
								<th>Sub Harga</th>
							</tr>
						</thead>

						<tbody>
							<?php $nomor=1; ?>
							<?php $totalbelanja = 0; ?>
							<?php foreach ($_SESSION["keranjang"] as $id_obat => $jumlah): ?>
								<!--menampilkan obat yg sedang diperulangkan berdasarkan id_obat -->
								<?php
								$ambilobat = $link->query("SELECT * FROM obat
									WHERE id_obat = '$id_obat'");
								$pecah = $ambilobat->fetch_assoc();
								$subharga = $pecah["harga_obat"]*$jumlah;
//echo "<pre>";
//print_r($pecah);
//echo "</pre>";
								?>

								<tr>
									<td><?php echo $nomor; ?></td>
									<td><?php echo $pecah["nama_obat"];?></td>
									<td>Rp <?php echo number_format($pecah["harga_obat"]); ?></td>
									<td><?php echo $jumlah; ?></td>
									<td>Rp <?php echo number_format($subharga); ?></td>
								</tr>
								<?php $nomor++ ?>
								<?php $totalbelanja+=$subharga; ?>
							<?php endforeach ?>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="4">Total Belanja</th>
								<th>Rp <?php echo number_format($totalbelanja); ?></th>
							</tr>
						</tfoot>
					</table>

					<form method="post">

						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_plg'] ?>" class="form-control" >
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['telp_plg'] ?>" class="form-control" >
								</div>
							</div>
							<div class="col-md-4">
								<select class="form-control" name="id_ongkir">
									<option value="">Pilih Ongkos kirim</option>
									<?php
									$ambil = $link->query("SELECT * FROM ongkir");
									while($perongkir=$ambil->fetch_assoc()){
										?>
										<option value="<?php echo $perongkir["id_ongkir"] ?>">
											<?php echo $perongkir['nama_kota']?>
											Rp <?php echo number_format($perongkir['tarif']) ?>
										</option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<h5>Alamat Lengkap Pengiriman</h5>
							<textarea class="form-control" name="alamat_pengiriman" placeholder="masukan alamat lengkap pengiriman . . ."></textarea>
						</div>
						<button class="btn btn-primary" name="checkout">Checkout</button>
					</form>
					<?php
					if (isset($_POST["checkout"]))
					{
						$id_plg = $_SESSION["pelanggan"]["id_plg"];
						$id_ongkir = $_POST["id_ongkir"];
						$tanggal_pembelian = date("Y-m-d");
						$alamat_pengiriman = $_POST['alamat_pengiriman'];

						$ambil = $link->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
						$arrayongkir = $ambil->fetch_assoc();
						$nama_kota = $arrayongkir['nama_kota'];
						$tarif = $arrayongkir['tarif'];


						$total_pembelian = $totalbelanja + $tarif;

						//1. menyimpan data ke tabel pembelian
						$link->query("INSERT INTO pembelian (id_plg, id_ongkir, tanggal_pembelian, total_pembelian, nama_kota, tarif, alamat_pengiriman) VALUES ('$id_plg', '$id_ongkir', '$tanggal_pembelian', '$total_pembelian', '$nama_kota', '$tarif', '$alamat_pengiriman')");

						//mendapatkan id_pembelian barusan terjadi
						$id_pembelian_barusan = $link->insert_id;

						foreach ($_SESSION ["keranjang"] as $id_obat => $jumlah)
						{

							//mendapatkan data produk berdasarkan id_produk
							$ambil=$link->query("SELECT * FROM obat WHERE id_obat='$id_obat'");
							$perobat = $ambil->fetch_assoc();

							$nama = $perobat['nama_obat'];
							$harga = $perobat['harga_obat']; 

							$subharga = $perobat['harga_obat']*$jumlah;

							$link->query("INSERT INTO pembelian_obat (id_pembelian, id_obat, nama, harga, subharga, jumlah) VALUES ('$id_pembelian_barusan', '$id_obat','$nama', '$harga', '$subharga', '$jumlah')"); 

						//skrip update stok
							$link->query("UPDATE obat SET stok_obat = stok_obat - $jumlah WHERE id_obat='$id_obat'");
						}

						//mengkosongkan keranjang belanja
						unset($_SESSION["keranjang"]);

						//tampilan dialihkan ke halaman nota, nota dari pembelian yang barusan
						echo "<script>alert('Pembelian Sukses');</script>";
						echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";

						

					}
					?>
				</div>
			</section>

			<pre><?php print_r($_SESSION["pelanggan"]); ?></pre>

		</body>
		</html>