<?php

require './../config/db.php';

if(isset($_POST['submit'])) {
    global $db_connect;

    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $tempImage = $_FILES['image']['tmp_name'];

    $randomFilename = time().'-'.md5(rand()).'-'.$image;

    $result = mysqli_query($db_connect, "SELECT MAX(id) AS max_id FROM products");

    $uploadPath = __DIR__ . '/../upload/' . $randomFilename;
    if (move_uploaded_file($tempImage, $uploadPath)) {
        mysqli_query($db_connect, "INSERT INTO products (name,price,image)
                    VALUES ('$name','$price','upload/$randomFilename')");
        echo "berhasil upload";
    } else {
        echo "gagal upload";
    }

    
    /// $uploadPath = $_SERVER['DOCUMENT_ROOT'].'/upload/'.$randomFilename;

    

   /// if($upload) {
   ///     $upload = move_uploaded_file($tempImage,$uploadPath);
   ///     mysqli_query($db_connect,"INSERT INTO products (name,price,image)
   ///                 VALUES ('$name','$price','/upload/$randomFilename')");
   ///     echo "berhasil upload";
 ///   } else {
   ///     echo "gagal upload";
   /// }

    ///
}