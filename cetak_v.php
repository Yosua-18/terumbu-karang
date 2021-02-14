  

<section class="content"> 

<div class="box box-default color-palette-box">
  <div class="box-body"> 
<center>
<img class="img-fluid" src="assets/images/logo.png" alt="" />
  <h2>LAPORAN KONSERVASI</h2>
  <h4>DINAS KELAUTAN DAN PERIKANAN JAWA BARAT</h4>

</center>

<h5>LAPORAN PENGIRIMAN DAN PENANAMAN TERUMBU KARANG</h5>
<table border="1" style="width: 100%" id="cetak-orders">
  <tr>
		  <th width="1%">No</th>
		  <th>List Number</th>
		  <th>Nama Petugas</th>
		  <th>Lokasi</th> 
		  <th>Status Permintaan</th> 
		  <th>Tanggal Permintaan</th> 
		  <th>Tanggal Pengiriman</th> 
  </tr>
  <?php 
  foreach ($data_orders as $key => $value) {
  
  ?>
  <tr>
	<td><?php echo $key+1; ?></td>
		  <td><?php echo $value->order_number; ?></td>
		  <td><?php echo $value->first_name; ?></td>
		  <td><?php echo $value->location_name; ?></td>
		  <td><?php echo $value->status_order; ?></td>
		  <td><?php echo $value->tanggal_order; ?></td>
		  <td><?php echo $value->tanggal_bayar; ?></td>
  </tr>
  <?php 
  }
  ?>
</table> 
</div>
</div>
</section> 
<script>window.print();</script>
<script data-main="<?php echo base_url()?>assets/js/main/main-orders" src="<?php echo base_url()?>assets/js/require.js"></script>