
<!-- Start Cart  -->
<div  class="cart-box-main">
    <div class="container">
        <div class="row new-account-login">
            <div class="col-sm-6 col-lg-6 mb-3">
                <div class="title-left">
                    <h3>Login Akun</h3>
                </div> 
                <form class="mt-3   review-form-box" id="formLogin" action="<?php echo base_url();?>auth/login" method="post">
                    <div class="form-row">
                        <?php if(!empty($this->session->flashdata('message_error'))){?>
                          <div class="alert alert-danger">
                            <?php   
                               print_r($this->session->flashdata('message_error'));
                            ?>
                            </div>
                          <?php }?>
                        <div class="form-group col-md-6">
                            <label for="InputEmail" class="mb-0">Email Address</label>
                            <input type="email" class="form-control" name="username" id="InputEmail" placeholder="Enter Email"> </div>
                        <div class="form-group col-md-6">
                            <label for="InputPassword" class="mb-0">Password</label>
                            <input type="password" class="form-control" name="password" id="InputPassword" placeholder="Password"> </div>
                    </div>
                    <button type="submit" class="btn hvr-hover">Login</button>
                </form>
            </div>
        </div> 
    </div>
</div>
<!-- End Cart -->
<script data-main="<?php echo base_url()?>assets/js/main/main-user-login" src="<?php echo base_url()?>assets/js/require.js"></script>