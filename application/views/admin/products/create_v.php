<section class="content">
  <div class="box box-default color-palette-box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-tag"></i>Tambah Unit</h3>
    </div>
    <form id="form" method="post" class="form-horizontal" enctype="multipart/form-data">
    <div class="box-body">
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 control-label">Nama Unit</label> 
        <div class="col-sm-9">
          <input type="name" class="form-control" id="name" placeholder="Name" name="name">
        </div>
      </div> 
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 control-label">Jenis Unit</label> 
        <div class="col-sm-9">
          <select type="name" class="form-control" id="sku"  name="sku">
          <option value>Pilih Jenis Unit</option>
          <option value="Bibit Terumbu Karang">Bibit Terumbu Karang</option>
          <option value="Media Transplantasi">Media Transplantasi</option>
          </select>
        </div>
      </div> 
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 control-label">Harga</label> 
        <div class="col-sm-9">
          <input type="name" class="form-control" id="price" placeholder="Harga Jual di Pasaran" name="price">
        </div>
      </div> 
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 control-label">Gambar</label> 
        <div class="col-sm-9">
          <input type="file" class="form-control" id="photo" name="photo">
        </div>
      </div> 
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 control-label">Deskripsi</label> 
        <div class="col-sm-9">
          <textarea class="form-control" name="description" id="description"> </textarea>
        </div>
      </div>   
    </div> 
    <div class="box-footer">
      <div class="form-group row m-t-md">
        <div class="col-sm-12 text-right">
          <a href="<?php echo base_url();?>products" class="btn btn-sm btn-danger">Cancel</a>
          <button type="submit" class="btn btn-sm btn-info" id="save-btn">Save</button>
        </div>
      </div>
    </div>
    </form>
  </div>
</section>

              
<script data-main="<?php echo base_url()?>assets/js/main/main-products" src="<?php echo base_url()?>assets/js/require.js"></script>
