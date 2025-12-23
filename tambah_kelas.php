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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_kelas = $_POST['nama_kelas'];
    $jadwal = $_POST['jadwal'];

    $sql_tambah = "INSERT INTO kelas (nama_kelas, jadwal) VALUES ('$nama_kelas', '$jadwal')";
    if ($conn->query($sql_tambah)) {
        echo "<script>alert('Kelas berhasil ditambahkan!'); window.location.href='daftar_kelas.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan kelas.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas</title>
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
        <h1>Tambah Kelas</h1>
        <form action="" method="POST">
            <label for="nama_kelas">Nama Kelas:</label>
            <input type="text" name="nama_kelas" id="nama_kelas" required>

            <label for="jadwal">Jadwal:</label>
            <input type="datetime-local" name="jadwal" id="jadwal" required>

            <button type="submit">Tambah Kelas</button>
        </form>
        <div class="back-link">
            <a href="daftar_kelas.php">Kembali ke Daftar Kelas</a>
        </div>
    </div>
</body>
</html>