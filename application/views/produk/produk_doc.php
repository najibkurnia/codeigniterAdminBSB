<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Produk List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>IdKategori</th>
		<th>IdMerek</th>
		<th>NamaProduk</th>
		<th>Harga</th>
		<th>Stock</th>
		<th>Foto</th>
		<th>Deskripsi</th>
		<th>Status</th>
		
            </tr><?php
            foreach ($produk_data as $produk)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $produk->idKategori ?></td>
		      <td><?php echo $produk->idMerek ?></td>
		      <td><?php echo $produk->namaProduk ?></td>
		      <td><?php echo $produk->Harga ?></td>
		      <td><?php echo $produk->Stock ?></td>
		      <td><?php echo $produk->Foto ?></td>
		      <td><?php echo $produk->Deskripsi ?></td>
		      <td><?php echo $produk->Status ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>