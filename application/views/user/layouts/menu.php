 <!-- Start Main Top -->
<header class="main-header">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
        <div class="container">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fa fa-bars"></i>
              </button>
              <a class="navbar-brand" href="index.html"><img src="<?php echo base_url()?>assets/images/logo.png" class="logo" alt="" ></a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
              <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                  <li class="nav-item <?php echo ($path_url=== 'home')?'active':'';?>">
                    <a class="nav-link" href="<?php echo base_url()?>home">Home</a>
                  </li>
                  <li class="nav-item <?php echo ($path_url === "terumbu")?'active':'';?>" >
                    <a class="nav-link" href="<?php echo base_url()?>terumbu">Terumbu Karang</a>
                  </li>
                  
                  <li class="nav-item <?php echo ($path_url === "newspaper")?'active':'';?>" >
                    <a class="nav-link" href="<?php echo base_url()?>newspaper">News</a>
                  </li>
                  <li class="nav-item <?php echo ($path_url === "map")?'active':'';?>" >
                    <a class="nav-link" href="<?php echo base_url()?>map">Wilayah</a>
                  </li>
              </ul>
            </div>
            <!-- /.navbar-collapse -->

            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>
                     
                    <li class="side-menu">
                      <a href="#">
                      <i class="fa fa-shopping-bag"></i>
                      <span class="badge"><?php echo $total_items;?></span>
                      </a>
                    </li>
                    <?php if ($this->ion_auth->logged_in() && !$is_superadmin) { ?>
                    <li class="goprofile">
                      <a href="<?php echo base_url()?>account">
                      <i class="fa fa-user"></i>
                      </a>
                    </li>
                    <?php }else if ($this->ion_auth->logged_in() && $is_superadmin) { ?>
                    <li class="goprofile">
                      <a href="<?php echo base_url()?>dashboard">
                      <i class="fa fa-user"></i>
                      </a>
                    </li>
                    <?php }else{ ?>
                    <li class="goprofile">
                      <a href="<?php echo base_url()?>login">
                      <i class="fa fa-user"></i>
                      </a>
                    </li>

                  <?php }?>

                </ul>
            </div>
            <!-- End Atribute Navigation --> 
        </div>
        <!-- Start Side Menu -->
        <div class="side">
            <a href="#" class="close-side"><i class="fa fa-times"></i></a>
            <li class="cart-box">
                <ul class="cart-list">
                    <?php foreach($carts as $item){ ?>
                      <li>
                        <a href="#" class="photo"><img src="<?php echo base_url()?>/uploads/products/<?php echo $item['photo'];?>" class="cart-thumb" alt="" /></a>
                        <h6><a href="#"><?php echo $item['name'];?></a></h6>
                        <p><?php echo $item['qty'];?> - <span class="price">Rp. <?php echo number_format($item['price']);?></span></p>
                      </li> 
                    <?php }?> 
                    <li class="total"> 
                        <span  ><strong>Total</strong>: Rp. <?php echo number_format($this->cart->total());?></span>
                    </li>
                    <li class="total">
                        <a href="<?php echo base_url()?>cart/<?php echo $location_id?>" class="btn btn-default hvr-hover btn-cart">VIEW CART</a> 
                    </li>
                </ul>
            </li>
        </div>
        <!-- End Side Menu -->
    </nav>
    <!-- End Navigation -->
</header>
<!-- End Main Top -->