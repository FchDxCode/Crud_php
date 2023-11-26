<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Toko Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
</head>

<body class="bg-gray-100">
    <?php include 'navbar.php'; ?>

    <div class="container mx-auto p-8">
        <h1 class="text-4xl font-bold mb-8">Cari data buku atau penerbit masukkan ID anda!</h1>
        <div class="mb-4 flex space-x-4">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input class="flex-1 appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="search_id" type="text" placeholder="ID Buku atau Penerbit">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit" name="searchButton">Cari</button>
            </form>
        </div>

        <div class="mt-4">
            <h2 class="text-2xl font-bold mb-4">Data Buku</h2>
            <table class="table-auto w-full border bg-white">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">ID Buku</th>
                        <th class="border px-4 py-2">Kategori</th>
                        <th class="border px-4 py-2">Nama Buku</th>
                        <th class="border px-4 py-2">Harga</th>
                        <th class="border px-4 py-2">Stok</th>
                        <th class="border px-4 py-2">Penerbit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'koneksi.php';
                    
                    // Handle search
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["searchButton"])) {
                        $searchTerm = mysqli_real_escape_string($koneksi, $_POST["search_id"]);
                        $query = "SELECT * FROM buku WHERE id_buku LIKE '%$searchTerm%' OR kategori LIKE '%$searchTerm%' OR nama_buku LIKE '%$searchTerm%' OR harga LIKE '%$searchTerm%' OR stok LIKE '%$searchTerm%' OR penerbit LIKE '%$searchTerm%'";
                    } else {
                        $query = "SELECT * FROM buku";
                    }

                    $buku = mysqli_query($koneksi, $query);

                    foreach ($buku as $row) {
                        echo "<tr>
                            <td class='border px-4 py-2'>" . $row['id_buku'] . "</td>
                            <td class='border px-4 py-2'>" . $row['kategori'] . "</td>
                            <td class='border px-4 py-2'>" . $row['nama_buku'] . "</td>
                            <td class='border px-4 py-2'>" . $row['harga'] . "</td>
                            <td class='border px-4 py-2'>" . $row['stok'] . "</td>
                            <td class='border px-4 py-2'>" . $row['penerbit'] . "</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-4">Data Penerbit</h2>
            <table class="table-auto w-full border bg-white">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">ID Penerbit</th>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">Alamat</th>
                        <th class="border px-4 py-2">Kota</th>
                        <th class="border px-4 py-2">Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Handle search
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["searchButton"])) {
                        $searchTerm = mysqli_real_escape_string($koneksi, $_POST["search_id"]);
                        $query = "SELECT * FROM penerbit WHERE id_penerbit LIKE '%$searchTerm%' OR nama LIKE '%$searchTerm%' OR alamat LIKE '%$searchTerm%' OR kota LIKE '%$searchTerm%' OR telepon LIKE '%$searchTerm%'";
                    } else {
                        $query = "SELECT * FROM penerbit";
                    }

                    $penerbit = mysqli_query($koneksi, $query);

                    foreach ($penerbit as $row) {
                        echo "<tr>
                            <td class='border px-4 py-2'>" . $row['id_penerbit'] . "</td>
                            <td class='border px-4 py-2'>" . $row['nama'] . "</td>
                            <td class='border px-4 py-2'>" . $row['alamat'] . "</td>
                            <td class='border px-4 py-2'>" . $row['kota'] . "</td>
                            <td class='border px-4 py-2'>" . $row['telepon'] . "</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
