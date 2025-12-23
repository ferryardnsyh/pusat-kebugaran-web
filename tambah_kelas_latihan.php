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

// Menambah kelas latihan
if (isset($_POST['tambah'])) {
    $id_anggota = $_POST['id_anggota'];
    $id_instruktur = $_POST['id_instruktur'];

    $sql_tambah = "INSERT INTO kelas_latihan (id_anggota, id_instruktur) VALUES ('$id_anggota', '$id_instruktur')";
    $conn->query($sql_tambah);

    // Redirect kembali ke daftar kelas latihan
    header('Location: daftar_kelas_latihan.php');
}

// Query untuk mengambil data anggota dan instruktur
$sql_anggota = "SELECT id_anggota, nama_anggota FROM anggota";
$result_anggota = $conn->query($sql_anggota);

$sql_instruktur = "SELECT id_instruktur, nama FROM instruktur";
$result_instruktur = $conn->query($sql_instruktur);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas Latihan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }

        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        form label {
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        form select,
        form button {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        form button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        form button:hover {
            background-color: #218838;
        }

        .back-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            font-size: 16px;
        }

        .back-link a {
            color: #007bff;
            text-decoration: none;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Kelas Latihan</h1>
        <form action="" method="POST">
            <label for="id_anggota">Nama Anggota:</label>
            <select name="id_anggota" required>
                <?php while($row_anggota = $result_anggota->fetch_assoc()): ?>
                    <option value="<?= $row_anggota['id_anggota']; ?>"><?= $row_anggota['nama_anggota']; ?></option>
                <?php endwhile; ?>
            </select>

            <label for="id_instruktur">Nama Instruktur:</label>
            <select name="id_instruktur" required>
                <?php while($row_instruktur = $result_instruktur->fetch_assoc()): ?>
                    <option value="<?= $row_instruktur['id_instruktur']; ?>"><?= $row_instruktur['nama']; ?></option>
                <?php endwhile; ?>
            </select>

            <button type="submit" name="tambah">Tambah Kelas Latihan</button>
        </form>
        <div class="back-link">
            <a href="daftar_kelas_latihan.php">Kembali ke Daftar Kelas Latihan</a>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>