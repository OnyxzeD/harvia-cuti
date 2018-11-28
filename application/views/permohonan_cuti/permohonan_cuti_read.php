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
        <h2 style="margin-top:0px">Permohonan_cuti Read</h2>
        <table class="table">
	    <tr><td>Kd Karyawan</td><td><?php echo $kd_karyawan; ?></td></tr>
	    <tr><td>Tgl Mulai</td><td><?php echo $tgl_mulai; ?></td></tr>
	    <tr><td>Tgl Selesai</td><td><?php echo $tgl_selesai; ?></td></tr>
	    <tr><td>Ket</td><td><?php echo $ket; ?></td></tr>
	    <tr><td>Acc</td><td><?php echo $acc; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('permohonan_cuti') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>