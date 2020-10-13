
        <!-- Page content -->
        <div id="content" class="col-md-12">
          
          <!-- breadcrumbs -->
          <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="<?= base_url() ?>"><i class="fa fa-home"></i> Dashboard</a></li>
              <li class="active">Change Password</li>
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
                <section class="tile">

                  <!-- tile body -->
                  <div class="tile-body">

										<? if ($this->session->flashdata('pesan') != ''){ ?>
										<div class="form-group row" style="padding: 0 20px 0 15px;">
											<?= $this->session->flashdata('pesan') ?>
										</div>
										<? } ?>
										<form class="" id="" method="post" action="<?= base_url('admin_main/simpan_password')?>" enctype="multipart/form-data">
												<div class="form-group" id="newcustomer">
														<div>
																<label class="control-label col-lg-3">New Password</label>
																<div class="col-lg-4" style="padding-bottom: 10px;">
																		<input type="password" id="password" name="password" class="form-control" value="" required>
																</div>
																<div class="clearfix"></div>
																<label class="control-label col-lg-3">Confirm New Password</label>
																<div class="col-lg-4" style="padding-bottom: 10px;">
																		<input type="password" id="password1" name="password1" class="form-control" value="" required>
																</div>

																<div class="clearfix"></div>
																<hr style="margin: 10px 15px 20px 15px;">
																<div class="clearfix"></div>

																<div class="col-lg-3"></div>
																<div class="col-lg-4">
																		<button type="submit" class="btn btn-info btn-block" name="submit">Change Password</button>
																</div>
																<div class="col-lg-2"></div>
																<div class="col-lg-4"></div>
														</div>

												</div>
										</form>
										<div class="clearfix"></div>
										
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

