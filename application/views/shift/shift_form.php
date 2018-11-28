<!doctype html>
<html>
<head>
    <title>harviacode.com - codeigniter crud generator</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
    <style>
        body {
            padding: 15px;
        }
    </style>
</head>
<body>
<h2 style="margin-top:0px">Shift <?php echo $button ?></h2>
<form action="<?php echo $action; ?>" method="post">
    <div class="form-group">
        <label for="varchar">Shift <?php echo form_error('shift') ?></label>
        <input type="text" class="form-control" name="shift" id="shift" placeholder="Shift"
               value="<?php echo $shift; ?>"/>
    </div>
    <div class="form-group">
        <label for="varchar">Jam <?php echo form_error('jam') ?></label>
        <input type="text" class="form-control" name="jam" id="jam" placeholder="Jam" value="<?php echo $jam; ?>"/>
    </div>
    <input type="hidden" name="kd_shift" value="<?php echo $kd_shift; ?>"/>
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
    <a href="<?php echo site_url('shift') ?>" class="btn btn-default">Cancel</a>
</form>
</body>
</html>