<?php


session_start();
require_once 'function/functions.php';


$id = trim(rtrim(mysqli_real_escape_string($conn, $_GET['id'])));


/*
    | kegunaan fungsi delete()
    | fungsi dari delete() berguna untuk menghapus data sesuai id pengguna
    | jika fungsi delete() menghasilkan nilai anhka lebih besar dari 0, maka data berhasil dihapus dari database
    | jika fungsi delete() menghasilkan nilai angka 0, maka data gagal dihapus dari database
*/


if (delete($id) > 0) {
  
  
  // jika data berhasil dihapus dari database
  set_flashdata('berhasil', 'dihapus', 'success');
  
  header('Location: index.php');
  exit();
} else {
  
  
  // jika data gagal dihapus dari database
  set_flashdata('gagal', 'dihapus', 'danger');
  
  header('Location: index.php');
  exit();
}