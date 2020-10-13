<form class="" id="submitverificationAdd" method="post" action="<?= base_url('admin_verification/simpan_verification') ?>" enctype="multipart/form-data">
	<div class="form-group" id="newverification">
		<div>
			<label class="control-label col-lg-12"><h4>Update Verifikasi Sprint</h4></label>
			<div class="clearfix"></div>
			<hr style="margin: 0px 15px 20px 15px;">
			<div class="clearfix"></div>
			<input type="hidden" id="idverification" name="idverification" class="form-control" value="<?= $custdata->id_verification ?>" >
			<input type="hidden" id="cari" name="cari" class="form-control" value="<?= $cari ?>" >
			<input type="hidden" id="page" name="page" class="form-control" value="<?= $page ?>" >

			<? if ($this->session->userdata('user_login_level') != 'superadmin'){ ?>
				<label class="control-label col-lg-2">Nama Pegawai</label>
				<div class="col-lg-10" style="padding-bottom: 10px;">
					<input type="hidden" id="pegawai" name="pegawai" value="<?= $pegawai->id_pegawai ?>" required>
					<input type="text" id="namapegawai" name="namapegawai" class="form-control" value="<?= $pegawai->nama ?>" readonly="">
				</div>
				<div class="clearfix"></div>
				<label class="control-label col-lg-2">NIK</label>
				<div class="col-lg-10" style="padding-bottom: 10px;">
					<input type="text" id="nik" name="nik" class="form-control" value="<?= $pegawai->nik ?>" readonly="">
				</div>
				<div class="clearfix"></div>
				<label class="control-label col-lg-2">Jabatan</label>
				<div class="col-lg-10" style="padding-bottom: 10px;">
					<input type="text" id="jabatan" name="jabatan" class="form-control" value="<?= $pegawai->jabatan ?>" readonly="">
				</div>
				<div class="clearfix"></div>
			<? } else { ?>
				<label class="control-label col-lg-2">Nama Pegawai</label>
				<div class="col-lg-10" style="padding-bottom: 10px;">
					<select id="pegawai" class="form-control select2" name="pegawai" style="width:100%;" required>
						<option value="">Pilih Nama Pegawai</option>
						<?php
							foreach ($pegawai as $data){
						?>
							<option value="<?=$data["id_pegawai"]?>" <?= $custdata->idpegawai == $data["id_pegawai"] ? 'selected' : '' ?>><?=$data["nama"]?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="clearfix"></div>
			<? } ?>
			<label class="control-label col-lg-2">Peraturan</label>
			<div class="col-lg-10" style="padding-bottom: 10px;">
				<select id="peraturan" class="form-control select2" name="peraturan" style="width:100%;" required>
					<option value="">Pilih Peraturan</option>
					<?php
						foreach ($peraturan as $data){
					?>
						<option value="<?=$data["id_peraturan"]?>" <?= $custdata->id_peraturan == $data["id_peraturan"] ? 'selected' : '' ?>><?=$data["nomor"]?> - <?=$data["tentang"]?></option>
					<?php
						}
					?>
				</select>
			</div>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">SOP</label>
			<div class="col-lg-10" style="padding-bottom: 10px;">
				<select id="sop" class="form-control select2" name="sop" style="width:100%;" required>
					<option value="">Pilih SOP</option>
					<?php
						foreach ($sop as $data){
					?><option value="<?=$data["id_sop"]?>" <?= $custdata->id_sop == $data["id_sop"] ? 'selected' : '' ?>><?=$data["nama"]?></option>
					<?php
						}
					?>
				</select>
			</div>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">Sprint</label>
			<div class="col-lg-10" style="padding-bottom: 10px;" id="divUraian">
				<select id="uraian" class="form-control select2" name="uraian" style="width:100%;" required>
					<option value="">Pilih Sprint</option>
					<?php
						foreach ($uraian as $data){
					?>
						<option value="<?=$data["id_uraian"]?>" <?= in_array($data["id_uraian"], explode(',', $custdata->id_uraian)) ? 'selected' : '' ?>><?=$data["nama"]?></option>
					<?php
						}
					?>
				</select>
			</div>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">Laporan Pekerjaan</label>
			<div class="col-lg-10" style="padding-bottom: 10px;" id="divUraian">
				<textarea id="laporan" name="laporan" class="form-control"><?= $custdata->laporan ?></textarea>
			</div>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">File Before <span class="cred">*</span></label>
			<div class="col-lg-4" style="padding-bottom: 10px;">
				<? if ($custdata->file_before != ''){ ?>
				<div style="padding-bottom: 10px;"><a href="<?= base_url().'uploads/verification-file/before/'.$custdata->file_before ?>" target="_blank"><?= $custdata->file_before ?></a></div>
				<div class="clearfix"></div>
				<? } ?>
				<div class="input-group">
					<span class="input-group-btn">
						<span class="btn btn-primary btn-file">
						Browse… <input type="file" id="filebefore" name="filebefore">
						</span>
					</span>
					<input type="text" class="form-control" readonly="">
				</div>				
			</div>
			<label class="control-label col-lg-2">Time Before</label>
			<div class="col-lg-4" style="padding-bottom: 10px;">
				<input type="text" id="timebefore" name="timebefore" class="form-control" value="<?= isset($custdata->time_before) && $custdata->time_before != '0000-00-00 00:00:00' ? date('d-m-Y H:i', strtotime($custdata->time_before)) : date('d-m-Y H:i') ?>" readonly="">
			</div>

			<? if ($custdata->file_before != ''){ ?>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">File After <span class="cred">*</span></label>
			<div class="col-lg-4" style="padding-bottom: 10px;">
				<? if ($custdata->file_after != ''){ ?>
				<div style="padding-bottom: 10px;"><a href="<?= base_url().'uploads/verification-file/before/'.$custdata->file_after ?>" target="_blank"><?= $custdata->file_after ?></a></div>
				<div class="clearfix"></div>
				<? } ?>
				<div class="input-group">
					<span class="input-group-btn">
						<span class="btn btn-primary btn-file">
						Browse… <input type="file" id="fileafter" name="fileafter">
						</span>
					</span>
					<input type="text" class="form-control" readonly="">
				</div>				
			</div>
			<label class="control-label col-lg-2">Time After</label>
			<div class="col-lg-4" style="padding-bottom: 10px;">
				<input type="text" id="timeafter" name="timeafter" class="form-control" value="<?= isset($custdata->time_after) && $custdata->time_after != '0000-00-00 00:00:00' ? date('d-m-Y H:i', strtotime($custdata->time_after)) : date('d-m-Y H:i') ?>" readonly="">
			</div>
			<? } ?>

			<div class="clearfix"></div>
			<hr style="margin: 10px 15px 20px 15px;">
			<div class="clearfix"></div>

			<div class="col-lg-2"></div>
			<div class="col-lg-4">
				<button type="submit" class="btn btn-info btn-block" name="submit">Simpan Data verification</button>
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
		var urlAdd = "<?php echo base_url().'admin_verification/lists_verification'; ?>";
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
		$('#sop').change(function() {
			var urlHideUnhide = "<?php echo base_url().'admin_verification/get_opsi_sop/'; ?>" + $('#sop').val();
			$.ajax({
				url:urlHideUnhide,
				beforeSend: function() {
					NProgress.start();
				},
				success:function(data) { 
					NProgress.done();
					$("#divUraian").html(data);
					$(".select2").select2();
				}
			});
			return false;
		});			
	});
</script>				
