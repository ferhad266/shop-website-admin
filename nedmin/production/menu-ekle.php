<?php include 'header.php'; ?>

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Menu Ekleme<small>

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

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu ad
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="menu_ad" id="first-name"
                                               required="required" placeholder="Menu adi"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                        Menu Detay
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea class="ckeditor" id="editor1"
                                                  name="menu_detay"></textarea>
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu url
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="menu_url" id="first-name"
                                               placeholder="Menu url"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu sira
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="menu_sira" id="first-name"
                                               required="required" placeholder="Menu sira"
                                               class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Menu
                                        durum
                                        <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="heard" class="form-control" name="menu_durum" required>
                                            <option value="1">
                                                Aktiv
                                            </option>
                                            <option value="0">Passiv
                                            </option>
                                        </select>
                                    </div>
                                </div>


                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" name="menukaydet" class="btn btn-success">Kaydet
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