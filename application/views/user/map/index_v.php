<!-- Start Blog  -->
<div class="latest-blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-all text-center">
                   <a href="<?php echo base_url();?>shop"> <h1>Identifikasi Lokasi Konservasi</h1></a>
                </div>
            </div>
        </div>
        <div id="map-container"  style="width: 100%; height: 400px;">
            
        </div>
        <div class="modal" tabindex="-1" role="dialog" id="map-detail">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">DETAIL WILAYAH KONSERVASI</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body"> 
                <input type="hidden" name="id" id="id">
                <table>
                    <tr>
                        <td>Nama </td>
                        <td class="nama"></td>
                    </tr>
                    <tr>
                        <td>Lat </td>
                        <td class="lat"></td>
                    </tr>
                    <tr>
                        <td>Long </td>
                        <td class="long"></td>
                    </tr>
                    <tr>
                        <td>Luas </td>
                        <td class="luas"></td>
                    </tr>
                    <tr>
                        <td>Kerusakan </td>
                        <td class="kerusakan"></td>
                    </tr>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="pilih-lokasi">PILIH LOKASI</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!----<div class="map-detail">
              <div>
                <a href="ajukan_lokasi.php" class="center btn hvr-hover">Ajukan Lokasi Baru</a>
            </div>
        </div>--->
    </div>
</div>
<!-- End Blog  -->


<script data-main="<?php echo base_url()?>assets/js/main/main-map" src="<?php echo base_url()?>assets/js/require.js"></script>