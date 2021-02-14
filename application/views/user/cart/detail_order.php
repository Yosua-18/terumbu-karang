  
<div class="my-account-box-main">
    <div class="container">
        <a href="<?php echo base_url()?>account" class="btn btn-primary">Kembali</a>
        <br>
        <br>
        <?php 
        if(!empty($data_orders)){
            foreach($data_orders as $order){
            ?> 
            <div class="box-bordered mb-3">
                <div class="box-header">
                    <div class="row">
                        <div class="col-md-6">
                            <a class="id-trans" href="<?php echo base_url()?>detail-order/<?php echo $order->id;?>"><?php echo $order->order_number?></a>
                            <p class="date"><?php echo $order->tanggal_order?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-right">Total Pengajuan : <span class="price bold">Satuan <?php echo number_format($order->total_transaksi);?></span></p>
                            <p class="text-right">Status Pengajuan : <span class="text-success bold">Pengajuan Berhasil</span></p>
                        </div>
                    </div>
                </div> 

                <div class="box-body">
                    <div class="row">
                        <?php 
                        if(!empty($order->items )){
                            foreach($order->items as $items){?>
                            <div class="col-md-6">
                                <div class="img-thumb"><img src="<?php echo base_url();?>uploads/products/<?php echo $items->photo;?>"></div>
                                <div class="product-info">
                                    <p class="product-name"><?php echo $items->product_name;?></p>
                                    <p class="sku">Jenis Unit : <?php echo $items->product_sku;?></p>
                                    <p class="quantity mb-4">Jumlah : <?php echo $items->qty?></p>
                                </div> 
                            </div> 
                            <?php }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php }

        } ?> 
    </div>
</div>
<!-- End My Account -->


<script data-main="<?php echo base_url()?>assets/js/main/main-user-order" src="<?php echo base_url()?>assets/js/require.js"></script>