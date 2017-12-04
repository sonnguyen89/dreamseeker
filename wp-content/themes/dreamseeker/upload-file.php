<?php
$uploaddir = './claime_uploads/'; 
$file = $uploaddir .time(). basename($_FILES['uploadfile']['name']); 
$file_nm = time(). basename($_FILES['uploadfile']['name']); 
if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) { 
  echo "success//==//$file_nm"; 
} else {
	echo "error";
}
?>