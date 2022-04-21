<?php 

class Task extends DB{
	
	// Mengambil data
	function getTask(){
		// Query mysql select data ke tb_pengurus
		$query = "SELECT * FROM tb_pengurus";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function getCard($key){
		// Query mysql select data ke tb_bidang
		$query = "SELECT * FROM tb_pengurus JOIN tb_bidang ON tb_pengurus.id_bidang=tb_bidang.id_bidang JOIN tb_divisi ON tb_pengurus.id_divisi=tb_divisi.id_divisi WHERE id='$key'";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function getDetail($id){
		// Query mysql select data ke tb_pengurus
		$query = "SELECT * FROM tb_pengurus where id='$id'";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function getOptJabatan(){
		// Query mysql select data ke tb_pengurus
		$query = "SELECT * FROM tb_bidang";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function getOptDivisi(){
		// Query mysql select data ke tb_pengurus
		$query = "SELECT * FROM tb_divisi";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function insertData($data, $file_f){

		$nim = $data["nim"];
		$nama = $data["nama"];
		$semester = $data["semester"];
		$divisi = $data["divisi"];
		$jabatan = $data["jabatan"];

		// Get file info 
        $fileName = basename($file_f["foto"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $foto = $file_f['foto']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($foto)); 
		}

		$query = "INSERT INTO tb_pengurus VALUES('', '$nim', '$nama', '$semester', '$jabatan', '$divisi', '$imgContent')";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function updateData($data, $file_f){
		$id = $data["key"];
		$nim = $data["nim"];
		$nama = $data["nama"];
		$semester = $data["semester"];
		$divisi = $data["divisi"];
		$jabatan =  $data["jabatan"];

		$fileName = basename($file_f["foto"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $foto = $file_f['foto']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($foto)); 
		}

		$query = "UPDATE tb_pengurus SET 
					nim = '$nim',
					nama = '$nama',
					semester = '$semester',
					id_bidang = '$jabatan',
					id_divisi = '$divisi',
					foto = $imgContent
				WHERE id = '$id'";

		// Mengeksekusi query
		return $this->execute($query);
	}

	function deleteData($id){

		$query = "DELETE FROM tb_pengurus WHERE id='$id'";

		// Mengeksekusi query
		return $this->execute($query);
	}
	
}

?>