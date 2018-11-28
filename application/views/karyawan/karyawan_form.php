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
        <h2 style="margin-top:0px">Karyawan <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nm Karyawan <?php echo form_error('nm_karyawan') ?></label>
            <input type="text" class="form-control" name="nm_karyawan" id="nm_karyawan" placeholder="Nm Karyawan" value="<?php echo $nm_karyawan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jk <?php echo form_error('jk') ?></label>
            <input type="text" class="form-control" name="jk" id="jk" placeholder="Jk" value="<?php echo $jk; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Alamat <?php echo form_error('alamat') ?></label>
            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="<?php echo $alamat; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Telepon <?php echo form_error('telepon') ?></label>
            <input type="text" class="form-control" name="telepon" id="telepon" placeholder="Telepon" value="<?php echo $telepon; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Status <?php echo form_error('status') ?></label>
            <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Jumlah Anak <?php echo form_error('jumlah_anak') ?></label>
            <input type="text" class="form-control" name="jumlah_anak" id="jumlah_anak" placeholder="Jumlah Anak" value="<?php echo $jumlah_anak; ?>" />
        </div>
	    <input type="hidden" name="kd_karyawan" value="<?php echo $kd_karyawan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('karyawan') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>