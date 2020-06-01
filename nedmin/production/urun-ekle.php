<?php include 'header.php';

$urunsor = $db->prepare("SELECT * FROM urun WHERE urun_id=:id");
$urunsor->execute(array(
    'id' => $_GET['urun_id']
));
$uruncek = $urunsor->fetch(PDO::FETCH_ASSOC);
?>

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>urun Ekle<small>

                                    <?php if ($_GET['durum'] == "ok") { ?>
                                        <b style="color: limegreen;">Islem basarili.</b>
                                    <?php } else if ($_GET['durum'] == "no") { ?>
                                        <b style="color: red;">Islem Basarisiz.</b>
                                    <?php } ?>
                                </small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br/>
                            <form action="../netting/islem.php" method="post" id="demo-form2" data-parsley-validate
                                  class="form-horizontal form-label-left">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kategori
                                        Seç<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-6">

                                        <?php

                                        $urun_id = $uruncek['kategori_id'];

                                        $kategorisor = $db->prepare("select * from kategori where kategori_ust=:kategori_ust order by kategori_sira");
                                        $kategorisor->execute(array(
                                            'kategori_ust' => 0
                                        ));

                                        ?>
                                        <select class="select2_multiple form-control" required="" name="kategori_id">


                                            <?php

                                            while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {

                                                $kategori_id = $kategoricek['kategori_id'];

                                                ?>

                                                <option value="<?php echo $kategoricek['kategori_id']; ?>"><?php echo $kategoricek['kategori_ad']; ?></option>

                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">urun ad
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="urun_ad" id="first-name"
                                               placeholder="Urun Ad.." required="required"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                        urun Detay
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea class="ckeditor" id="editor1"
                                                  name="urun_detay"></textarea>
                                    </div>
                                </div>
                                <script type="text/javascript">
                                    CKEDITOR.replace('editor1',
                                        {
                                            filebrowserBrowseUrl: 'ckfinder/ckfinder.html',
                                            filebrowserImageBrowseUrl: 'ckfinder/ckfinder.html?type=Images',
                                            filebrowserFlashBrowseUrl: 'ckfinder/ckfinder.html?type=Flash',
                                            filebrowserUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                            filebrowserImageUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                                            filebrowserFlashUploadUrl: 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
                                            forcePasteAsPlainText: true
                                        }
                                    );
                                </script>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">urun fiyat
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="urun_fiyat" id="first-name"
                                               placeholder="Fiyat Giriniz..."
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">urun video
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="urun_video" id="first-name"
                                               placeholder="video codu"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">urun
                                        keyword
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="urun_keyword" id="first-name"
                                               placeholder="keyword"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">urun stok
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="urun_stok" id="first-name"
                                               placeholder="stok"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">urun
                                        durum
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="heard" class="form-control" name="urun_durum">
                                            <option value="1">
                                                Aktiv
                                            </option>
                                            <option value="0">
                                                Passiv
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" name="urunEkle" class="btn btn-success">Kaydet
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    <!-- footer content -->
<?php include 'footer.php' ?>