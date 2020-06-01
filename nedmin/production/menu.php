<?php include 'header.php';

$menusor = $db->prepare("SELECT * FROM menu ORDER BY menu_sira ASC ");
$menusor->execute();


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
                            <h2>Menu Listeleme<small></small></h2>
                            <div class="clearfix"></div>
                            <div align="right">
                                <a href="menu-ekle.php">
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
                                    <th>Menu ad</th>
                                    <th>Menu Url</th>
                                    <th>Menu Sira</th>
                                    <th>Menu Durum</th>
                                    <th>Duzenle</th>
                                    <th>Sil</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $say = 0;
                                while ($menucek = $menusor->fetch(PDO::FETCH_ASSOC)) {
                                    $say++; ?>
                                    <tr>
                                        <td width="20"><?php echo $say; ?></td>
                                        <td><?php echo $menucek['menu_ad']; ?></td>
                                        <td><?php echo $menucek['menu_url']; ?></td>
                                        <td><?php echo $menucek['menu_sira']; ?></td>
                                        <td><?php
                                            if ($menucek['menu_durum'] == 1) { ?>
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
                                                <a href="menu-duzenle.php?menu_id=<?php echo $menucek['menu_id']; ?>">
                                                    <button class="btn btn-primary btn-xs">Update</button>
                                                </a>
                                            </center>
                                        </td>
                                        <td>
                                            <center>
                                                <a href="../netting/islem.php?menu_id=<?php echo $menucek['menu_id']; ?>&menusil=ok">
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