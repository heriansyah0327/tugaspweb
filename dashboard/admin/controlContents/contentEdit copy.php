<?php 
include "function/edit.php";
session_start();
    if (!isset($_SESSION["role"])) {
        header("Location: /spiral/index.php");
        exit();
    } elseif ($_SESSION["role"] != "admin") {
        $path = $_SESSION["role"];
        header("Location: /spiral/dashboard/$path/index.php");
        exit();
    }

    $id = $_GET['id'];
    $data = tampilbyId($id)[0];
    if (isset($_POST['submit'])) {
        if (edit($_POST, $id) > 0) {
            echo "<script>
                alert('Data berhasil diupdate!');
                document.location.href = '/spiral/dashboard/admin/controlContents/index.php';
            </script>";
        } else {
            echo "<script>    
                alert('Data gagal diupdate!');
                document.location.href = '/spiral/dashboard/admin/controlContents/index.php';
            </script>";
        }
    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="POST">
        <label for="judul">Judul</label><br>
        <input type="text" name="judul" id="judul" required value="<?=$data['judul'] ?>"><br>
        <label for="content"></label><br>
        <textarea name="content" id="content" cols="30" rows="10" required ><?= $data['content']; ?></textarea><br>
        <button type="submit" name="submit">Update</button>
        <a href="/spiral/dashboard/admin/controlContents/index.php">Cancel</a>
    </form>
</body>
</html>