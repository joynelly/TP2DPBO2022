<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/mycss.css">    
    <title>Contact</title>
</head>
<body>    
    <?php 

        include("conf.php");
        include("DB.php");
        include("Task.php");
        include("Template.php");

        //cek key, jika kosong kembali ke index
        if (!isset($_GET['key'])) {
            header("location:index.php");
            exit();
        }

        //ambil key
        $key = $_GET['key'];

        $otask = new Task($db_host, $db_user, $db_password, $db_name);
        $otask->open();

        $otask->deleteData($key);

        echo "Record telah dihapus!<br>";
        echo "<a href='index.php'>Kembali ke beranda</a>";
        header("location:index.php");
        //awal loop
    ?>
</body>
</html>
