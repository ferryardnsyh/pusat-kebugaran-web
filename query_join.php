<?php
// Koneksi ke database
$host = "localhost"; 
$user = "dbadmin"; 
$password = "AditFerrySani1+";  
$dbname = "db_pusatkebugaran"; 

$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query Join
$sql = "
    SELECT 
        kelas.nama_kelas AS nama_kelas, 
        instruktur.nama AS nama_instruktur
    FROM 
        kelas
    LEFT JOIN 
        instruktur 
    ON 
        kelas.id_instruktur = instruktur.id_instruktur
";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Query Join</title>
</head>
<body>
    <h1>Daftar Kelas dan Instruktur</h1>
    <table border="1">
        <tr>
            <th>Nama Kelas</th>
            <th>Nama Instruktur</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['nama_kelas'] . "</td>";
                echo "<td>" . $row['nama_instruktur'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>Tidak ada data.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
