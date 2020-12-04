<?php


session_start();
require_once 'function/functions.php';


$data['title'] = 'Halaman Utama Data Mahasiswa';
$rows = query("SELECT * FROM mahasiswa ORDER BY id DESC");


// memanggil file header.php
view('templates/header', $data);

?>

<div class="container mt-3 mb-3">
  <div class="row">
    <div class="col-md-8">

      <div class="flash-container">
        <!-- tempat pemberitahuan -->
        <?= flashdata(); ?>
      </div>


      <!-- tombol tambah data -->
      <a href="insert.php" class="btn btn-primary text-light mb-3">
        <small class="fas fa-fw fa-plus mr-1"></small>
        <small>tambah data</small>
      </a>

    </div>
  </div>
  <div class="row">
    <div class="col">


      <!-- table -->
      <div class="table-responsive">
        <table class="table table-striped table-bordered" id="myTable">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>NIM</th>
              <th>Email</th>
              <th>Jurusan</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; ?>
            <?php foreach ($rows as $row) : ?>
            <tr>
              <td><small class="text-black-50"><?= $no++; ?></small></td>
              <td><small class="text-black-50"><?= strtolower($row['nama']); ?></small></td>
              <td><small class="text-black-50"><?= strtolower($row['nrp']); ?></small></td>
              <td><small class="text-black-50"><?= strtolower($row['email']); ?></small></td>
              <td><small class="text-black-50"><?= strtolower($row['jurusan']); ?></small></td>
              <td>
                <div class="d-flex justify-content-center">
                  <a href="detail.php?id=<?= $row['id']; ?>" class="badge badge-primary p-2 text-light mr-1">
                    <small class="fas fa-fw fa-eye mr-1"></small>
                    <small>detail</small>
                  </a>
                  <a href="edit.php?id=<?= $row['id']; ?>" class="badge badge-success p-2 text-light mr-1">
                    <small class="fas fa-fw fa-edit mr-1"></small>
                    <small>ubah</small>
                  </a>
                  <a href="" class="badge badge-danger p-2 text-light badge-deletes" data-target="delete.php?id=<?= $row['id']; ?>">
                    <small class="fas fa-fw fa-trash alt mr-1"></small>
                    <small>hapus</small>
                  </a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<?php


$data['javascript'] = 'script.js';


// memanggil file footer.php
view('templates/footer', $data);

?>