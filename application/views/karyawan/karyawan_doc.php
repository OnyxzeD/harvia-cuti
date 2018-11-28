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
        <h2>Karyawan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nm Karyawan</th>
		<th>Jk</th>
		<th>Alamat</th>
		<th>Telepon</th>
		<th>Status</th>
		<th>Jumlah Anak</th>
		
            </tr><?php
            foreach ($karyawan_data as $karyawan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $karyawan->nm_karyawan ?></td>
		      <td><?php echo $karyawan->jk ?></td>
		      <td><?php echo $karyawan->alamat ?></td>
		      <td><?php echo $karyawan->telepon ?></td>
		      <td><?php echo $karyawan->status ?></td>
		      <td><?php echo $karyawan->jumlah_anak ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>