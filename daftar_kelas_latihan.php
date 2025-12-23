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

// Menghapus kelas latihan
if (isset($_GET['hapus'])) {
    $id_latihan = $_GET['hapus'];
    $sql_hapus = "DELETE FROM kelas_latihan WHERE id_latihan=$id_latihan";
    if ($conn->query($sql_hapus)) {
        echo "<script>alert('Kelas latihan berhasil dihapus!'); window.location.href='daftar_kelas_latihan.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus kelas latihan.');</script>";
    }
}

// Query untuk mengambil data kelas latihan dengan JOIN
$sql_kelas_latihan = "
    SELECT 
        kelas_latihan.id_latihan, 
        anggota.nama_anggota AS NamaAnggota, 
        instruktur.nama AS NamaInstruktur, 
        instruktur.spesialis AS SpesialisInstruktur
    FROM 
        kelas_latihan
    JOIN 
        anggota ON kelas_latihan.id_anggota = anggota.id_anggota
    JOIN 
        instruktur ON kelas_latihan.id_instruktur = instruktur.id_instruktur
";
$result_kelas_latihan = $conn->query($sql_kelas_latihan);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kelas Latihan</title>
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
        <h1>Daftar Kelas Latihan</h1>

        <!-- Tombol untuk menambah kelas latihan -->
        <a href="tambah_kelas_latihan.php" class="button">Tambah Kelas Latihan</a>

        <!-- Tabel daftar kelas latihan -->
        <table>
            <tr>
                <th>ID Latihan</th>
                <th>Nama Anggota</th>
                <th>Nama Instruktur</th>
                <th>Spesialis Instruktur</th>
                <th>Aksi</th>
            </tr>
            <?php if ($result_kelas_latihan->num_rows > 0): ?>
                <?php while($row = $result_kelas_latihan->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id_latihan']; ?></td>
                        <td><?= $row['NamaAnggota']; ?></td>
                        <td><?= $row['NamaInstruktur']; ?></td>
                        <td><?= $row['SpesialisInstruktur']; ?></td>
                        <td>
                            <a href="edit_kelas_latihan.php?id=<?= $row['id_latihan']; ?>">Edit</a> |
                            <a href="?hapus=<?= $row['id_latihan']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')" class="confirm">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Tidak ada data.</td>
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