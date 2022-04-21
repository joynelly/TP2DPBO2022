<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            position: relative;
            margin: 0;
            padding-bottom: 80px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            padding: 0 10px;
        }

        .clearfix {
            clear: both;
        }

        /* Header Style */
        .header {
            width: 100%;
            background-color: #1A132F;
            padding: 5px;
        }

        /* Navigation Bar */
        .navbar {
            align-items: center;
            color: #fff;
        }

        .navbar ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .navbar li {
            font-weight: bold;
            cursor: pointer;
            padding: 20px 10px;
            display: inline-block; /* navbar menjadi horizontal */
            vertical-align: middle;
        }

        /* Menu navbar berganti warna background ketika di hover */
        .navbar-menu li:hover {
            color: #005db4;
        }

        .navbar ul.navbar-menu {
            margin: 0;
            padding: 0;
        }

        .profile-grid{
            padding: 50px;

            display: grid;
            /* //grid-template-rows: repeat(4, auto); */
            grid-template-columns: repeat(auto-fit, 250px);
            /* grid-template-columns: minmax(200px, auto); */
            grid-template-rows: repeat(3, minmax(300px, auto));
            gap: 15px;
        }

        /* Main Style */
        main {
            background-color: #61A4BC;
        }

        /* Content Style */
        .content {
            padding: 10px;
            border: 2px solid #EFFFFD;
            border-radius: 5px;
            margin: 80px;
            background-color: #61A4BC;
        }

        a {
            text-decoration: none;
        }

        .content h3{
            margin: 0 0 10px 0;
            text-align: center;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            font-size: 20px;
            color: black;
        }

        .content h4 {
            margin: 0 0 5px 0;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 13px;
            color: #154360;
        }

        .content h2 {
            margin: 0 0 5px 0;
            text-align: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
            font-size: 40px;
            color: #154360;
        }

        .content img {
            border-radius: 50%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 15px;
            width: 20%;
        }

        .content table {
            margin: 0 auto;
        }

        .content th, td {
            padding: 5px;
        }

        .content th{
            text-align: left;
            padding-right: 10px;
        }

        /* Footer Style */
        .footer {
            background-color: #2C3E50;
            position: absolute;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 20px;
        }

        .footer span {
            color: white;
        }
    </style>
    <title>TP4 DPBO | Nelly Joy</title>
</head>
<body>
    <header class="header">
        <div class="container navbar">
          <ul class="navbar-menu">
            <li onclick="window.location.href='index.php'">
                <img src="https://www.upi.edu/images/upi-logo-2.png" class="img-fluid" width="200" alt="logo_upi">
            </li>
            <li onclick="window.location.href='index.php'">Home</li>
            <li onclick="window.location.href='insert.php'">Tambah Pengurus</li>
          </ul>
        </div>
    </header>

    <?php
        include("conf.php");
        include("DB.php");
        include("Task.php");
        include("Template.php");

        // Cek jika key kosong
        if (!isset($_GET['key'])) {
            header("location:index.php");
            exit();
        }

        //ambil key
        $key = $_GET['key'];

        // Membuat objek dari kelas task
        $otask = new Task($db_host, $db_user, $db_password, $db_name);
        $otask->open(); 

        // Memanggil method getTask di kelas Task
        $query = $otask->getDetail($key);
        $data = mysqli_fetch_array($query);

        // Cek divisi dan Jabatan
        $q_card = $otask->getCard($data["id"]);
	    $card = mysqli_fetch_array($q_card);
    ?>

    <main class="content">
        <div class="detail">
        <h2>Profile</h2>
        <?php
        echo '<img src="data:image/jpeg;base64,'.base64_encode($data['foto']).'"/>
        <table>
            <tr>
            <th>NIM</th>
            <td>'.$data["nim"].'</td>
            </tr>
            <tr>
            <th>Nama</th>
            <td>'.$data["nama"].'</td>
            </tr>
            <tr>
            <th>Semester</th>
            <td>'.$data["semester"].'</td>
            </tr>
            <tr>
            <th>Divisi</th>
            <td>'.$card["nama_divisi"].'</td>
            </tr>
            <tr>
            <th>Bidang</th>
            <td>'.$card["jabatan"].'</td>
            </tr>
            </tr>
            <tr>
            <th><button class="btn btn-danger"><a href="delete.php?key='.$data["id"].'" style="color: white; font-weight: bold;">Delete</a></button></th>
            <td><button class="btn btn-success"><a href="update.php?key='.$data["id"].'" style="color: white; font-weight: bold;">Update</a></button></td>
            </tr>
        </table>';
        ?>
        </div>
    </main>
      
    <div class="clearfix"></div>
    
    <footer class="footer">
    <div class="container">
        <span>&copy;2022 | 2000199 | Nelly Joy Christi Simanjuntak</span>
    </div>
    </footer>
</body>
</html>