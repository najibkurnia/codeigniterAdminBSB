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
        <h2 style="margin-top:0px">Merek <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">NamaMerek <?php echo form_error('namaMerek') ?></label>
            <input type="text" class="form-control" name="namaMerek" id="namaMerek" placeholder="NamaMerek" value="<?php echo $namaMerek; ?>" />
        </div>
	    <input type="hidden" name="idMerek" value="<?php echo $idMerek; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('merek') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>