 <section class="content-header">
  <h1>
    Detai Pengajuan Konservasi
    <small><a href="<?php echo base_url();?>order">kembali</a></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Detail Permintaan</li>
  </ol>
</section>
<script> window.print();</script>
<section class="content"> 
  <div class="box box-default color-palette-box">
    <div class="box-body"> 
      <div class="row">
        <div class="col-md-12"> 
        
            <div class="box-bordered mb-3">
                <div class="box-header">
                    <div class="row">
                        <div class="col-md-6">
                            <p><?php echo $data_orders->order_number?></p>
                            <p class="date"><?php echo $data_orders->tanggal_order?></p>
                            <?php if($data_orders->status_bayar == 1){?>
                            <p >Status Konfirmasi : <span class="text-success bold">Terkonfirmasi</span></p>
                            <p >Bukti Permintaan : 
                            <img width="100px" src="<?php echo base_url()?>uploads/bayar/<?php echo $data_orders->file_bayar?>">
                            </p>
                          <?php }else{ ?>
                             <p class="text-right">Status Konfirmasi : <span class="text-success bold">Belum di Konfirmasi</span></p>
                         <?php }?>
                        </div>
                        <div class="col-md-6">
                            
                            <p class="text-right">Total Dana Permintaan : <span class="price bold"><?php echo number_format($data_orders->total_transaksi);?></span></p>
                            <p class="text-right">Status Permintaan : <span class="text-success bold">Permintaan Berhasil</span></p>
                            
                        </div>
                    </div> 
                </div>  

                <div class="box-body">
                    <div class="row">
                      <table class="table">
                        <tr>
                          <td>Gambar Unit</td>
                          <td>Nama Unit</td>
                          <td>Jenis Unit</td>
                          <td>Jumlah</td>
                          <td>Harga Satuan</td>
                        </tr>
                         <?php 
                        if(!empty($data_orders_item)){
                            foreach($data_orders_item as $items){?>
                        <tr>
                          <td><img src="<?php echo base_url();?>uploads/products/<?php echo $items->photo;?>" width="100px"></td>
                          <td><?php echo $items->product_name;?></td>
                          <td><?php echo $items->product_sku;?></td>
                          <td><?php echo $items->qty;?></td>
                          <td><?php echo "Rp. ".number_format( $items->price);?></td>
                        </tr>

                            <?php }
                        }
                        ?>
                      </table>
                    </div>
                </div>
            </div> 
        </div>
      </div>
    </div>
  </div>
</section>
 <script data-main="<?php echo base_url()?>assets/js/main/main-orders" src="<?php echo base_url()?>assets/js/require.js"></script>