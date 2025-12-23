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

// Ambil data kelas berdasarkan id
if (isset($_GET['id'])) {
    $id_kelas = $_GET['id'];
    $sql = "SELECT * FROM kelas WHERE id_kelas = $id_kelas";
    $result = $conn->query($sql);
    $kelas = $result->fetch_assoc();
}

// Mengupdate kelas
if (isset($_POST['edit'])) {
    $id_kelas = $_POST['id_kelas'];
    $nama_kelas = $_POST['nama_kelas'];
    $jadwal = $_POST['jadwal'];

    $sql_edit = "UPDATE kelas SET nama_kelas='$nama_kelas', jadwal='$jadwal' WHERE id_kelas=$id_kelas";
    $conn->query($sql_edit);

    // Redirect kembali ke halaman kelas
    header('Location: daftar_kelas.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas</title>
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
        <h1>Edit Kelas</h1>
        <form action="" method="POST">
            <input type="hidden" name="id_kelas" value="<?= $kelas['id_kelas']; ?>">

            <label for="nama_kelas">Nama Kelas:</label>
            <input type="text" name="nama_kelas" id="nama_kelas" value="<?= $kelas['nama_kelas']; ?>" required>

            <label for="jadwal">Jadwal:</label>
            <input type="datetime-local" name="jadwal" id="jadwal" value="<?= date('Y-m-d\TH:i', strtotime($kelas['jadwal'])); ?>" required>

            <button type="submit" name="edit">Simpan Perubahan</button>
        </form>
        <div class="back-link">
            <a href="daftar_kelas.php">Kembali ke Daftar Kelas</a>
        </div>
    </div>
</body>
</html>