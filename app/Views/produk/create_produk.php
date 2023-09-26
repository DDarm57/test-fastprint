<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="mb-2">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-fire"></i> Tambah Otomatis Dari API
        </button>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Produk</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="<?= site_url("produk/save_produk"); ?>" method="post" id="produk-form">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nama_produk">Nama Produk</label>
                            <input type="text" name="nama_produk" id="nama_produk" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text" id="view-harga">Rp. </div>
                                </div>
                                <input type="number" name="harga" id="harga" class="form-control" min="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="form-control">
                                <option selected disabled>-- Pilih Kategori --</option>
                                <?php
                                foreach ($kategori as $k) : ?>
                                    <option value="<?= $k["id_kategori"]; ?>"><?= $k["nama_kategori"]; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status_id" id="status_id" class="form-control">
                                <?php foreach ($status as $s) : ?>
                                    <option value="<?= $s["id_status"]; ?>"><?= $s["nama_status"]; ?></option>
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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Api Data Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="callout callout-info">
                    <h6><i class="fas fa-info"></i> Note:</h6>
                    <div class="d-flex justify-content-start py-0">
                        <p class="p-1 rounded" style="background-color:#F9937E ;">Tidak Bisa Dijual</p>
                        <div class="px-1">
                            <p class="p-1 rounded" style="background-color:#FCF89C ;">Sudah Ditambahkan</p>
                        </div>
                    </div>
                </div>
                <div id="table-produk">
                    <table id="example2" class="table table-bordered table-hover table-responsive">
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
                                <?php
                                $db = db_connect();
                                $cek_produk = $db->table('produk')->where("nama_produk", $p->nama_produk)->get()->getRowArray();
                                if ($p->status == "tidak bisa dijual") {
                                    $bg = 'style="background-color:#F9937E ;"';
                                } elseif ($cek_produk) {
                                    $bg = 'style="background-color:#FCF89C ;"';
                                } else {
                                    $bg = "";
                                }
                                ?>
                                <tr <?= $bg; ?>>
                                    <td><?= $no++; ?></td>
                                    <td><?= $p->nama_produk; ?></td>
                                    <td style="white-space: nowrap;">Rp. <?= number_format($p->harga); ?></td>
                                    <td><?= $p->kategori; ?></td>
                                    <td><?= $p->status; ?></td>
                                    <td>
                                        <?php if ($p->status != "bisa dijual") : ?>
                                            <button type="button" class="btn btn-sm btn-success" disabled><i class="fas fa-share"></i> Tambah</button>
                                        <?php else : ?>
                                            <a href="" class="btn btn-sm btn-success insert-produk" data-nama_produk="<?= $p->nama_produk; ?>" data-harga="<?= $p->harga; ?>" data-kategori="<?= $p->kategori; ?>" data-status="<?= $p->status; ?>"><i class="fas fa-share"></i> Tambah</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div id="form-produk">
                    <form action="<?= site_url("produk/save_produk"); ?>" method="post">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama_produk">Nama Produk</label>
                                    <input type="text" name="nama_produk" id="nama_produk" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <input type="number" name="harga" id="harga" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="kategori_id">Kategori</label>
                                    <input type="text" name="kategori" id="kategori_id" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status_id" id="status_id" class="form-control">
                                        <?php foreach ($status as $s) : ?>
                                            <option value="<?= $s["id_status"]; ?>" <?= ($s["nama_status"] != "bisa dijual" ? "disabled" : ""); ?>><?= $s["nama_status"]; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-paper-plane"></i> Simpan</button>
                            <button type="button" class="btn btn-sm btn-danger" id="cancel-input"><i class="fas fa-times"></i> Batal</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>