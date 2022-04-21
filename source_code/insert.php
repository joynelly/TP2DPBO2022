<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            position: relative;
            margin: 0;
            padding-bottom: 0;
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
            padding: 50px 80px 80px 80px;
        }

        /* Content Style */
        .content {
            padding: 30px;
            border: 2px solid #1c1447;
            border-radius: 5px;
            margin: 10px;
            background-color: #fff;
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

        .content img {
            border-radius: 50%;
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 15px;
            width: 80%;
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
        // Membuat objek dari kelas task
        $otask = new Task($db_host, $db_user, $db_password, $db_name);
        $otask->open();

        // Cek divisi dan Jabatan
        $q_bid = $otask->getOptJabatan();
	    $q_div = $otask->getOptDivisi();
    ?>

    <main>
        <div class="content">
        <form action="submit_insert.php" method="post" enctype="multipart/form-data">
            <h1>Tambah Pengurus</h1>
            <p>NIM <br><input type="text" name="nim"></p>
            <p>Nama <br><input type="text" name="nama"></p>
            <p>Semester <br><input type="number" name="semester" step="any"></p>
            <p>Divisi <br>
                <select name="divisi">
                <option value=''>None</option>
                <?php
                    while ($div = mysqli_fetch_array($q_div)) {
                        $div_id = $div["id_divisi"];
                        $div_nama = $div["nama_divisi"];
                        echo "<option value='$div_id'>$div_nama</option>";
                    }
                ?>
                </select>
            </p>
            <p>Jabatan <br>
                <select name="jabatan">
                <?php
                    while ($bid = mysqli_fetch_array($q_bid)) {
                        $bid_id = $bid["id_bidang"];
                        $bid_nama = $bid["jabatan"];
                        echo "<option value='$bid_id'>$bid_nama</option>";
                    }
                ?>
                </select>
            </p>
            <p>Foto <br>
                <input type="file" name="foto">
            </p>
            <p><input type="submit" name="save" value="Save">
            <input type="submit" name="cancel" value="Cancel"></p>
        </form>
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