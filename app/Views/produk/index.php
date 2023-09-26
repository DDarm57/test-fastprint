<?= $this->extend("layout/template"); ?>

<?= $this->section("content"); ?>
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3><?= $jml_data["jml_produk"]; ?></h3>
                    <p>Data Produk</p>
                </div>
                <div class="icon">
                    <i class="fas fa-sticky-note"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><?= $jml_data["jml_kategori"]; ?></h3>
                    <p>Kategori Produk</p>
                </div>
                <div class="icon">
                    <i class="fas fa-list"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3><?= $jml_data["jml_bisaDijual"]; ?></h3>
                    <p>Bisa Dijual</p>
                </div>
                <div class="icon">
                    <i class="far fa-check-circle"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><?= $jml_data["jml_tidakBisaDijual"]; ?></h3>
                    <p>Tidak Bisa Dijual</p>
                </div>
                <div class="icon">
                    <i class="far fa-times-circle"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
</div><!-- /.container-fluid -->
<?= $this->endSection(); ?>