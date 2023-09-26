<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="mb-2">
        <a href="" class="btn btn-sm btn-primary tambah-kategori" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Tambah Data</a>
        <div class="mt-2">
            <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> Success!</h5>
                    <?= session()->getFlashdata("success"); ?>
                </div>
            <?php endif ?>
            <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    <?= session()->getFlashdata("error"); ?>
                </div>
            <?php endif ?>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data Produk</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($k_produk as $p) :
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $p["nama_kategori"]; ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="" class="btn btn-sm btn-warning edit-kategori" data-toggle="modal" data-target="#exampleModal" data-id_kategori="<?= $p["id_kategori"]; ?>" data-nama_kategori="<?= $p["nama_kategori"]; ?>"><i class="fas fa-pen"></i></a>
                                    <a href="<?= site_url("kategoriProduk/delete_kategori/" . $p["id_kategori"]); ?>" class="btn btn-sm btn-danger hapus"><i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div><!-- /.container-fluid -->

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Kategori Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="kategori-form">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <select name="nama_kategori" id="nama_kategori" class="form-control">
                            <option value="selected" selected disabled>-- Pilih Kategori -</option>
                            <?php foreach ($api_kategori as $row) : ?>
                                <option value="<?= $row["nama_kategori"]; ?>"><?= $row["nama_kategori"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-paper-plane"></i> Simpan</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Kembali</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>