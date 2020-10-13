										<form class="" id="submituserAdd" method="post" action="" enctype="multipart/form-data">
												<div class="form-group" id="newuser">
														<div>
																<label class="control-label col-lg-12"><h4>Edit User</h4></label>
																<div class="clearfix"></div>
																<hr style="margin: 0px 15px 20px 15px;">
																<div class="clearfix"></div>

																<label class="control-label col-lg-2">Nama</label>
																<div class="col-lg-4" style="padding-bottom: 10px;">
																		<input type="hidden" id="iduser" name="iduser" class="form-control" value="<?= $usdata->id ?>" >
																		<input type="hidden" id="cari" name="cari" class="form-control" value="<?= $cari ?>" >
																		<input type="hidden" id="page" name="page" class="form-control" value="<?= $page ?>" >
																		<input type="text" id="namauser" name="namauser" class="form-control" value="<?= $usdata->nama ?>" required>
																</div>
																<div class="clearfix"></div>

																<label class="control-label col-lg-2">Username</label>
																<div class="col-lg-4" style="padding-bottom: 10px;">
																		<input type="text" id="username" name="username" class="form-control" value="<?= $usdata->username ?>" readonly="readonly" required>
																</div>
																<div class="clearfix"></div>

																<label class="control-label col-lg-2">Password</label>
																<div class="col-lg-4" style="padding-bottom: 10px;">
																		<input type="password" id="password" name="password" class="form-control" value="">
																</div>
																<div class="clearfix"></div>

																<label class="control-label col-lg-2">Level</label>
																<div class="col-lg-4" style="padding-bottom: 10px;">
																		<select id="level" class="form-control select2" name="level" style="width:100%;" required>
																				<option value="">Pilih Level</option>
																				<option value="superadmin" <?= $usdata->level == 'superadmin' ? 'selected' : '' ?>>Super Admin</option>
																				<option value="admin" <?= $usdata->level == 'admin' ? 'selected' : '' ?>>Admin</option>
																		</select>
																</div>

																<div class="clearfix"></div>
																<hr style="margin: 10px 15px 20px 15px;">
																<div class="clearfix"></div>

																<div class="col-lg-2"></div>
																<div class="col-lg-4">
																		<button type="submit" class="btn btn-info btn-block" name="submit">Simpan Data user</button>
																</div>
																<div class="col-lg-2">
																		<a href="javascript:void(0);" onclick="back();" class="btn btn-warning btn-block">Kembali Ke Tabel</a>
																</div>
																<div class="col-lg-4"></div>
														</div>

												</div>
										</form>
										<div class="clearfix"></div>
										
										<script>
											function back(){
												var urlAdd = "<?php echo base_url().'admin_user/lists_user'; ?>";
												$.ajax({
													url:urlAdd,
													beforeSend: function() {
														NProgress.start();
													},
													success:function(data) { 
														NProgress.done();
														$("#ajax_page").html(data);
														$(".select2").select2();
													}
												});
												//return false;
											}
											
											$(document).ready(function() {	
											
													$('#submituserAdd').submit(function(event) {
														event.preventDefault();
														var page = $("#page").val();
														var cari = $("#cari").val();
														var iduser = $("#iduser").val();
														var nama = $("#namauser").val();
														var username = $("#username").val();
														var password = $("#password").val();
														var level = $("#level").val();
													
														var formData = {
																'page' : page,
																'cari' : cari,
																'iduser' : iduser,
																'nama' : nama,
																'username' : username,
																'password' : password,
																'level' : level
														};

														var urlSearch = "<?= base_url('admin_user/simpan_user') ?>";

														$.ajax({
															type:'POST',
															url:urlSearch,
															data:formData,
															beforeSend: function() {
																NProgress.start();
															},
															success:function(data) { 
																NProgress.done();
																$("#ajax_page").html(data);
																$(".select2").select2();
															}
														});
														//return false;
													});
													
											});
										</script>				
