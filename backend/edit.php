<?php
require './../config/db.php';

// cek apakah data berhasil diubah atau tidak
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id']; // Tambahkan input field untuk ID
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $tempImage = $_FILES['image']['tmp_name'];

    $randomFilename = time() . '-' . md5(rand()) . '-' . $image;

    // Gunakan parameterized query untuk menghindari SQL injection
    $updateQuery = "UPDATE products SET name=?, price=?, image=? WHERE id=?";

    $stmt = mysqli_prepare($db_connect, $updateQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sssi', $name, $price, $image, $id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            header("Location: ./../show.php");
            exit();
        } else {
            // Tambahkan pesan kesalahan jika query gagal
            echo "Error updating record: " . mysqli_error($db_connect);
        }

        mysqli_stmt_close($stmt);
    } else {
        // Tambahkan pesan kesalahan jika prepare statement gagal
        echo "Error in preparing statement: " . mysqli_error($db_connect);
    }

} else {
    echo "Permintaan tidak valid";
}
?>