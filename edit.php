<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['aksi'] == 'edit') {
        $id = $_POST['id'];
        $jenis = $_POST['jenis'];

        if ($jenis == 'buku') {
            editBuku($_POST, $id);
        } elseif ($jenis == 'penerbit') {
            editPenerbit($_POST, $id);
        }

        header("Location: admin.php");
    }
}

function editBuku($data, $id)
{
    global $koneksi;
    $kategori = mysqli_real_escape_string($koneksi, $data['kategori']);
    $nama_buku = mysqli_real_escape_string($koneksi, $data['nama_buku']);
    $harga = mysqli_real_escape_string($koneksi, $data['harga']);
    $stok = mysqli_real_escape_string($koneksi, $data['stok']);
    $penerbit = mysqli_real_escape_string($koneksi, $data['penerbit']);

    $query = "UPDATE buku SET kategori='$kategori', nama_buku='$nama_buku', harga='$harga', stok='$stok', penerbit='$penerbit' WHERE id_buku='$id'";
    mysqli_query($koneksi, $query);
}

function editPenerbit($data, $id)
{
    global $koneksi;
    $nama = mysqli_real_escape_string($koneksi, $data['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
    $kota = mysqli_real_escape_string($koneksi, $data['kota']);
    $telepon = mysqli_real_escape_string($koneksi, $data['telepon']);

    $query = "UPDATE penerbit SET nama='$nama', alamat='$alamat', kota='$kota', telepon='$telepon' WHERE id_penerbit='$id'";
    mysqli_query($koneksi, $query);
}

// Fetch data dari database sesuai ID dan jenis
$id = isset($_GET['id']) ? $_GET['id'] : null;
$jenis = isset($_GET['jenis']) ? $_GET['jenis'] : null;

if ($id !== null && $jenis !== null) {
    if ($jenis == 'buku') {
        $result = mysqli_query($koneksi, "SELECT * FROM buku WHERE id_buku='$id'");
    } elseif ($jenis == 'penerbit') {
        $result = mysqli_query($koneksi, "SELECT * FROM penerbit WHERE id_penerbit='$id'");
    }

    $data = mysqli_fetch_assoc($result);

} else {
    echo "Parameter id atau jenis tidak tersedia.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
</head>
<body class="bg-gray-800">
    <h1 class="mt-4 text-white text-3xl font-bold ml-10 w-48">Edit Data</h1>
    <?php if ($jenis == 'buku') : ?>
        <div class="flex">
            <div class="w-5/12 flex flex-start ml-6">
                <form action="edit.php" method="post" class="ml-5 mt-5">
                    
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <input type="hidden" name="jenis" value="buku">
                    
                    <label for="kategori" class="block text-sm font-medium text-white">Kategori:</label>
                    <input type="text" name="kategori" value="<?= $data['kategori'] ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-96"><br>

                    <label for="nama_buku" class="block text-sm font-medium text-white">Nama Buku:</label>
                    <input type="text" name="nama_buku" value="<?= $data['nama_buku'] ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-96"><br>

                    <label for="harga" class="block text-sm font-medium text-white">Harga:</label>
                    <input type="text" name="harga" value="<?= $data['harga'] ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-96"><br>

                    <label for="stok" class="block text-sm font-medium text-white">Stok:</label>
                    <input type="text" name="stok" value="<?= $data['stok'] ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-96"><br>

                    <label for="penerbit" class="block text-sm font-medium text-white">Penerbit:</label>
                    <input type="text" name="penerbit" value="<?= $data['penerbit'] ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-96"><br>

                    <input type="hidden" name="aksi" value="edit">
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded-md cursor-pointer mt-5 hover:bg-blue-800">Simpan Perubahan</button>
                </form>
            </div>
            <div class="w-5/12 flex flex-start ml-52 h-screen items-center justify-center">
                <img src="https://images.pexels.com/photos/1907784/pexels-photo-1907784.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Beautiful Landscape" class="h-auto bg-no-repeat bg-cover w-full mt-0 mb-0">
            </div>
        </div>
    <?php elseif ($jenis == 'penerbit') : ?>
        <div class="flex">
    <div class="w-5/12 flex flex-start ml-6">
        <form action="edit.php" method="post" class="ml-5 mt-5">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="jenis" value="penerbit">

            <label for="nama" class="block text-sm font-medium text-white">Nama:</label>
            <input type="text" name="nama" value="<?= $data['nama'] ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-96"><br>

            <label for="alamat" class="block text-sm font-medium text-white">Alamat:</label>
            <input type="text" name="alamat" value="<?= $data['alamat'] ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-96"><br>

            <label for="kota" class="block text-sm font-medium text-white">Kota:</label>
            <input type="text" name="kota" value="<?= $data['kota'] ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-96"><br>

            <label for="telepon" class="block text-sm font-medium text-white">Telepon:</label>
            <input type="text" name="telepon" value="<?= $data['telepon'] ?>" required class="mt-1 p-2 border border-gray-300 rounded-md w-96"><br>

            <input type="hidden" name="aksi" value="edit">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md cursor-pointer mt-5 hover:bg-blue-800">Simpan Perubahan</button>
        </form>
    </div>

    <div class="w-5/12 flex flex-start ml-52 h-screen items-center justify-center">
        <img src="https://images.pexels.com/photos/3646172/pexels-photo-3646172.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="Beautiful Landscape" class="h-auto bg-no-repeat bg-cover w-full mt-0 mb-0">
    </div>
</div>

    <?php endif; ?>

</body>
</html>
