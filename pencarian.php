<?php
session_start();
$link = new mysqli("localhost", "root", "", "farmasinaviha"); 


$keyword = $_GET["keyword"];

$semuadata=array();
$ambil = $link->query("SELECT * FROM obat WHERE nama_obat LIKE '%$keyword%' OR deskripsi_obat LIKE '%$keyword%'");
while ($pecah = $ambil->fetch_assoc())
{
	$semuadata[]=$pecah;
}

//echo "<pre>";
//print_r($semuadata);
//echo "</pre>";

?>

<html>
<head>
	<title>Pencarian</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

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
					
				</ul>
			</div>
		</nav>

<div class="container">
<h3>Hasil Pencarian : <?php echo $keyword ?></h3>

<?php if (empty($semuadata)): ?>
	<div class="alert alert-danger">Pencarian obat <strong><?php echo $keyword ?></strong> tidak ditemukan</div>
<?php endif ?>

<div class="row">

	<?php foreach ($semuadata as $key => $value): ?>

	<div class="col-md-3">
		<div class="thumbnail">
			<img src="foto_obat/<?php echo $value['foto_obat'] ?>" alt="" class="img-responsive">
			<div>
				<h3><?php echo $value['nama_obat']; ?></h3>
				<h5>Rp. <?php echo number_format($value['harga_obat']); ?></h5>
				<a href="beli.php?id_obat=<?php echo $value['id_obat']; ?>" class="btn btn-primary">Beli</a>
				<a href="detail.php?id=<?php echo $value['id_obat']; ?>" class="btn btn-default">Detail</a>

				

			</div>
		</div>
	</div>

<?php endforeach ?>

</div>

</div>
</body>
</html>