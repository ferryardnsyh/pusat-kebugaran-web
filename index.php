<?php
// Konfigurasi koneksi database
$host = "localhost"; 
$user = "root"; 
$password = ""; 
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
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Kebugaran</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="website.php">Pusat Kebugaran</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="website.php">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#kelas">Kelas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#fasilitas">Instruktur</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Daftar
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="daftar_anggota.php">Daftar Anggota</a></li>
                                <li><a class="dropdown-item" href="daftar_instruktur.php">Daftar Instruktur</a></li>
                                <li><a class="dropdown-item" href="daftar_kelas.php">Daftar Kelas</a></li>
                                <li><a class="dropdown-item" href="daftar_kelas_latihan.php">Daftar Kelas Latihan</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#kontak">Kontak</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Section -->
    <section id="home" class="hero">
        <div class="hero-content">
                <h2 style="color: #f39c12;">Selamat Datang di Pusat Kebugaran Kami!</h2>
                <p style="color: #f39c12;">Tempat terbaik untuk tubuh sehat dan bugar</p>
            <a href="#kelas" class="btn">Lihat Kelas Kami</a>
        </div>
    </section>

    <!-- Kelas Section -->
    <section id="kelas" class="kelas">
        <div class="container">
            <h2>Kelas Kami</h2>
            
            <!-- Daftar Kelas -->
            <h3>Daftar Kelas</h3>
            <table>
                <tr>
                    <th>ID KELAS</th>
                    <th>NAMA KELAS</th>
                    <th>JADWAL</th>
                    <th>AKSI</th>
                </tr>
                <?php
                // Query untuk mengambil data kelas
                $sql_kelas = "SELECT * FROM kelas";
                $result_kelas = $conn->query($sql_kelas);

                // Menampilkan data kelas jika ada
                if ($result_kelas->num_rows > 0) {
                    while ($row = $result_kelas->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id_kelas'] . "</td>";
                        echo "<td>" . $row['nama_kelas'] . "</td>";
                        echo "<td>" . $row['jadwal'] . "</td>";
                        echo "<td>
                            <a href='edit_kelas.php?id=" . $row['id_kelas'] . "'>Edit</a> | 
                            <a href='?hapus=" . $row['id_kelas'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus?\")' class='confirm'>Hapus</a>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada data kelas.</td></tr>";
                }
                ?>
            </table>
        </div>
    </section>

    <!-- Fasilitas Section -->
    <section id="fasilitas" class="fasilitas">
        <div class="container">
            <h2>Daftar Instruktur Kami</h2>
            <div class="fasilitas-list">
                <?php
                // Query untuk mengambil data instruktur
                $sql_instruktur = "SELECT * FROM instruktur";
                $result_instruktur = $conn->query($sql_instruktur);

                if ($result_instruktur->num_rows > 0) {
                    while ($row = $result_instruktur->fetch_assoc()) {
                        echo "<div class='fasilitas-item'>";
                        echo "<h3>" . $row['nama'] . "</h3>";
                        echo "<p>Spesialis: " . $row['spesialis'] . "</p>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>Belum ada instruktur yang terdaftar.</p>";
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="kontak">
        <div class="container">
            <center><h2>Kontak Kami</h2></center>
            <center><p>Untuk informasi lebih lanjut atau mendaftar kelas, hubungi kami melalui :</p></center>
                <center>Email: januar@gmail.com</center>
                <center>Telepon: (021) 123-4567</center>
                <center>Jl. Cigugur No. 10, Cimahi</center>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>Copyright 2025 Pusat Kebugaran. Semua hak cipta dilindungi.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>