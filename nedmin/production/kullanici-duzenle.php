<?php include 'header.php';

$kullanicisor = $db->prepare("SELECT * FROM kullanici WHERE kullanici_id=:id");
$kullanicisor->execute(array(
    'id' => $_GET['kullanici_id']
));
$kullanicicek = $kullanicisor->fetch(PDO::FETCH_ASSOC);
?>

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Kullanici Duzenleme<small>

                                    <?php if ($_GET['durum'] == "ok") { ?>
                                        <b style="color: limegreen;">Islem basarili.</b>
                                    <?php } else if ($_GET['durum'] == "ok") { ?>
                                        <b style="color: red;">Islem Basarisiz.</b>
                                    <?php } ?>
                                </small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br/>
                            <form action="../netting/islem.php" method="post" id="demo-form2" data-parsley-validate
                                  class="form-horizontal form-label-left">

                                <?php
                                $zaman = explode(" ", $kullanicicek['kullanici_zaman']);
                                ?>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kayit
                                        Zamani
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="date" name="kullanici_zaman" disabled id="first-name"
                                               value="<?php echo $zaman[0]; ?>" required="required"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3  col-xs-12" for="first-name">Kayit
                                        Saati
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="time" name="kullanici_zaman" disabled id="first-name"
                                               value="<?php echo $zaman[1]; ?>" required="required"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">FIN
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="kullanici_fin" id="first-name"
                                               value="<?php echo $kullanicicek['kullanici_fin']; ?>" required="required"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ad Soyad
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="kullanici_adsoyad" id="first-name"
                                               value="<?php echo $kullanicicek['kullanici_adsoyad']; ?>"
                                               required="required"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mail
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="kullanici_mail" disabled id="first-name"
                                               value="<?php echo $kullanicicek['kullanici_mail']; ?>"
                                               required="required"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanici
                                        durum
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="heard" class="form-control" name="kullanici_durum" required>
                                            <option value="1" <?php echo $kullanicicek['kullanici_durum'] == '1' ? 'selected=""' : ''; ?>>
                                                Aktiv
                                            </option>
                                            <option value="0" <?php if ($kullanicicek['kullanici_durum'] == 0) {
                                                echo 'selected=""';
                                            } ?>>Passiv
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'];?>">

                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" name="kullaniciduzenle" class="btn btn-success">Guncelle
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