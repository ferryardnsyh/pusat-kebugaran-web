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

// Menambah kelas
if (isset($_POST['tambah'])) {
    $nama_kelas = $_POST['nama_kelas'];
    $jadwal = $_POST['jadwal'];

    $sql_tambah = "INSERT INTO kelas (nama_kelas, jadwal) VALUES ('$nama_kelas', '$jadwal')";
    $conn->query($sql_tambah);
}

// Mengedit kelas
if (isset($_POST['edit'])) {
    $id_kelas = $_POST['id_kelas'];
    $nama_kelas = $_POST['nama_kelas'];
    $jadwal = $_POST['jadwal'];

    $sql_edit = "UPDATE kelas SET nama_kelas='$nama_kelas', jadwal='$jadwal' WHERE id_kelas=$id_kelas";
    $conn->query($sql_edit);
}

// Menghapus kelas
if (isset($_GET['hapus'])) {
    $id_kelas = $_GET['hapus'];
    $sql_hapus = "DELETE FROM kelas WHERE id_kelas=$id_kelas";
    $conn->query($sql_hapus);
}

// Query untuk mengambil data kelas
$sql_kelas = "SELECT * FROM kelas";
$result_kelas = $conn->query($sql_kelas);

// Operasi Agregasi
$sql_total_kelas = "SELECT COUNT(*) AS total_kelas FROM kelas";
$result_total_kelas = $conn->query($sql_total_kelas);
$total_kelas = $result_total_kelas->fetch_assoc()['total_kelas'];

$sql_jadwal_terdekat = "SELECT nama_kelas, jadwal FROM kelas ORDER BY jadwal ASC LIMIT 1";
$result_jadwal_terdekat = $conn->query($sql_jadwal_terdekat);
$jadwal_terdekat = $result_jadwal_terdekat->fetch_assoc();

$sql_kelas_per_hari = "
    SELECT DATE_FORMAT(jadwal, '%W') AS hari, COUNT(*) AS jumlah 
    FROM kelas 
    GROUP BY hari 
    ORDER BY jumlah DESC
";
$result_kelas_per_hari = $conn->query($sql_kelas_per_hari);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kelas</title>
</head>
<body>
    <h1>Daftar Kelas</h1>

    <!-- Form untuk menambah kelas -->
    <h2>Tambah Kelas</h2>
    <form action="" method="POST">
        <label for="nama_kelas">Nama Kelas:</label>
        <input type="text" name="nama_kelas" required>
        
        <label for="jadwal">Jadwal:</label>
        <input type="datetime-local" name="jadwal" required>
        
        <button type="submit" name="tambah">Tambah</button>
    </form>

    <h2>Daftar Kelas</h2>
    <table border="1">
        <tr>
            <th>ID Kelas</th>
            <th>Nama Kelas</th>
            <th>Jadwal</th>
            <th>Aksi</th>
        </tr>
        <?php if ($result_kelas->num_rows > 0): ?>
            <?php while ($row = $result_kelas->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id_kelas']; ?></td>
                    <td><?= $row['nama_kelas']; ?></td>
                    <td><?= $row['jadwal']; ?></td>
                    <td>
                        <a href="edit_kelas.php?id=<?= $row['id_kelas']; ?>">Edit</a> |
                        <a href="?hapus=<?= $row['id_kelas']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4">Tidak ada data.</td></tr>
        <?php endif; ?>
    </table>

    <h2>Statistik Kelas</h2>
    <ul>
        <li>Total Kelas: <?= $total_kelas; ?></li>
        <li>Kelas dengan Jadwal Terdekat: 
            <?= isset($jadwal_terdekat['nama_kelas']) ? $jadwal_terdekat['nama_kelas'] . " (" . $jadwal_terdekat['jadwal'] . ")" : "Tidak ada data"; ?>
        </li>
    </ul>

    <h3>Jumlah Kelas Berdasarkan Hari</h3>
    <table border="1">
        <tr>
            <th>Hari</th>
            <th>Jumlah Kelas</th>
        </tr>
        <?php
        // Daftar nama hari dalam bahasa Inggris dan Indonesia
        $hari_indo = [
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
            'Sunday' => 'Minggu'
        ];
        ?>
        <?php if ($result_kelas_per_hari->num_rows > 0): ?>
            <?php while ($row = $result_kelas_per_hari->fetch_assoc()): ?>
                <tr>
                    <td><?= $hari_indo[$row['hari']]; ?></td>
                    <td><?= $row['jumlah']; ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="2">Tidak ada data.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
