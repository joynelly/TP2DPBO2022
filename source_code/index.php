<?php

include("conf.php");
include("DB.php");
include("Task.php");
include("Template.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

$task_div = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

// Memanggil method getTask di kelas Task
$query = $otask->getTask();

// Proses mengisi tabel dengan data
$con = mysqli_connect("localhost","root","","db_tp4");
$data = null;
$no = 1;

while ($row = mysqli_fetch_array($query)) {
	$id = $row["id"];
	$q_data = $otask->getCard($id);
	$card = mysqli_fetch_array($q_data);
	$data .= '<div class="content">
	<a href="detail.php?key='.$row["id"].'">
		<img src="data:image/jpeg;base64,'.base64_encode($row['foto']).'"/>
		<h3>'.$row["nama"].'</h3>
		<h4>'.$card['nama_divisi'].'</h4>
		<h4>'.$card['jabatan'].'</h4>
	</a>
	</div>';
	$no++;
}

// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("templates/home.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();