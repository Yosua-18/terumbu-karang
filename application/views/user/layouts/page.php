<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php   $this->load->view("user/layouts/header");?>
<body>
   <?php $this->load->view("user/layouts/menu");?>

    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
            </div>
        </div>
    </div>

 
  <?php $this->load->view($content);?>
  <!-- FOOTER -->
  <?php $this->load->view("user/layouts/footer");?>
</main>
</body>
<input type="hidden" id="base_url" value="<?php echo base_url();?>">
</html>
