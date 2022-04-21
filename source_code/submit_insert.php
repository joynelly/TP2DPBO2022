<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selesai Input</title>
</head>
<body>
  <?php 

    include("conf.php");
    include("DB.php");
    include("Task.php");
    include("Template.php");

    //display all varibel
    print_r($_POST);

    //cek submit
    if (!$_SERVER["REQUEST_METHOD"] == "POST") {
      header("location: index.php");
      exit();
    } elseif (isset($_POST['cancel'])){
      header("location: index.php");
      exit();
    }

    $otask = new Task($db_host, $db_user, $db_password, $db_name);
    $otask->open();

    $otask->insertData($_POST, $_FILES);

    echo "Sukses ... <br>" ;

    echo "<a href='index.php'> Kembali ke beranda </a>";

  ?>
</body>
</html>
