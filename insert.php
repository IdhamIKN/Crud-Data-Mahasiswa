<?php


session_start();
require_once 'function/functions.php';

$data['title'] = 'Halaman tambah data Mahasiswa';
$data['jurusan'] = list_jurusan();


// memanggil file header.php
view('templates/header', $data);


if (isset($_POST['submit'])) {
  
  
  // memberikan kemanan terlebih dahulu agar tidak ada celah bagi hacker untuk meretas program ini
  $nama = trim(stripslashes(htmlspecialchars($_POST['nama'])));
  $nrp = trim(rtrim(stripslashes(htmlspecialchars($_POST['nrp']))));
  $email = trim(stripslashes(htmlspecialchars($_POST['email'])));
  $jurusan = trim(stripslashes(htmlspecialchars($_POST['jurusan'])));
  
  
  /*
      | penjelasan mengenai fungsi set_value()
      | fungsi set_value() berguna untuk mencatat semua inputan pengguna ke dalam session yang bernama value
      | fungsi ini dibuat supaya pengguna tidak perlu mengetik ulang lagi jika mengalami error saat menambahkan data baru
  */
  
  
  set_value($nama, $nrp, $email, $jurusan);
  
  
  /*
      | kegunaan fungsi insert() adalah untuk menambahkan data baru ke database
      | dimana jika dungsi dari insert() mengembalikan nilai angka yang lebih bwsar dari 0, tandanya data baru berhasil ditanbahkan ke database
      | jika fungsi insert() mengembalikan nilai 0, tandanya data baru gagal ditambahkan ke database
  */
  
  
  if (insert($nama, $nrp, $email, $jurusan) > 0) {
    
    
    // jika data baru berhasil ditambahkan
    set_flashdata('berhasil', 'ditambahkan', 'success');
    
    header('Location: index.php');
    exit();
  } else {
    
    
    // jika data baru gagal ditambahkan
    set_flashdata('gagal', 'ditambahkan', 'danger');
    
    header('Location: index.php');
    exit();
  }
}

?>

<div class="container mt-3 mb-3">
  <div class="row">
    <div class="col-md-9">


      <!-- card form box -->
      <div class="card shadow rounded">
        <div class="card-header">
          <div class="float-right">
            <small class="text-black-50">form tambah data</small>
          </div>
        </div>
        <div class="card-body">
          <div class="flash-container">
            <!-- tempat pemberitahuan -->
            <?= userdata(); ?>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="nama"><small class="text-black-50">Nama Lengkap</small></label>
              <input type="text" name="nama" class="form-control" id="nama" placeholder="nama" autocomplete="off" value="<?= $_SESSION['value']['nama'];?>">
            </div>
            <div class="form-group">
              <label for="nrp"><small class="text-black-50">NIM</small></label>
              <input type="text" name="nrp" class="form-control" id="nrp" placeholder="nrp" autocomplete="off" value="<?= $_SESSION['value']['nrp'];?>">
            </div>
            <div class="form-group">
              <label for="email"><small class="text-black-50">Alamat Email</small></label>
              <input type="text" name="email" class="form-control" id="email" placeholder="example@example.com" autocomplete="off" value="<?= $_SESSION['value']['email']; ?>">
            </div>
            <div class="form-group">
              <label for="jurusan"><small class="text-black-50">Jurusan</small></label>
              <select name="jurusan" id="jurusan" class="form-control">
                <?php foreach ($data['jurusan'] as $jurusan) : ?>
                <?php if ($jurusan === $_SESSION['value']['jurusan']) : ?>
                  <option value="<?= $jurusan; ?>" selected><?= strtolower($jurusan); ?></option>
                <?php else : ?>
                  <option value="<?= $jurusan; ?>"><?= strtolower($jurusan); ?></option>
                <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="gambar"><small class="text-blafk-50">Gambar</small></label>
              <div class="custom-file">
                <input type="file" name="gambar" class="custom-file-input" id="gambar">
                <label class="custom-file-label" for="gambar">pilih file</label>
              </div>
            </div>
            <button type="submit" name="submit" class="btn btn-primary text-light float-right">
              <small class="fas fa-fw fa-plus mr-1"></small>
              <small>tambah data</small>
            </button>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>

<?php


$data['javascript'] = 'validation.js';


// memanggil file footer.php
view('templates/footer', $data);

?>