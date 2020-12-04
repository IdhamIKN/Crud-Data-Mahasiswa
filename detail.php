<?php


session_start();
require_once 'function/functions.php';


$data['title'] = 'Halaman Detail Mahasiswa';
$id = trim(rtrim(mysqli_real_escape_string($conn, $_GET['id'])));
$row = query("SELECT * FROM mahasiswa WHERE id = '$id'")[0];


// memanggil file header.php
view('templates/header', $data);

?>

<div class="container mt-3 mb-3">
  <div class="row">
    <div class="col-md-8">
      
      <!-- card box -->
      <div class="card shadow rounded">
        <div class="card-header">
          <div class="float-right">
            <small class="text-black-50">detail mahasiswa</small>
          </div>
        </div>
        <div class="card-body">
          <div class="image-container mb-3">
            <img src="assets/images/<?= $row['gambar']; ?>" alt="preview image" class="img-fluid"> 
          </div>
          <h3 class="text-purple text-bold"><?= strtolower($row['nama']); ?></h3>
          <small class="text-muted d-block"> NIM : <?= strtolower($row['nrp']); ?></small>
          <small class="text-muted d-block mb-4"> jurusan : <?= strtolower($row['jurusan']); ?></small>
          <small class="text-black-50 d-block mb-3"><?= strtolower($row['email']); ?></small>
          <a href="index.php" class="btn btn-primary text-light">
            <small class="fas fa-fw fa-arrow-left mr-1"></small>
            <small>kembali</small>
          </a>
        </div>
      </div>
      
    </div>
  </div>
</div>

<?php

$data['javascript'] = 'script.js';


// memanggil file footer.php
view('templates/footer', $data);

?>