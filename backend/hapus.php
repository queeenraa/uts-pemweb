<?php

require './../config/db.php';

if(isset($_GET['id'])){
    mysqli_query($db_connect, "delete FROM products WHERE id='$_GET[id]'");
    echo "Data Sudah di hapus";
}

?>

