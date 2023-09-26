<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="mb-2">
        <div class="d-flex justify-content-start">
            <a href="<?= base_url("produk/create_produk"); ?>" class="btn btn-sm btn-primary"><i class="fas fa-plus"></i> Tambah Data</a>
            <div class="px-2">
                <form action="">
                    <div class="input-group">
                        <div class="input-group-append">
                            <a href="<?= site_url("produk/data_produk"); ?>" class="btn btn-sm btn-primary"><i class="fas fa-sync"></i></a>
                        </div>
                        <select name="search" id="" class="form-control form-control-sm">
                            <option selected disabled>-- Pilih Status --</option>
                            <?php foreach ($status as $st) : ?>
                                <?php
                                if (isset($_GET["search"])) {
                                    $status_id = $_GET["search"];
                                    if ($status_id == $st["id_status"]) {
                                        $event = "selected";
                                    } else {
                                        $event = "";
                                    }
                                } else {
                                    $event = "";
                                }
                                ?>
                                <option <?= $event; ?> value="<?= $st["id_status"]; ?>"><?= $st["nama_status"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($produk as $p) :
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $p["nama_produk"]; ?></td>
                            <td style="white-space: nowrap;">Rp. <?= number_format($p["harga"]); ?></td>
                            <td><?= $p["nama_kategori"]; ?></td>
                            <td>
                                <p style="text-transform: capitalize; white-space:nowrap;" class="<?= ($p["nama_status"] == "bisa dijual" ? "bg-success" : "bg-danger"); ?> p-1 rounded text-center"><?= $p["nama_status"]; ?></p>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?= site_url("produk/edit_produk/" . $p["id_produk"]); ?>" class="btn btn-sm btn-warning"><i class="fas fa-pen"></i></a>
                                    <a href="<?= site_url("produk/delete_produk/" . $p["id_produk"]); ?>" class="btn btn-sm btn-danger hapus"><i class="fas fa-trash"></i></a>
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
<?= $this->endSection(); ?>