<form class="" id="submitsopAdd" method="post" action="<?= base_url('admin_sop/simpan_sop') ?>" enctype="multipart/form-data">
	<div class="form-group" id="newsop">
		<div>
			<label class="control-label col-lg-12"><h4>Edit SOP</h4></label>
			<div class="clearfix"></div>
			<hr style="margin: 0px 15px 20px 15px;">
			<div class="clearfix"></div>

			<label class="control-label col-lg-2">Peraturan</label>
			<div class="col-lg-10" style="padding-bottom: 10px;">
				<select id="peraturan" class="form-control select2" name="peraturan" style="width:100%;" required>
					<option value="0">Pilih Peraturan</option>
					<?php
						foreach ($peraturan as $data){
					?>
						<option value="<?=$data["id_peraturan"]?>" <?= $custdata->peraturan_id == $data["id_peraturan"] ? 'selected' : '' ?>><?=$data["nomor"]?></option>
					<?php
						}
					?>
				</select>
			</div>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">Nama SOP</label>
			<div class="col-lg-6" style="padding-bottom: 10px;">
				<input type="text" id="nama" name="nama" class="form-control" value="<?= $custdata->nama ?>" required>
			</div>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">Deskripsi</label>
			<div class="col-lg-10" style="padding-bottom: 10px;">
				<input type="hidden" id="idsop" name="idsop" class="form-control" value="<?= $custdata->id_sop ?>" >
				<input type="hidden" id="cari" name="cari" class="form-control" value="<?= $cari ?>" >
				<input type="hidden" id="page" name="page" class="form-control" value="<?= $page ?>" >
				<textarea id="deskripsi" name="deskripsi"><?= $custdata->deskripsi ?></textarea>
			</div>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">File</label>
			<? if ($custdata->file != ''){ ?>
			<div class="col-lg-3" style="padding-bottom: 10px;"><a href="<?= base_url().'uploads/sop/'.$custdata->file ?>" target="_blank"><?= $custdata->file ?></a></div>
			<? } ?>
			<div class="col-lg-6" style="padding-bottom: 10px;">
				<div class="input-group">
					<span class="input-group-btn">
						<span class="btn btn-primary btn-file">
						Browse… <input type="file" id="filesop" name="filesop">
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
				<button type="submit" class="btn btn-info btn-block" name="submit">Simpan Data sop</button>
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
		var urlAdd = "<?php echo base_url().'admin_sop/lists_sop'; ?>";
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
