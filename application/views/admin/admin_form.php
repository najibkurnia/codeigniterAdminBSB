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
        <h2 style="margin-top:0px">Admin <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Username <?php echo form_error('Username') ?></label>
            <input type="text" class="form-control" name="Username" id="Username" placeholder="Username" value="<?php echo $Username; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Password <?php echo form_error('Password') ?></label>
            <input type="text" class="form-control" name="Password" id="Password" placeholder="Password" value="<?php echo $Password; ?>" />
        </div>
	    <div class="form-group">
            <label for="enum">Level <?php echo form_error('Level') ?></label>
            <!-- <input type="text" class="form-control" name="Level" id="Level" placeholder="Level" value="<?php echo $Level; ?>" /> -->\
            <!-- <select name="Level" class="form-control show-tick">
                <option value="Admin">Admin</option>
                <option value="Operator">Operator</option>
            </select> -->
            <div class="demo-radio-button">
                                <input name="Level" type="radio" id="radio_1" checked="" value="Admin">
                                <label for="Level">Admin</label>
                                <input name="Level" type="radio" id="radio_2" value="Operator">
                                <label for="Level">Operator</label>
                                <!-- <input name="group1" type="radio" class="with-gap" id="radio_3">
                                <label for="radio_3">Radio - With Gap</label>
                                <input name="group1" type="radio" id="radio_4" class="with-gap">
                                <label for="radio_4">Radio - With Gap</label>
                                <input name="group2" type="radio" id="radio_5" checked="" disabled="">
                                <label for="radio_5">Radio - Disabled</label>
                                <input name="group3" type="radio" id="radio_6" class="with-gap" checked="" disabled="">
                                <label for="radio_6">Radio - Disabled</label> -->
                            </div>
        </div>
	    <input type="hidden" name="idAdmin" value="<?php echo $idAdmin; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('admin') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>