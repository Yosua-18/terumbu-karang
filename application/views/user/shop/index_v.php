 <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">
                        <div class="search-product">
                            <form action="#">
                                <input class="form-control" placeholder="Search here..." type="text">
                                <button type="submit"> <i class="fa fa-search"></i> </button>
                            </form>
                        </div>

                    </div>
                </div>
                <input type="hidden" name="location_id" id="location_id" value="<?php echo $location_id?>">
                <div class="col-xl-12 col-lg-12 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="row product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div class="row">
                                        <?php 
                                        if(!empty($data_products)){
                                        foreach($data_products as $product){?>
                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                            <div class="products-single fix">
                                                <div class="box-img-hover"> 
                                                    <img src="<?php echo base_url();?>uploads/products/<?php echo $product->photo;?>" class="img-fluid" alt="Image">
                                                    <div class="mask-icon">
                                                        <ul>
                                                            <li><a href="<?php echo base_url()?>detail/<?php echo $product->id?>" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li> 
                                                        </ul>
                                                        <a class="cart" 
                                                        data-id="<?php echo $product->id;?>"
                                                        data-name="<?php echo $product->name;?>"
                                                        data-price="<?php echo $product->price;?>"
                                                        data-photo="<?php echo $product->photo;?>"
                                                        data-size="L"

                                                        >
                                                            Pilih Unit
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="why-text">
                                                    <h4><?php echo $product->name;?></h4>
                                                    <h5>Rp. <?php echo number_format($product->price);?></h5>
                                                </div>
                                            </div>
                                        </div> 
                                        <?php }
                                    }?>
                                    </div>
                                </div> 
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->


<script data-main="<?php echo base_url()?>assets/js/main/main-shop" src="<?php echo base_url()?>assets/js/require.js"></script>