<section class="content">
  <div class="box box-default color-palette-box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-tag"></i>Tambah Jadwal</h3>
    </div>
    <form id="form" method="post" class="form-horizontal">
    <div class="box-body">
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 control-label">List Number</label> 
        <div class="col-sm-9">
          <input type="text" class="form-control" id="no_penjadwalan" placeholder="Nomor Permintaan" name="no_penjadwalan">
        </div>
      </div> 
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 control-label">Jadwal Pengiriman</label> 
        <div class="col-sm-9">
          <input type="text" class="form-control date_start" readonly id="jadwal_pengiriman" name="jadwal_pengiriman">
        </div>
      </div>   
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 control-label">Jadwal Penanaman</label> 
        <div class="col-sm-9">
          <input type="text" class="form-control date_start" readonly id="jadwal_penanaman" name="jadwal_penanaman">
        </div>
      </div>   
    </div> 
    <div class="box-footer">
      <div class="form-group row m-t-md">
        <div class="col-sm-12 text-right">
          <a href="<?php echo base_url();?>penjadwalan" class="btn btn-sm btn-danger">Cancel</a>
          <button type="submit" class="btn btn-sm btn-info" id="save-btn">Save</button>
        </div>
      </div>
    </div>
    </form>
  </div>
</section>
<script data-main="<?php echo base_url()?>assets/js/main/main-penjadwalan" src="<?php echo base_url()?>assets/js/require.js"></script>