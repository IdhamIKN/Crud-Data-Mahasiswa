<?php


session_start();
require_once 'function/functions.php';

$data['title'] = 'Halaman ubah data Mahasiswa';
$data['jurusan'] = list_jurusan();

$id = trim(rtrim(mysqli_real_escape_string($conn, $_GET['id'])));
$row = query("SELECT * FROM mahasiswa WHERE id = '$id'")[0];


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
      | kegunaan fungsi edit() adalah untuk mengubah data ke database
      | dimana jika fungsi dari edit() mengembalikan nilai angka yang lebih bwsar dari 0, tandanya data berhasil diubah ke database
      | jika fungsi insert() mengembalikan nilai 0, tandanya data gagal diubah ke database
  */
  
  
  if (edit($id, $nama, $nrp, $email, $jurusan, $row['nrp'], $row['email'], $row['gambar']) > 0) {
    
    
    // jika data baru berhasil diubah
    set_flashdata('berhasil', 'diubah', 'success');
    
    header('Location: index.php');
    exit();
  } else {
    
    
    // jika data baru gagal diubah
    set_flashdata('gagal', 'diubah', 'danger');
    
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
            <small class="text-black-50">form ubah data</small>
          </div>
        </div>
        <div class="card-body">
          <div class="flash-container">
            <!-- tempat pemberitahuan -->
            <?= userdata(); ?>
          </div>
          <div class="image-container mb-3">
            <img src="assets/images/<?= $row['gambar']; ?>" alt="image preview" class="img-fluid">
          </div>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="nama"><small class="text-black-50">Nama Lengkap</small></label>
              <input type="text" name="nama" class="form-control" id="nama" placeholder="nama" autocomplete="off" value="<?= $row['nama']; ?>">
            </div>
            <div class="form-group">
              <label for="nrp"><small class="text-black-50">NIM</small></label>
              <input type="text" name="nrp" class="form-control" id="nrp" placeholder="nrp" autocomplete="off" value="<?= $row['nrp']; ?>">
            </div>
            <div class="form-group">
              <label for="email"><small class="text-black-50">Alamat Email</small></label>
              <input type="text" name="email" class="form-control" id="email" placeholder="example@example.com" autocomplete="off" value="<?= $row['email']; ?>">
            </div>
            <div class="form-group">
              <label for="jurusan"><small class="text-black-50">Jurusan</small></label>
              <select name="jurusan" id="jurusan" class="form-control">
                <?php foreach ($data['jurusan'] as $jurusan) : ?>
                <?php if ($jurusan === $row['jurusan']) : ?>
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
              <small class="fas fa-fw fa-edit mr-1"></small>
              <small>ubah data</small>
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