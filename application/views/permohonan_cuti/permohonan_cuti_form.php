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
<h2 style="margin-top:0px">Permohonan_cuti <?php echo $button ?></h2>
<form action="<?php echo $action; ?>" method="post">
    <div class="form-group">
        <label for="varchar">Kd Karyawan <?php echo form_error('kd_karyawan') ?></label>
        <input type="text" class="form-control" name="kd_karyawan" id="kd_karyawan" placeholder="Kd Karyawan"
               value="<?php echo $kd_karyawan; ?>"/>
    </div>
    <div class="form-group">
        <label for="datetime">Tgl Mulai <?php echo form_error('tgl_mulai') ?></label>
        <input type="text" class="form-control" name="tgl_mulai" id="tgl_mulai" placeholder="Tgl Mulai"
               value="<?php echo $tgl_mulai; ?>"/>
    </div>
    <div class="form-group">
        <label for="datetime">Tgl Selesai <?php echo form_error('tgl_selesai') ?></label>
        <input type="text" class="form-control" name="tgl_selesai" id="tgl_selesai" placeholder="Tgl Selesai"
               value="<?php echo $tgl_selesai; ?>"/>
    </div>
    <div class="form-group">
        <label for="varchar">Ket <?php echo form_error('ket') ?></label>
        <input type="text" class="form-control" name="ket" id="ket" placeholder="Ket" value="<?php echo $ket; ?>"/>
    </div>
    <div class="form-group">
        <label for="varchar">Acc <?php echo form_error('acc') ?></label>
        <select class="form-control" name="acc" id="acc">
            <option value="Acc">Acc</option>
            <option value="Tolak">Tolak</option>
        </select>
    </div>
    <input type="hidden" name="kd_percuti" value="<?php echo $kd_percuti; ?>"/>
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
    <a href="<?php echo site_url('permohonan_cuti') ?>" class="btn btn-default">Cancel</a>
</form>
</body>
</html>