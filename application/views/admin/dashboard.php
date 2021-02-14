 <section class="content-header">
  <h1>
    Dashboard
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>


<!-- Main content -->
<section class="content">
    <div class="row">
      <div class="col-lg-6 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo $total_order?></h3>

            <p>Jumlah Permintaaan Konservasi</p>
          </div>
          <div class="icon">
            <i class="fa fa-file-image-o"></i>
          </div> 
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-6 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $total_user?></h3>

            <p>Jumlah User</p>
          </div>
          <div class="icon">
            <i class="fa fa-smile-o"></i>
          </div> 
        </div>
      </div>
     
      <!-- ./col -->
    </div>
       <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <!-- Custom tabs (Charts with tabs)-->
          <div class="nav-tabs-custom">
            
            <div class="tab-content no-padding">
              <!-- high chart - user -->
              
                <div id="usercount" style="height: 300px; min-width: 310px"></div>
            </div>
          </div> 
        </section> 
        <!-- /.Left col -->
        <!-- right col (We are only adding the ID to make the widgets sortable)-->
       
        <!-- right col -->
      </div>


</section>

 <script data-main="<?php echo base_url()?>assets/js/main/main-dashboard" src="<?php echo base_url()?>assets/js/require.js"></script>