<?php

include 'koneksi.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simpan info admin 
    $user_credentials = [
        'admin' => ['password' => 'adminpass', 'username' => 'admin', 'redirect' => 'admin.php']
    ];

    //logika periksa username 
    if (isset($user_credentials[$username]) && $password == $user_credentials[$username]['password']) {
        $_SESSION['role'] = $username;
        header("Location: " . $user_credentials[$username]['redirect']);
        exit();
    } else {
        //query mengambil username
        $sql = "SELECT * FROM registrasi WHERE username = '$username'";
        $result = $koneksi->query($sql);

        if (!$result) {
            die("Query failed: " . $koneksi->error);
        }

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            //logika cek usernme dan password
            if ($password == $row['password']) {
                $_SESSION['role'] = $username;
                header("Location: index.php");
                exit();
            } else {
                $error_message = "Login gagal. cek username dan password.";
                displayBasicAlert($error_message);
            }
        } else {
            $error_message = "Login failed. User not found.";
            displayBasicAlert($error_message);
        }
    }
    $koneksi->close();
}

function displayBasicAlert($message) {
    echo "
        <script>
            alert('$message');
        </script>
    ";
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>

<body>
    <section class="relative flex flex-wrap lg:h-screen lg:items-center bg-gray-800">
        <div class="w-full px-4 py-12 sm:px-6 sm:py-16 lg:w-1/2 lg:px-8 lg:py-24">
            <div class="mx-auto max-w-lg text-center">
                <h1 class="text-2xl font-bold sm:text-3xl text-gray-100">Login Perpustakaan</h1>

                <p class="mt-4 text-gray-200">
                    Koleksi buku terlengkap kenapa ga di rumah buku aja? banyak varian
                    dan banyak koleksi buku yang menarik lho!
                </p>
            </div>
            <form action="" method="post" class="mx-auto mb-0 mt-8 max-w-md space-y-4">
                <div>
                    <label for="username" class="sr-only">Username</label>
                    <div class="relative">
                        <input name="username" type="text" class="w-full rounded-lg border-2 border-gray-300 focus:border-gray-500 p-4 pe-12 text-sm shadow-sm" placeholder="Enter Username" />
                    </div>
                </div>

                <div>
                    <label for="password" class="sr-only">Password</label>
                    <div class="relative">
                        <input name="password" type="password" class="w-full rounded-lg border-2 border-gray-300 focus:border-gray-500 p-4 pe-12 text-sm shadow-sm" placeholder="Enter password" />
                    </div>
                </div>

                <div class="flex flex-col items-start">
                    <button type="submit" class="inline-block rounded-lg bg-blue-300 px-10 py-3 text-sm font-medium text-white mb-5 hover:bg-blue-500">
                        Sign in
                    </button>


                    <p class="text-sm text-gray-200">
                        No account?
                        <a class="underline hover:text-blue-500" href="register.php">Sign up</a>
                    </p>
                </div>
            </form>

        </div>

        <div class="relative h-64 w-full sm:h-96 lg:h-full lg:w-1/2">
            <img alt="Welcome" src="https://source.unsplash.com/1emWndlDHs0" class="absolute inset-0 h-full w-full object-cover" />
        </div>
    </section>
</body>

</html>