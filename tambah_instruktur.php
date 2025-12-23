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

// Menambah instruktur
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $spesialis = $_POST['spesialis'];

    $sql_tambah = "INSERT INTO instruktur (nama, spesialis) VALUES ('$nama', '$spesialis')";
    $conn->query($sql_tambah);
    // Redirect ke daftar instruktur setelah menambah data
    header('Location: daftar_instruktur.php');
    exit();
}

// Tutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Instruktur</title>
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
        <!-- Form untuk menambah instruktur -->
        <h1>Tambah Instruktur</h1>
        <form action="" method="POST">
            <input type="text" name="nama" placeholder="Nama Instruktur" required>
            <input type="text" name="spesialis" placeholder="Spesialis Instruktur" required>
            <button type="submit" name="tambah">Tambah Instruktur</button>
        </form>
        <div class="back-link">
            <a href="daftar_instruktur.php">Kembali ke Daftar Instruktur</a>
        </div>
    </div>
</body>
</html>