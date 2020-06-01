<?php include 'header.php';

$kategorisor = $db->prepare("SELECT * FROM kategori ORDER BY kategori_sira ASC ");
$kategorisor->execute();


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
                            <h2>kategori Listeleme<small></small></h2>
                            <div class="clearfix"></div>
                            <div align="right">
                                <a href="kategori-ekle.php">
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
                                    <th>kategori ad</th>
                                    <th>kategori Sira</th>
                                    <th>kategori Durum</th>
                                    <th>Duzenle</th>
                                    <th>Sil</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $say = 0;
                                while ($kategoricek = $kategorisor->fetch(PDO::FETCH_ASSOC)) {
                                    $say++; ?>
                                    <tr>
                                        <td width="20"><?php echo $say; ?></td>
                                        <td><?php echo $kategoricek['kategori_ad']; ?></td>
                                        <td><?php echo $kategoricek['kategori_sira']; ?></td>
                                        <td><?php
                                            if ($kategoricek['kategori_durum'] == 1) { ?>
                                                <center>
                                                    <button class="btn btn-success btn-xs">Aktiv</button>
                                                </center>
                                            <?php } else { ?>
                                                <center>
                                                    <button class="btn btn-danger btn-xs">Passiv</button>
                                                </center>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="kategori-duzenle.php?kategori_id=<?php echo $kategoricek['kategori_id']; ?>">
                                                    <button class="btn btn-primary btn-xs">Update</button>
                                                </a>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="../netting/islem.php?kategori_id=<?php echo $kategoricek['kategori_id']; ?>&kategorisil=ok">
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