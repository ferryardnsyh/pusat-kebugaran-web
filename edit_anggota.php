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

// Mengambil data anggota berdasarkan ID
if (isset($_GET['id'])) {
    $id_anggota = $_GET['id'];
    $sql = "SELECT * FROM anggota WHERE id_anggota=$id_anggota";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
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
    header("Location: daftar_anggota.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Anggota</title>
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

        form input {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        form button {
            padding: 12px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
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
        <h1>Edit Anggota</h1>
        <form action="" method="POST">
            <input type="hidden" name="id_anggota" value="<?= $row['id_anggota']; ?>">
            <input type="text" name="nama_anggota" value="<?= $row['nama_anggota']; ?>" placeholder="Nama Anggota" required>
            <input type="text" name="alamat" value="<?= $row['alamat']; ?>" placeholder="Alamat" required>
            <input type="date" name="tanggal_lahir" value="<?= $row['tanggal_lahir']; ?>" required>
            <button type="submit" name="edit">Simpan Perubahan</button>
        </form>
        <div class="back-link">
            <a href="daftar_anggota.php">Kembali ke Daftar Anggota</a>
        </div>
    </div>
    <?php
    // Tutup koneksi
    $conn->close();
    ?>
</body>
</html>