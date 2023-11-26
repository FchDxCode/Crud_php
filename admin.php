<?php
include 'koneksi.php';
include 'navbar.php';


// Fungsi untuk menambah buku
function tambahBuku($data)
{
    global $koneksi;
    $id_buku = mysqli_real_escape_string($koneksi, $data['id_buku']);
    $kategori = mysqli_real_escape_string($koneksi, $data['kategori']);
    $nama_buku = mysqli_real_escape_string($koneksi, $data['nama_buku']);
    $harga = mysqli_real_escape_string($koneksi, $data['harga']);
    $stok = mysqli_real_escape_string($koneksi, $data['stok']);
    $penerbit = mysqli_real_escape_string($koneksi, $data['penerbit']);

    $query = "INSERT INTO buku (id_buku, kategori, nama_buku, harga, stok, penerbit) VALUES ('$id_buku','$kategori', '$nama_buku', '$harga', '$stok', '$penerbit')";
    mysqli_query($koneksi, $query);
}

// Fungsi untuk menambah penerbit
function tambahPenerbit($data)
{
    global $koneksi;
    $id_penerbit = mysqli_real_escape_string($koneksi, $data['id_penerbit']);
    $nama = mysqli_real_escape_string($koneksi, $data['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
    $kota = mysqli_real_escape_string($koneksi, $data['kota']);
    $telepon = mysqli_real_escape_string($koneksi, $data['telepon']);

    $query = "INSERT INTO penerbit (id_penerbit,nama, alamat, kota, telepon) VALUES ('$id_penerbit','$nama', '$alamat', '$kota', '$telepon')";
    mysqli_query($koneksi, $query);
}

// Fungsi untuk menghapus buku
function hapusBuku($id)
{
    global $koneksi;
    $id_buku = mysqli_real_escape_string($koneksi, $id);

    $query = "DELETE FROM buku WHERE id_buku = '$id_buku'";
    mysqli_query($koneksi, $query);
}

// Fungsi untuk menghapus penerbit
function hapusPenerbit($id)
{
    global $koneksi;
    $id_penerbit = mysqli_real_escape_string($koneksi, $id);

    $query = "DELETE FROM penerbit WHERE id_penerbit = '$id_penerbit'";
    mysqli_query($koneksi, $query);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Cek aksi (add, edit, delete) dan jenis data (buku, penerbit)
    if ($_POST['aksi'] == 'add') {
        if ($_POST['jenis'] == 'buku') {
            tambahBuku($_POST);
        } elseif ($_POST['jenis'] == 'penerbit') {
            tambahPenerbit($_POST);
        }
    } elseif ($_POST['aksi'] == 'delete') {
        $id = $_POST['id'];
        if ($_POST['jenis'] == 'buku') {
            hapusBuku($id);
        } elseif ($_POST['jenis'] == 'penerbit') {
            hapusPenerbit($id);
        }
    }

}

// Tampilkan data buku
$buku = mysqli_query($koneksi, "SELECT * FROM buku");
$penerbit = mysqli_query($koneksi, "SELECT * FROM penerbit");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto p-4">

        <h2 class="text-3xl font-bold mb-4">Data Buku</h2>
        <table class="w-full mb-8 border">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID Buku</th>
                    <th class="border px-4 py-2">Kategori</th>
                    <th class="border px-4 py-2">Nama Buku</th>
                    <th class="border px-4 py-2">Harga</th>
                    <th class="border px-4 py-2">Stok</th>
                    <th class="border px-4 py-2">Penerbit</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($buku as $row) : ?>
                    <tr>
                        <td class="border px-4 py-2"><?= $row['id_buku'] ?></td>
                        <td class="border px-4 py-2"><?= $row['kategori'] ?></td>
                        <td class="border px-4 py-2"><?= $row['nama_buku'] ?></td>
                        <td class="border px-4 py-2"><?= $row['harga'] ?></td>
                        <td class="border px-4 py-2"><?= $row['stok'] ?></td>
                        <td class="border px-4 py-2"><?= $row['penerbit'] ?></td>
                        <td class="border px-4 py-2">
                            <a href='edit.php?id=<?= $row['id_buku'] ?>&jenis=buku' class="text-white bg-green-300 rounded-lg px-2 py-1 hover:bg-green-500 hover:text-black">Edit</a> |
                            <form method='post' action='admin.php' class="inline">
                                <input type='hidden' name='id' value='<?= $row['id_buku'] ?>'>
                                <input type='hidden' name='aksi' value='delete'>
                                <input type='hidden' name='jenis' value='buku'>
                                <button type='submit' class="text-white bg-red-300 rounded-lg px-2 py-1 hover:bg-red-500 hover:text-black">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2 class="text-3xl font-bold mb-4">Data penerbit</h2>
        <table class="w-full mb-8 border">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID Penerbit</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Alamat</th>
                    <th class="border px-4 py-2">Kota</th>
                    <th class="border px-4 py-2">Telpon</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($penerbit as $row) : ?>
                    <tr>
                        <td class="border px-4 py-2"><?= $row['id_penerbit'] ?></td>
                        <td class="border px-4 py-2"><?= $row['nama'] ?></td>
                        <td class="border px-4 py-2"><?= $row['alamat'] ?></td>
                        <td class="border px-4 py-2"><?= $row['kota'] ?></td>
                        <td class="border px-4 py-2"><?= $row['telepon'] ?></td>
                        <td class="border px-4 py-2">
                            <a href='edit.php?id=<?= $row['id_penerbit'] ?>&jenis=penerbit' class="text-white bg-green-300 rounded-lg px-2 py-1 hover:bg-green-500 hover:text-black">Edit</a> |
                            <form method='post' action='admin.php' class="inline">
                                <input type='hidden' name='id' value='<?= $row['id_penerbit'] ?>'>
                                <input type='hidden' name='aksi' value='delete'>
                                <input type='hidden' name='jenis' value='penerbit'>
                                <button type='submit' class="text-white bg-red-300 rounded-lg px-2 py-1 hover:bg-red-500 hover:text-black">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h3 class="text-xl font-bold mb-4">Tambah Buku</h3>
        <form action="admin.php" method="post" class="mb-8">

            <!-- id buku -->
            <div class="mb-4">
                <label for="id_buku" class="block text-sm font-medium text-gray-600">ID Buku:</label>
                <input type="text" name="id_buku" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>

            <!-- Kategori -->
            <div class="mb-4">
                <label for="kategori" class="block text-sm font-medium text-gray-600">Kategori:</label>
                <input type="text" name="kategori" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>

            <!-- Nama Buku -->
            <div class="mb-4">
                <label for="nama_buku" class="block text-sm font-medium text-gray-600">Nama Buku:</label>
                <input type="text" name="nama_buku" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>

            <!-- Harga -->
            <div class="mb-4">
                <label for="harga" class="block text-sm font-medium text-gray-600">Harga:</label>
                <input type="text" name="harga" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>

            <!-- Stock -->
            <div class="mb-4">
                <label for="stok" class="block text-sm font-medium text-gray-600">Stock:</label>
                <input type="text" name="stok" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>

            <!-- Penerbit -->
            <div class="mb-4">
                <label for="penerbit" class="block text-sm font-medium text-gray-600">Penerbit:</label>
                <input type="text" name="penerbit" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>

            <!-- Hidden inputs -->
            <input type="hidden" name="aksi" value="add">
            <input type="hidden" name="jenis" value="buku">

            <!-- Submit button -->
            <input type="submit" value="Tambah Buku" class="bg-blue-500 text-white p-2 rounded-md cursor-pointer">
        </form>

        <!-- Form tambah penerbit -->
        <h3 class="text-xl font-bold mb-4">Tambah Penerbit</h3>
        <form action="admin.php" method="post">

            <!-- ID Penerbit -->
            <div class="mb-4">
                <label for="id_penerbit" class="block text-sm font-medium text-gray-600">ID Penerbit:</label>
                <input type="text" name="id_penerbit" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>

            <!-- Nama -->
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-600">Nama:</label>
                <input type="text" name="nama" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>

            <!-- Alamat -->
            <div class="mb-4">
                <label for="alamat" class="block text-sm font-medium text-gray-600">Alamat:</label>
                <input type="text" name="alamat" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>

            <!-- Kota -->
            <div class="mb-4">
                <label for="kota" class="block text-sm font-medium text-gray-600">Kota:</label>
                <input type="text" name="kota" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>

            <!-- Telepon -->
            <div class="mb-4">
                <label for="telepon" class="block text-sm font-medium text-gray-600">Telepon:</label>
                <input type="text" name="telepon" required class="mt-1 p-2 border border-gray-300 rounded-md w-full">
            </div>

            <!-- Hidden inputs -->
            <input type="hidden" name="aksi" value="add">
            <input type="hidden" name="jenis" value="penerbit">

            <!-- Submit button -->
            <input type="submit" value="Tambah Penerbit" class="bg-blue-500 text-white p-2 rounded-md cursor-pointer">
        </form>

    </div>
</body>

</html>
