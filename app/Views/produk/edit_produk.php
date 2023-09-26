<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<div class="container">
    <!-- Small boxes (Stat box) -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Produk</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="<?= site_url("produk/update_produk/" . $produk["id_produk"]); ?>" method="post" id="produk-form">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="<?= $produk["nama_produk"]; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" id="view-harga">Rp. <?= number_format($produk["harga"]); ?></div>
                                </div>
                                <input type="number" name="harga" id="harga" class="form-control" value="<?= $produk["harga"]; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="form-control">
                                <option selected disabled>-- Pilih Kategori --</option>
                                <?php foreach ($kategori as $k) : ?>
                                    <option <?= ($produk["kategori_id"] == $k["id_kategori"] ? "selected" : ""); ?> value="<?= $k["id_kategori"]; ?>"><?= $k["nama_kategori"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status_id" id="status_id" class="form-control">
                                <?php foreach ($status as $s) : ?>
                                    <option <?= ($produk["status_id"] == $s["id_status"] ? "selected" : ""); ?> value="<?= $s["id_status"]; ?>"><?= $s["nama_status"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Simpan</button>
                </div>
            </form>
        </div>
        <!-- /.card-body -->
    </div>
</div><!-- /.container-fluid -->

<?= $this->endSection(); ?>