<form class="" id="submituraianAdd" method="post" action="<?= base_url('admin_uraian/simpan_uraian') ?>" enctype="multipart/form-data">
	<div class="form-group" id="newuraian">
		<div>
			<label class="control-label col-lg-12"><h4>Edit Sprint</h4></label>
			<div class="clearfix"></div>
			<hr style="margin: 0px 15px 20px 15px;">
			<div class="clearfix"></div>

			<label class="control-label col-lg-2">SOP</label>
			<div class="col-lg-10" style="padding-bottom: 10px;">
				<select id="sop" class="form-control select2" name="sop" style="width:100%;" required>
					<option value="">Pilih SOP</option>
					<?php
						foreach ($sop as $data){
					?><option value="<?=$data["id_sop"]?>" <?= $custdata->sop_id == $data["id_sop"] ? 'selected' : '' ?>><?=$data["nama"]?></option>
					<?php
						}
					?>
				</select>
			</div>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">Nama Sprint</label>
			<div class="col-lg-10" style="padding-bottom: 10px;">
				<input type="text" id="nama" name="nama" class="form-control" value="<?= $custdata->nama ?>" required>
			</div>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">Deskripsi</label>
			<div class="col-lg-10" style="padding-bottom: 10px;">
				<input type="hidden" id="iduraian" name="iduraian" class="form-control" value="<?= $custdata->id_uraian ?>" >
				<input type="hidden" id="cari" name="cari" class="form-control" value="<?= $cari ?>" >
				<input type="hidden" id="page" name="page" class="form-control" value="<?= $page ?>" >
				<textarea id="deskripsi" name="deskripsi"><?= $custdata->deskripsi ?></textarea>
			</div>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">PIC</label>
			<div class="col-lg-10" style="padding-bottom: 10px;">
				<select id="userid" class="form-control select2" name="userid" style="width:100%;" required>
					<option value="">Pilih PIC</option>
					<?php
						foreach ($users as $data){
					?>
						<option value="<?=$data["id_pegawai"]?>" <?= $custdata->pegawai_id == $data["id_pegawai"] ? 'selected' : '' ?>><?=$data["nama"]?></option>
					<?php
						}
					?>
				</select>
			</div>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">File</label>
			<? if ($custdata->file != ''){ ?>
			<div class="col-lg-3" style="padding-bottom: 10px;"><a href="<?= base_url().'uploads/uraian-kerja/'.$custdata->file ?>" target="_blank"><?= $custdata->file ?></a></div>
			<? } ?>
			<div class="col-lg-6" style="padding-bottom: 10px;">
				<div class="input-group">
					<span class="input-group-btn">
						<span class="btn btn-primary btn-file">
						Browse… <input type="file" id="fileuraian" name="fileuraian">
						</span>
					</span>
					<input type="text" class="form-control" readonly="">
				</div>				
			</div>

			<div class="clearfix"></div>
			<hr style="margin: 10px 15px 20px 15px;">
			<div class="clearfix"></div>

			<div class="col-lg-2"></div>
			<div class="col-lg-4">
				<button type="submit" class="btn btn-info btn-block" name="submit">Simpan Data uraian</button>
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
		var urlAdd = "<?php echo base_url().'admin_uraian/lists_uraian'; ?>";
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
</script>				
