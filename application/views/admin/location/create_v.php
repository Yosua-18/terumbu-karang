<section class="content">
  <div class="box box-default color-palette-box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-tag"></i>Tambah Lokasi</h3>
    </div>
    <form id="form" method="post" class="form-horizontal">
    <div class="box-body">
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 control-label">Nama Lokasi</label> 
        <div class="col-sm-9">
          <input type="name" class="form-control" id="name" placeholder="Name" name="name">
        </div>
      </div> 
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 control-label">Latitude</label> 
        <div class="col-sm-9">
          <input type="name" class="form-control" id="lat" placeholder="Latitude" name="lat">
        </div>
      </div> 
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 control-label">Longitude</label> 
        <div class="col-sm-9">
          <input type="name" class="form-control" id="long" placeholder="Longitude" name="long">
        </div>
      </div> 
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 control-label">Luas Wilayah (/ha)</label> 
        <div class="col-sm-9">
          <input type="name" class="form-control" id="luas" placeholder="Luas" name="luas">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 control-label">Kerusakan (%)</label> 
        <div class="col-sm-9">
          <input type="name" class="form-control" id="kerusakan" placeholder="Kerusakan" name="kerusakan">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 control-label">Deskripsi</label> 
        <div class="col-sm-9">
          <input class="form-control" name="description" id="description"> </input>
        </div>
      </div>   
    </div> 
    <div class="box-footer">
      <div class="form-group row m-t-md">
        <div class="col-sm-12 text-right">
          <a href="<?php echo base_url();?>location" class="btn btn-sm btn-danger">Cancel</a>
          <button type="submit" class="btn btn-sm btn-info" id="save-btn">Save</button>
        </div>
      </div>
    </div>
    </form>
  </div>
</section>

              
<script data-main="<?php echo base_url()?>assets/js/main/main-location" src="<?php echo base_url()?>assets/js/require.js"></script>
