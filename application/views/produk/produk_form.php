<!doctype html>
<html>

<head>
    <title>harviacode.com - codeigniter crud generator</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" />
    <style>
        body {
            padding: 15px;
        }
    </style>
</head>

<body>
    <h2 style="margin-top:0px">Produk <?php echo $button ?></h2>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="int">IdKategori <?php echo form_error('idKategori') ?></label>
            <!-- <input type="text" class="form-control" name="idKategori" id="idKategori" placeholder="IdKategori" value="<? php // echo $idKategori; 
                                                                                                                            ?>" /> -->
            <?=
            // function cmb_dinamis($name,$table,$field,$pk,$selected=null,$order=null)
            cmb_dinamis('idKategori', 'kategori', 'namaKategori', 'idKategori', null, null)
            ?>
        </div>
        <div class="form-group">
            <label for="int">IdMerek <?php echo form_error('idMerek') ?></label>
            <!-- <input type="text" class="form-control" name="idMerek" id="idMerek" placeholder="IdMerek" value="<?php echo $idMerek; ?>" /> -->
            <?=
            cmb_dinamis('idMerek', 'merek', 'namaMerek', 'idMerek', null, null)
            ?>
        </div>
        <div class="form-group">
            <label for="varchar">NamaProduk <?php echo form_error('namaProduk') ?></label>
            <input type="text" class="form-control" name="namaProduk" id="namaProduk" placeholder="NamaProduk" value="<?php echo $namaProduk; ?>" />

        </div>
        <div class="form-group">
            <label for="int">Harga <?php echo form_error('Harga') ?></label>
            <input type="text" class="form-control" name="Harga" id="Harga" placeholder="Harga" value="<?php echo $Harga; ?>" />
        </div>
        <div class="form-group">
            <label for="int">Stock <?php echo form_error('Stock') ?></label>
            <input type="text" class="form-control" name="Stock" id="Stock" placeholder="Stock" value="<?php echo $Stock; ?>" />
        </div>
        <div class="form-group">
            <label for="varchar">Foto <?php echo form_error('Foto') ?></label>
            <input type="file" class="form-control" name="Foto" id="Foto" placeholder="Foto" value="<?php echo $Foto; ?>" />
        </div>
        <div class="form-group">
            <label for="Deskripsi">Deskripsi <?php echo form_error('Deskripsi') ?></label>
            <textarea class="form-control" rows="3" name="Deskripsi" id="Deskripsi" placeholder="Deskripsi"><?php echo $Deskripsi; ?></textarea>
        </div>
        <div class="form-group">
            <label for="enum">Status <?php echo form_error('Status') ?></label>
            <!-- <input type="text" class="form-control" name="Status" id="Status" placeholder="Status" value="<?php echo $Status; ?>" /> -->
            <select name="Status" class="form-control show-tick">
                <option value="Baru">Baru</option>
                <option value="Bekas">Bekas</option>
            </select>
        </div>
        <hr>
        <p>
            &nbsp;
        </p>
        <input type="hidden" name="idProduk" value="<?php echo $idProduk; ?>" />
        <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
        <a href="<?php echo site_url('produk') ?>" class="btn btn-default">Cancel</a>
    </form>
</body>

</html>