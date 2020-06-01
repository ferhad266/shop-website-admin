<?php include 'header.php';

$urunsor = $db->prepare("SELECT * FROM urun ORDER BY urun_id DESC ");
$urunsor->execute();


?>

    <head>
        <!-- Datatables -->
        <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    </head>
    <div class="right_col" role="main">
        <div class="">
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>urun Listeleme<small></small></h2>
                            <div class="clearfix"></div>
                            <div align="right">
                                <a href="urun-ekle.php">
                                    <button class="btn btn-success btn-xs">Yeni Ekle</button>
                                </a>
                            </div>
                        </div>
                        <div class="x_content">
                            <table id="datatable-responsive"
                                   class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                                   width="100%">
                                <thead>
                                <tr>
                                    <th>Sira No</th>
                                    <th>urun ad</th>
                                    <th>urun fiyat</th>
                                    <th>urun Stok</th>
                                    <th>One Cikanlar</th>
                                    <th>urun Durum</th>
                                    <th>Duzenle</th>
                                    <th>Sil</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $say = 0;
                                while ($uruncek = $urunsor->fetch(PDO::FETCH_ASSOC)) {
                                    $say++; ?>
                                    <tr>
                                        <td width="20"><?php echo $say; ?></td>
                                        <td><?php echo $uruncek['urun_ad']; ?></td>
                                        <td><?php echo $uruncek['urun_fiyat']; ?></td>
                                        <td><?php echo $uruncek['urun_stok']; ?></td>
                                        <td>
                                            <center><?php
                                                if ($uruncek['urun_onecikar'] == 0) {
                                                    ?>
                                                    <a href="../netting/islem.php?urun_id=<?= $uruncek['urun_id'] ?>&urun_one=1&urun_onecikar=ok">
                                                        <button class="btn btn-success btn-xs">One Cikar</button>
                                                    </a>
                                                <?php } else if ($uruncek['urun_onecikar'] == 1) {
                                                    ?>
                                                    <a href="../netting/islem.php?urun_id=<?= $uruncek['urun_id'] ?>&urun_one=0&urun_onecikar=ok">
                                                        <button class="btn btn-warning btn-xs">Kaldir</button>
                                                    </a>

                                                <?php } ?>
                                            </center>
                                        </td>
                                        <td><?php
                                            if ($uruncek['urun_durum'] == 1) { ?>
                                                <center>
                                                    <button class="btn btn-success btn-xs">Aktiv</button>
                                                </center>
                                            <?php } else { ?>
                                                <center>
                                                    <button class="btn btn-danger btn-xs">Passiv</button>
                                                </center>
                                            <?php } ?>
                                        </td>
                                        <!--                                        <td>--><?php
                                        //                                            if ($uruncek['urun_onecikar'] == 1) { ?>
                                        <!--                                                <center>-->
                                        <!--                                                    <button class="btn btn-success btn-xs">Onde</button>-->
                                        <!--                                                </center>-->
                                        <!--                                            --><?php //} else { ?>
                                        <!--                                                <center>-->
                                        <!--                                                    <button class="btn btn-danger btn-xs">Arkada</button>-->
                                        <!--                                                </center>-->
                                        <!--                                            --><?php //} ?>
                                        <!--                                        </td>-->
                                        <td>
                                            <center>
                                                <a href="urun-duzenle.php?urun_id=<?php echo $uruncek['urun_id']; ?>">
                                                    <button class="btn btn-primary btn-xs">Update</button>
                                                </a>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="../netting/islem.php?urun_id=<?php echo $uruncek['urun_id']; ?>&urunsil=ok">
                                                    <button class="btn btn-danger btn-xs">Delete</button>
                                                </a>
                                            </center>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Bitiyor -->

            </div>
        </div>
    </div>
    <!-- /page content -->
<?php include 'footer.php'; ?>