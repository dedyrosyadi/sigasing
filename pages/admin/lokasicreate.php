<?php include_once "partials/cssdatatables.php" ?>

<?php
if (isset($_POST['button_create'])) {
  $database = new Database();
  $db = $database->getConnection();

  $validateSql = "SELECT * FROM lokasi where nama_lokasi = ?";
  $stmt = $db->prepare($validateSql);
  $stmt->bindParam(1, $_POST['nama_lokasi']);
  $stmt->execute();
  if ($stmt->rowCount() > 0) {
    // echo "Nama lokasi sudah ada";
?>

    <div class="alert alert-danger alert-dismissible m-2" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <h5><i class="icon fas fa-ban"></i> Gagal</h5>
      Nama lokasi sudah ada
    </div>

<?php
  } else {
    $insertSQL = "INSERT INTO lokasi SET nama_lokasi = ?";
    $stmt = $db->prepare($insertSQL);
    $stmt->bindParam(1, $_POST['nama_lokasi']);

    if ($stmt->execute()) {
      $_SESSION['hasil'] = true;
      $_SESSION['pesan'] = "Berhasil simpan data";
    } else {
      $_SESSION['hasil'] = false;
      $_SESSION['pesan'] = "Gagal simpan data";
    }
    echo "<meta http-equiv='refresh' content='0;url=?page=lokasiread'>";
  }
}
?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb2">
      <div class="col-sm-6">
        <h1>Tambah Data Lokasi</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="?page=home">Home</a></li>
          <li class="breadcrumb-item"><a href="?page=lokasiread">Lokasi</a></li>
          <li class="breadcrumb-item active">Tambah Data</li>
        </ol>
      </div>
    </div>
  </div>
</section>


<section class="content">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Tambah Lokasi</h3>
    </div>
    <div class="card-body">
      <form action="" method="post">
        <div class="form-group">
          <label for="nama_lokasi">Nama Lokasi</label>
          <input type="text" name="nama_lokasi" class="form-control">
        </div>
        <a href="?page=lokasiread" class="btn btn-danger btn-sm float-right"><i class="fa fa-times"></i> Batal</a>
        <button type="submit" name="button_create" class="btn btn-success btn-sm float-right mr-1"> <i class="fa fa-save"></i> Simpan</button>
      </form>
    </div>
  </div>

</section>