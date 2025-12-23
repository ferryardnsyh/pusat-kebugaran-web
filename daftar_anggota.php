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

// Menambah anggota
if (isset($_POST['tambah'])) {
    $nama_anggota = $_POST['nama_anggota'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];

    $sql_tambah = "INSERT INTO anggota (nama_anggota, alamat, tanggal_lahir) 
                   VALUES ('$nama_anggota', '$alamat', '$tanggal_lahir')";
    $conn->query($sql_tambah);
}

// Mengedit anggota
if (isset($_POST['edit'])) {
    $id_anggota = $_POST['id_anggota'];
    $nama_anggota = $_POST['nama_anggota'];
    $alamat = $_POST['alamat'];
    $tanggal_lahir = $_POST['tanggal_lahir'];

    $sql_edit = "UPDATE anggota SET nama_anggota='$nama_anggota', alamat='$alamat', tanggal_lahir='$tanggal_lahir' 
                 WHERE id_anggota=$id_anggota";
    $conn->query($sql_edit);
}

// Menghapus anggota
if (isset($_GET['hapus'])) {
    $id_anggota = $_GET['hapus'];
    $sql_hapus = "DELETE FROM anggota WHERE id_anggota=$id_anggota";
    $conn->query($sql_hapus);
}

// Query untuk mengambil data anggota
$sql_anggota = "SELECT * FROM anggota";
$result_anggota = $conn->query($sql_anggota);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota</title>
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
        <h1>Daftar Anggota</h1>

        <button class="button" onclick="location.href='tambah_anggota.php'">Tambah Anggota</button>
        <table>
            <tr>
                <th>ID Anggota</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Tanggal Lahir</th>
                <th>Aksi</th>
            </tr>
            <?php if ($result_anggota->num_rows > 0): ?>
                <?php while($row = $result_anggota->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id_anggota']; ?></td>
                        <td><?= $row['nama_anggota']; ?></td>
                        <td><?= $row['alamat']; ?></td>
                        <td><?= $row['tanggal_lahir']; ?></td>
                        <td>
                            <a href="edit_anggota.php?id=<?= $row['id_anggota']; ?>">Edit</a> |
                            <a href="?hapus=<?= $row['id_anggota']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5">Tidak ada data.</td></tr>
            <?php endif; ?>
        </table>
    </div>

    <?php
    // Tutup koneksi
    $conn->close();
    ?>
</body>
</html>