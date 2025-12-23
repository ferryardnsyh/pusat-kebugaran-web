<?php
// Konfigurasi koneksi database
$host = "localhost"; 
$user = "dbadmin"; 
$password = "AditFerrySani1+";  
$dbname = "db_pusatkebugaran"; 

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Menghapus kelas
if (isset($_GET['hapus'])) {
    $id_kelas = $_GET['hapus'];
    $sql_hapus = "DELETE FROM kelas WHERE id_kelas=$id_kelas";
    if ($conn->query($sql_hapus)) {
        echo "<script>alert('Kelas berhasil dihapus!'); window.location.href='daftar_kelas.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus kelas.');</script>";
    }
}

// Query untuk mengambil data kelas
$sql_kelas = "SELECT * FROM kelas";
$result_kelas = $conn->query($sql_kelas);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kelas</title>
    <style>
        body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background: #f9f9f9;
    color: #333;
}

h1 {
    text-align: center;
    font-size: 2.5rem;
    color: #333;
    margin: 20px 0;
    font-weight: bold;
    text-transform: uppercase;
    letter-spacing: 1.5px;
}

.container {
    max-width: 1100px;
    margin: 20px auto;
    padding: 20px;
    background: #ffffff;
    border-radius: 10px;
    border: 1px solid #ddd;
}

.button {
    display: inline-block;
    margin-bottom: 20px;
    padding: 12px 20px;
    font-size: 16px;
    font-weight: bold;
    color: #fff;
    background-color: #f39c12; /* Warna kuning-oranye */
    border: none;
    border-radius: 6px;
    text-decoration: none;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

.button:hover {
    background-color: #08233f; /* Warna biru tua */
    transform: scale(1.05);
}

table {
    width: 100%;
    border-collapse: collapse;
    overflow: hidden;
    background: #ffffff;
    border: 1px solid #ddd;
    border-radius: 10px;
}

table th, table td {
    padding: 15px;
    text-align: left;
    font-size: 1rem;
}

table th {
    background-color: #f39c12; /* Warna kuning-oranye */
    color: #ffffff;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: bold;
    border: 1px solid #ddd;
}

table td {
    border: 1px solid #ddd;
}

table tr:hover {
    background-color: #f1f3f5;
    cursor: pointer;
}

table tr:last-child td {
    border-bottom: none;
}

table td a {
    font-weight: bold;
    text-decoration: none;
    transition: color 0.3s ease-in-out;
}

table td a[href*='edit'] {
    color: #f39c12; /* Warna kuning-oranye */
}

table td a[href*='edit']:hover {
    color: #08233f; /* Warna biru tua */
}

table td a[href*='hapus'] {
    color: #dc3545; /* Warna merah */
    font-weight: bold;
}

table td a[href*='hapus']:hover {
    color: #b02a37; /* Warna merah gelap */
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Daftar Kelas</h1>

        <!-- Tombol untuk menambah kelas -->
        <a href="tambah_kelas.php" class="button">Tambah Kelas Baru</a>

        <!-- Tabel daftar kelas -->
        <table>
            <tr>
                <th>ID Kelas</th>
                <th>Nama Kelas</th>
                <th>Jadwal</th>
                <th>Aksi</th>
            </tr>
            <?php if ($result_kelas->num_rows > 0): ?>
                <?php while($row = $result_kelas->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id_kelas']; ?></td>
                        <td><?= $row['nama_kelas']; ?></td>
                        <td><?= $row['jadwal']; ?></td>
                        <td>
                            <a href="edit_kelas.php?id=<?= $row['id_kelas']; ?>">Edit</a> |
                            <a href="?hapus=<?= $row['id_kelas']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')" class="confirm">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Tidak ada data.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

    <?php
    // Tutup koneksi
    $conn->close();
    ?>
</body>
</html>