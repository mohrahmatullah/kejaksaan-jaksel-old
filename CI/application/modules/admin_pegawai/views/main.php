
        <!-- Page content -->
        <div id="content" class="col-md-12">
          
          <!-- breadcrumbs -->
          <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="<?= base_url() ?>"><i class="fa fa-money"></i> Dashboard</a></li>
              <li class="active">Pegawai</li>
						</ol>
          </div>
          <!-- /breadcrumbs -->

          <!-- content main container -->
          <div class="main">

            <!-- row -->
            <div class="row">

              <!-- col 12 -->
              <div class="col-md-12">
              
                <!-- tile -->
                <section class="tile cornered" style="min-height:650px;">

                  <!-- tile body -->
                  <div class="tile-body">
										
										<div id="ajax_page">
											<?= $this->load->view('main_tabel_ajax') ?>
										</div>
										
                  </div>
                  <!-- /tile body -->
                
                </section>
                <!-- /tile -->

              </div>
              <!-- /col 12 -->
        
            </div>
            <!-- /row -->

          </div>
          <!-- /content container -->

        </div>
        <!-- Page content end -->

				<script>
				function ajaxPage(urlLink)
				{  
					$.ajax({
						url:urlLink,
						beforeSend: function() {
							NProgress.start();
						},
						success:function(data) { 
							NProgress.done();
							$("#ajax_page").html(data);
							$(".select2").select2();
						}
					});
					return false;
				}				
				</script>

