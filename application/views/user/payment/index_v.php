
<!-- Start All Title Box -->
<div class="all-title-box">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="name"><?php echo $users->first_name?></p>
                <p class="email"><?php echo $users->email?></p>
                <a href="<?php echo base_url();?>auth/logout" class="email">Logout</a>
            </div>
        </div>
    </div>
</div>
<!-- End All Title Box -->

<!-- Start My Account  -->
<div class="my-account-box-main">
    <div class="container">
       
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane pt-3 container active" id="account">
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="box-bordered mb-3">
                            <div class="box-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a class="id-trans" href="<?php echo base_url()?>detail-order/<?php echo $data_orders->id;?>"><?php echo $data_orders->order_number?></a>
                                        <p class="date"><?php echo $data_orders->tanggal_order?></p>
                                    </div>
                                    <div class="col-md-6">
                                    <p class="text-right">Total Pengajuan : <span class="price bold">Rp <?php echo number_format($data_orders->total_transaksi);?></span></p>
                                        <p class="text-right">Status Pengajuan : <span class="text-success bold">Pengajuan Berhasil</span></p>
                                        <p class="text-right">Status Konfirmasi : 
                                             <?php if($data_orders->status_bayar == 0){?>
                                            <span class="text-danger bold">Belum Di Konfirmasi</span>
                                        <?php }else{?>
                                            <span class="text-success bold">Terkonfirmasi</span>
                                        <?php }?>
                                        </p>
                                    </div>
                                </div>
                            </div> 

                            <div class="box-body">
                                <div class="row">
                                    <?php 
                                    if(!empty($data_orders_item)){
                                        foreach($data_orders_item as $items){?>
                                        <div class="col-md-6">
                                            <div class="img-thumb"><img src="<?php echo base_url();?>uploads/products/<?php echo $items->photo;?>"></div>
                                            <div class="product-info">
                                                <p class="product-name"><?php echo $items->product_name;?></p>
                                                <p class="sku">SKU : <?php echo $items->product_sku;?></p>
                                                <p class="quantity mb-4">Jumlah : <?php echo $items->qty?></p>
                                            </div> 
                                        </div> 
                                        <?php }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="col-md-6">
                        <?php if(!empty($this->session->flashdata('message'))){?>
                          <div class="alert alert-warning">
                            <?php   
                               print_r($this->session->flashdata('message'));
                            ?>
                            </div>
                          <?php }?>
                          <?php if($data_orders->status_bayar == 0){?>
                        <h3 class="title">Bukti Pengajuan</h3>
                        <form action="<?php echo base_url();?>do_payment" method="POST"   enctype="multipart/form-data" id="form_bayar">
                            <input type="hidden" name="order_id" value="<?php echo $order_id;?>">
                            <div class="form-group">
                                <label class="form-label">*Bukti berupa foto atau screenshot pengajuan : </label>
                                <label class="form-label"\><a href="<?php echo base_url();?>uploads/products/pengajuan.docx"><u>Format Pengajuan</u></a></label>
                                 <input type="file" class="form-control" id="file"  name="file">
                            </div> 
                            <div class="submit-button text-center">
                                <button class="btn hvr-hover" id="submit" type="submit">Kirim Bukti</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    <?php }else{?>
                        <a href="<?php echo base_url()?>account" class="btn btn-primary">Kembali</a>
                    <?php }?>
                    </div>
                </div>
                
            </div>
            
        </div> 
    </div>
</div>
<!-- End My Account -->


<script data-main="<?php echo base_url()?>assets/js/main/main-account" src="<?php echo base_url()?>assets/js/require.js"></script>