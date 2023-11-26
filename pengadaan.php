<?php 
include 'koneksi.php';
include 'navbar.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Kebutuhan Buku - Pengadaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-bold mb-8">Pengadaan Buku</h1>

        <div class="mt-8">
            <table class="table-auto w-full border bg-white">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Judul Buku</th>
                        <th class="border px-4 py-2">Nama Penerbit</th>
                        <th class="border px-4 py-2">Sisa Stok</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $procurementQuery = "SELECT nama_buku, penerbit, stok FROM buku ORDER BY stok ASC LIMIT 10"; // Adjust the LIMIT based on your needs

                    $procurementResult = mysqli_query($koneksi, $procurementQuery);
                    foreach ($procurementResult as $procurementRow) {
                        echo '<tr>';
                        echo '<td class="border px-4 py-2">' . $procurementRow['nama_buku'] . '</td>';
                        echo '<td class="border px-4 py-2">' . $procurementRow['penerbit'] . '</td>';
                        echo '<td class="border px-4 py-2">' . $procurementRow['stok'] . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
