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
        <h2 style="margin-top:0px">Kategori <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">NamaKategori <?php echo form_error('namaKategori') ?></label>
            <input type="text" class="form-control" name="namaKategori" id="namaKategori" placeholder="NamaKategori" value="<?php echo $namaKategori; ?>" />
        </div>
	    <input type="hidden" name="idKategori" value="<?php echo $idKategori; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kategori') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>