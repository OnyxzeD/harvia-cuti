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
        <h2 style="margin-top:0px">Bagian <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nm Bagian <?php echo form_error('nm_bagian') ?></label>
            <input type="text" class="form-control" name="nm_bagian" id="nm_bagian" placeholder="Nm Bagian" value="<?php echo $nm_bagian; ?>" />
        </div>
	    <input type="hidden" name="kd_bagian" value="<?php echo $kd_bagian; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('bagian') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>