<?php
// Koneksi ke database PostgreSQL
$host = "db-uts.cnqauce4qea4.ap-southeast-1.rds.amazonaws.com"; // ganti IP sesuai EC2 kamu
$port = "5432";
$dbname = "ecommerce";
$user = "postgres";
$password = "Pokokaman04*"; // ganti sesuai password kamu

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Koneksi ke database gagal: " . pg_last_error());
}

// Query data produk
$query = "SELECT * FROM products";
$result = pg_query($conn, $query);

if (!$result) {
    die("Query error: " . pg_last_error());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Produk Kami</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Produk Kami</h1>
    <div class="produk-container">
        <?php while ($row = pg_fetch_assoc($result)) : ?>
            <div class="produk-card">
                <img src="<?php echo htmlspecialchars($row['gambar']); ?>" alt="Produk">
                <h2><?php echo htmlspecialchars($row['name']); ?></h2>
                <p>Rp <?php echo number_format($row['price'], 0, ',', '.'); ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>

<?php
// Tutup koneksi
pg_close($conn);
?>
