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
    // Redirect ke daftar anggota
    header('Location: daftar_anggota.php');
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Anggota</title>
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
            transition: border-color 0.3s;
        }

        form input:focus {
            border-color: #007bff;
            outline: none;
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

        @media (max-width: 768px) {
            h1 {
                font-size: 20px;
            }

            .container {
                padding: 15px;
            }

            form input,
            form button {
                font-size: 14px;
            }

            .back-link {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tambah Anggota</h1>
        <form action="" method="POST">
            <input type="text" name="nama_anggota" placeholder="Nama Lengkap" required>
            <input type="text" name="alamat" placeholder="Alamat" required>
            <input type="date" name="tanggal_lahir" required>
            <button type="submit" name="tambah">Tambah Anggota</button>
        </form>
        <div class="back-link">
            <a href="daftar_anggota.php">Kembali ke Daftar Anggota</a>
        </div>
    </div>
</body>
</html>