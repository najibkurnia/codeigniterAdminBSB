<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Produk Read</h2>
        <table class="table">
	    <tr><td>IdKategori</td><td><?php echo $idKategori; ?></td></tr>
	    <tr><td>IdMerek</td><td><?php echo $idMerek; ?></td></tr>
	    <tr><td>NamaProduk</td><td><?php echo $namaProduk; ?></td></tr>
	    <tr><td>Harga</td><td><?php echo $Harga; ?></td></tr>
	    <tr><td>Stock</td><td><?php echo $Stock; ?></td></tr>
	    <tr><td>Foto</td><td><?php echo $Foto; ?></td></tr>
	    <tr><td>Deskripsi</td><td><?php echo $Deskripsi; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $Status; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('produk') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>