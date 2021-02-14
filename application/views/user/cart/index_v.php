
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <input type="hidden" name="location_id" id="location_id" value="<?php echo $location_id;?>">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Nama Unit</th>
                                    <th>Satuan</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($carts as $item){?>
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="<?php echo base_url();?>detail/<?php echo $item['id']?>">
                                        <img class="img-fluid" src="<?php echo base_url();?>uploads/products/<?php echo $item['photo']?>" alt="" />
                                         </a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="<?php echo base_url();?>detail/<?php echo $item['id']?>"> 
                                            <?php echo $item['name'];?>
                                        </a>
                                    </td>
                                    <td class="price-pr">
                                        <p><?php echo "Rp. ".number_format($item['price']);?></p>
                                    </td>
                                    <td class="quantity-box">
                                        <input type="number" size="4" value="1" min="0" step="1" class="c-input-text qty text"></td>
                                    <td class="total-pr">
                                        <p><?php echo "Rp. ".number_format($item['price']);?></p>
                                    </td>
                                    <td class="remove-pr">
                                        <a href="#" class="remove-item" data-id="<?php echo $item['id']?>">
                                        <i class="fas fa-times"></i>
                                        </a>
                                    </td>
                                </tr> 
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
 
            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Permintaan summary</h3>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Total Dana Pengajuan</h5>
                            <div class="ml-auto h5"><?php echo "Rp. ".number_format($this->cart->total());?> </div>
                        </div>
                        <hr> </div>
                </div>
                <div class="col-4 d-flex shopping-box"><a href="<?php echo base_url()?>shop/<?php echo $location_id;?>" class="ml-auto btn hvr-hover">Kembali</a> </div>
                <div class="col-8 d-flex shopping-box"><a href="<?php echo base_url()?>checkout" class="ml-auto btn hvr-hover">Lanjutkan</a> </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

    <script data-main="<?php echo base_url()?>assets/js/main/main-cart" src="<?php echo base_url()?>assets/js/require.js"></script>