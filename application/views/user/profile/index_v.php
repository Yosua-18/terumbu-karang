
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
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#account">Pengaturan Akun</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#history">Riwayat Pengajuan</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane pt-3 container active" id="account">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="title">Data Akun</h3>
                        <form>
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" value="<?php echo $users->email?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">No Ponsel</label>
                                <input type="text" class="form-control" value="<?php echo $users->phone?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control"><?php echo $users->address?></textarea>
                            </div>
                            <div class="submit-button text-center">
                                <button class="btn hvr-hover" id="submit" type="submit">Simpan</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <h3 class="title">Ubah Password</h3>
                        <form>
                            <div class="form-group">
                                <label class="form-label">Password Lama</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Password Baru</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ulangi Password Baru</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="submit-button text-center">
                                <button class="btn hvr-hover" id="submit" type="submit">Simpan</button>
                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
            <div class="tab-pane pt-3 container fade" id="history">
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
                                    <?php if($order->status_bayar == 0){?>
                                    <a class="btn btn-primary text-white" href="<?php echo base_url();?>payment/<?php echo $order->id?>">Ajukan</a>
                                    <?php } ?>
                                </div>
                                <div class="col-md-6">
                                    <p class="text-right">Status Permintaan : <span class="text-success bold">Permintaan Berhasil</span></p>
                                    <p class="text-right">Status Konfirmasi : 
                                        <?php if($order->status_bayar == 0){?>
                                            <span class="text-danger bold">Belum di Konfirmasi</span>
                                        <?php }else{?>
                                            <span class="text-success bold">Terkonfirmasi</span>
                                        <?php }?>

                                    </p>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <?php }

                } ?> 
            </div>
        </div>
    </div>
</div>
<!-- End My Account -->


<script data-main="<?php echo base_url()?>assets/js/main/main-account" src="<?php echo base_url()?>assets/js/require.js"></script>