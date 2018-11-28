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
        <h2>Permohonan_cuti List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kd Karyawan</th>
		<th>Tgl Mulai</th>
		<th>Tgl Selesai</th>
		<th>Ket</th>
		<th>Acc</th>
		
            </tr><?php
            foreach ($permohonan_cuti_data as $permohonan_cuti)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $permohonan_cuti->kd_karyawan ?></td>
		      <td><?php echo $permohonan_cuti->tgl_mulai ?></td>
		      <td><?php echo $permohonan_cuti->tgl_selesai ?></td>
		      <td><?php echo $permohonan_cuti->ket ?></td>
		      <td><?php echo $permohonan_cuti->acc ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>