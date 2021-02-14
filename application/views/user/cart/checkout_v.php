
<!-- Start Cart  -->
<div class="cart-box-main">
    <div class="container">
        <?php if(!$this->ion_auth->logged_in()){?>
        <div class="row new-account-login">
            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="title-left">
                    <h3>Login Akun</h3>
                </div>
                <h5><a data-toggle="collapse" href="#formLogin" role="button" aria-expanded="false">Klik di sini untuk login</a></h5>
                <form class="mt-3 collapse review-form-box" id="formLogin" action="<?php echo base_url();?>auth/login" method="post">
                    <?php if(!empty($this->session->flashdata('message_error'))){?>
                      <div class="alert alert-danger">
                        <?php   
                           print_r($this->session->flashdata('message_error'));
                        ?>
                        </div>
                      <?php }?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="InputEmail" class="mb-0">Email Address</label>
                            <input type="email" class="form-control" id="InputEmail" placeholder="Enter Email" name="username"> </div>
                        <div class="form-group col-md-6">
                            <label for="InputPassword" class="mb-0">Password</label>
                            <input type="password" class="form-control" id="InputPassword" placeholder="Password" name="password"> </div>
                    </div>
                    <button type="submit" class="btn hvr-hover">Login</button>
                </form>
            </div>
            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="title-left">
                    <h3>Buat Akun Baru</h3>
                </div>
                <h5><a data-toggle="collapse" href="#formRegister" role="button" aria-expanded="false">Klik di sini untuk daftar</a></h5>
                <form class="mt-3 collapse review-form-box" id="formRegister">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="InputName" class="mb-0">First Name</label>
                            <input type="text" class="form-control" id="InputName" placeholder="First Name"> </div>
                        <div class="form-group col-md-6">
                            <label for="InputLastname" class="mb-0">Last Name</label>
                            <input type="text" class="form-control" id="InputLastname" placeholder="Last Name"> </div>
                        <div class="form-group col-md-6">
                            <label for="InputEmail1" class="mb-0">Email Address</label>
                            <input type="email" class="form-control" id="InputEmail1" placeholder="Enter Email"> </div>
                        <div class="form-group col-md-6">
                            <label for="InputPassword1" class="mb-0">Password</label>
                            <input type="password" class="form-control" id="InputPassword1" placeholder="Password"> </div>
                    </div>
                    <button type="submit" class="btn hvr-hover">Register</button>
                </form>
            </div>
        </div>
        <?php }?>
        <div class="row">
            
            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="checkout-address">
                    <div class="title-left">
                        <h3>Alamat Pengiriman</h3>
                    </div> 
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Nama Lengkap *</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="<?php echo (!empty($users))?$users->first_name:'';?>" required>
                            <div class="invalid-feedback"> Nama depan harus valid. </div>
                        </div> 
                    </div> 
                    <div class="mb-3">
                        <label for="email">Email *</label>
                        <input type="email" class="form-control" id="email" placeholder="" value="<?php echo (!empty($users))?$users->email:'';?>">
                        <div class="invalid-feedback"> Silakan masukkan alamat email yang valid. </div>
                    </div>
                    <div class="mb-3">
                        <label for="address">Alamat *</label>
                        <input type="text" class="form-control" id="address" placeholder="" required value="<?php echo (!empty($users))?$users->address:'';?>">
                        <div class="invalid-feedback"> Silakan masukan alamat pengiriman. </div>
                    </div> 
                    <div class="row">
                       <!--  <div class="col-md-5 mb-3">
                            <label for="country">Provinsi *</label>
                            <select class="wide w-100" id="country">
                            <option value="Choose..." data-display="Select">Pilih...</option>
                            <option value="United States">Jawa Barat</option>
                        </select>
                            <div class="invalid-feedback"> Silakan pilih Provinsi. </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">Kota *</label>
                            <select class="wide w-100" id="state">
                            <option data-display="Select">Pilih...</option>
                            <option>Kota Bandung</option>
                        </select>
                            <div class="invalid-feedback"> Silakan pilih Kota. </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">Kecamatan *</label>
                            <select class="wide w-100" id="state">
                            <option data-display="Select">Pilih...</option>
                            <option>Kecamatan Bandung</option>
                        </select>
                            <div class="invalid-feedback"> Silakan pilih Kecamatan. </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">Kelurahan *</label>
                            <select class="wide w-100" id="state">
                            <option data-display="Select">Pilih...</option>
                            <option>Kelurahan Bandung</option>
                        </select>
                            <div class="invalid-feedback"> Silakan pilih Kelurahan. </div>
                        </div> -->
                        <!-- <div class="col-md-3 mb-3">
                            <label for="zip">Kode Pos *</label>
                            <input type="text" class="form-control" id="zip" placeholder="" required>
                            <div class="invalid-feedback"> Kode pos diperlukan. </div>
                        </div> -->
                    </div>
                    <!-- <hr class="mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="same-address">
                        <label class="custom-control-label" for="same-address">Alamat pengiriman sama dengan alamat pada tagihan</label>
                    </div>   -->
                    <hr class="mb-1">
                </div>
            </div>
            <div class="col-sm-6 col-lg-6 mb-3">
                <form class="needs-validation" novalidate method="POST" action="<?php echo base_url();?>cart/do_checkout">
                    <input type="hidden" name="user_id" id="user_id" 
                    value="<?php echo (!empty($users))?$users->id:'';?>">
                    <input type="hidden" name="location_id" id="location_id" 
                    value="<?php echo $location_id?>">
                    <div class="row"> 
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Keranjang Permintaan</h3>
                                </div>
                                <div class="rounded p-2 bg-light">
                                    <?php foreach($carts as $item){?>
                                    <div class="media mb-2 border-bottom">
                                        <div class="media-body"> <a href="detail.html"><?php echo $item['name']?></a>
                                            <div class="small text-muted">Satuan: <?php echo "Rp. ".number_format($item['price']);?> <span class="mx-2">|</span> Qty: <?php echo $item['qty']?> <span class="mx-2">|</span> Total: <?php echo "Rp. ".number_format($item['price'])?></div> 
                                        </div>
                                    </div> 
                                <?php }?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Permintaan Anda</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Produk</div>
                                    <div class="ml-auto font-weight-bold">Total</div>
                                </div>  
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Total Dana Pengajuan</h5>
                                    <div class="ml-auto h5"><?php echo "Rp. ".number_format($this->cart->total())?></div>
                                </div>
                                <hr> </div>
                        </div>
                        <div class="col-12 d-flex shopping-box"> <button class="ml-auto btn hvr-hover " >Proses</button> </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<!-- End Cart -->


<script data-main="<?php echo base_url()?>assets/js/main/main-checkout" src="<?php echo base_url()?>assets/js/require.js"></script>