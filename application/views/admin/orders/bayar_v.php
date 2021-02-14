 <section class="content-header">
  <h1>
  Permintaan Unit
    <small><a href="<?php echo base_url();?>order">kembali</a></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Permintaan Unit</li>
  </ol>
</section>

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
                        </div>
                        <div class="col-md-6">
                            <p class="text-right">Total Permintaan : <span class="price bold">Jml<?php echo number_format($data_orders->total_transaksi);?></span></p>
                            <p class="text-right">Status Permintaan : <span class="text-success bold">Berhasil</span></p>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                      <form id="form" method="post" class="form-horizontal" method="POST" action="<?php echo base_url()?>order/proses_bayar">
                        <input type="hidden" name="order_id" id="order_id" value="<?php echo $order_id;?>">
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-3 control-label">Status</label> 
                          <div class="col-sm-6">
                            <select class="form-control" name="status_bayar" id="status_bayar">
                              <option >Status Konfirmasi</option>
                              <option value="0">Belum Di Konfirmasi</option>
                              <option value="1">Terkonfirmasi</option>
                            </select>
                          </div>
                        </div> 
                        <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-3 control-label">Tanggal Konfirmasi</label> 
                          <div class="col-sm-6">
                            <input type="date" class="form-control" id="tanggal_bayar" placeholder="tanggal_bayar" name="tanggal_bayar">
                          </div>
                        </div> 
                        <div class="form-group row m-t-md">
                          <div class="col-sm-9 text-right"> 
                            <button type="submit" class="btn btn-sm btn-info" id="save-btn">Proses</button>
                          </div>
                        </div>
                      </form>
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
                          <td>QTY</td>
                          <td>Price</td>
                        </tr>
                         <?php 
                        if(!empty($data_orders_item)){
                            foreach($data_orders_item as $items){?>
                        <tr>
                          <td><img src="<?php echo base_url();?>uploads/products/<?php echo $items->photo;?>" width="100px"></td>
                          <td><?php echo $items->product_name;?></td>
                          <td><?php echo $items->product_sku;?></td>
                          <td><?php echo $items->qty;?></td>
                          <td><?php echo " ".number_format( $items->price);?></td>
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