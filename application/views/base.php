<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> <?= $title; ?></title>

    <link href="<?= base_url()?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url()?>node_modules/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="<?= base_url()?>node_modules/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="<?= base_url()?>node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="<?= base_url()?>node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="<?= base_url()?>node_modules/toastr/build/toastr.css" rel="stylesheet">


    <script src="<?= base_url()?>node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url()?>node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"></script>
</head>

<body>

    <?= $this->load->view($content); ?>

    <script src="<?= base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url()?>node_modules/select2/dist/js/select2.min.js"></script>
    <script src="<?= base_url()?>node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url()?>node_modules/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="<?= base_url()?>node_modules/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="<?= base_url()?>node_modules/toastr/toastr.js"></script>


    <script src="<?= base_url()?>assets/vendor/js/script.js"></script>
</body>

</html>