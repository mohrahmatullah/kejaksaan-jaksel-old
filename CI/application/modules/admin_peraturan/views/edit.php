<form class="" id="submitperaturanAdd" method="post" action="<?= base_url('admin_peraturan/simpan_peraturan') ?>" enctype="multipart/form-data">
	<div class="form-group" id="newperaturan">
		<div>
			<label class="control-label col-lg-12"><h4>Edit Peraturan</h4></label>
			<div class="clearfix"></div>
			<hr style="margin: 0px 15px 20px 15px;">
			<div class="clearfix"></div>

			<label class="control-label col-lg-2">Nomor</label>
			<div class="col-lg-6" style="padding-bottom: 10px;">
				<input type="text" id="nomor" name="nomor" class="form-control" value="<?= $custdata->nomor ?>" required>
			</div>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">Tahun</label>
			<div class="col-lg-6" style="padding-bottom: 10px;">
				<input type="hidden" id="idperaturan" name="idperaturan" class="form-control" value="<?= $custdata->id_peraturan ?>" >
				<input type="hidden" id="cari" name="cari" class="form-control" value="<?= $cari ?>" >
				<input type="hidden" id="page" name="page" class="form-control" value="<?= $page ?>" >
				<input type="text" id="tahun" name="tahun" class="form-control" value="<?= $custdata->tahun ?>" required>
			</div>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">Tentang</label>
			<div class="col-lg-10" style="padding-bottom: 10px;">
				<input type="text" id="tentang" name="tentang" class="form-control" value="<?= $custdata->tentang ?>" required>
			</div>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">Tanggal Penetapan</label>
			<div class="col-lg-2" style="padding-bottom: 10px;">
				<input type="text" id="tanggal" name="tanggal" class="form-control" value="<?= date('d-m-Y', strtotime($custdata->tanggal_penetapan)) ?>" readonly="" required>
			</div>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">File</label>
			<? if ($custdata->file != ''){ ?>
			<div class="col-lg-3" style="padding-bottom: 10px;"><a href="<?= base_url().'uploads/peraturan/'.$custdata->file ?>" target="_blank"><?= $custdata->file ?></a></div>
			<? } ?>
			<div class="col-lg-6" style="padding-bottom: 10px;">
				<div class="input-group">
					<span class="input-group-btn">
						<span class="btn btn-primary btn-file">
						Browse… <input type="file" id="fileperaturan" name="fileperaturan">
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
				<button type="submit" class="btn btn-info btn-block" name="submit">Simpan Data peraturan</button>
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
		var urlAdd = "<?php echo base_url().'admin_peraturan/lists_peraturan'; ?>";
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
