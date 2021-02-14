<section class="content">
  <div class="box box-default color-palette-box">
    <div class="box-header with-border">
      <h3 class="box-title"><i class="fa fa-tag"></i>New News</h3>
    </div>
    <form id="form" method="post" class="form-horizontal">
    <div class="box-body">
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 control-label">Name</label> 
        <div class="col-sm-9">
          <input type="name" class="form-control" id="name" placeholder="Name" name="name">
        </div>
      </div> 
      <div class="form-group row">
        <label for="inputEmail3" class="col-sm-3 control-label">Description</label> 
        <div class="col-sm-9">
          <textarea class="form-control" name="description" id="description"> </textarea>
        </div>
      </div>   
    </div> 
    <div class="box-footer">
      <div class="form-group row m-t-md">
        <div class="col-sm-12 text-right">
          <a href="<?php echo base_url();?>news" class="btn btn-sm btn-danger">Cancel</a>
          <button type="submit" class="btn btn-sm btn-info" id="save-btn">Save</button>
        </div>
      </div>
    </div>
    </form>
  </div>
</section>

              
<script data-main="<?php echo base_url()?>assets/js/main/main-news" src="<?php echo base_url()?>assets/js/require.js"></script>
