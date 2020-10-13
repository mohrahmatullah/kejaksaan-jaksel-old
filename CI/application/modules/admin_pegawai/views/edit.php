<form class="" id="submitpegawaiAdd" method="post" action="" enctype="multipart/form-data">
	<div class="form-group" id="newpegawai">
		<div>
			<label class="control-label col-lg-12"><h4>Edit Pegawai</h4></label>
			<div class="clearfix"></div>
			<hr style="margin: 0px 15px 20px 15px;">
			<div class="clearfix"></div>

			<label class="control-label col-lg-2">NIK</label>
			<div class="col-lg-6" style="padding-bottom: 10px;">
				<input type="text" id="nik" name="nik" class="form-control" value="<?= $custdata->nik ?>">
			</div>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">Nama</label>
			<div class="col-lg-6" style="padding-bottom: 10px;">
				<input type="hidden" id="idpegawai" name="idpegawai" class="form-control" value="<?= $custdata->id_pegawai ?>" >
				<input type="hidden" id="cari" name="cari" class="form-control" value="<?= $cari ?>" >
				<input type="hidden" id="page" name="page" class="form-control" value="<?= $page ?>" >
				<input type="text" id="namapegawai" name="namapegawai" class="form-control" value="<?= $custdata->nama ?>" required>
			</div>
			<label class="control-label col-lg-1">Jabatan</label>
			<div class="col-lg-3" style="padding-bottom: 10px;">
				<select id="jabatanpegawai" class="form-control select2" name="jabatanpegawai" style="width:100%;" required>
						<option value="">Pilih Jabatan</option>
						<?php
							foreach ($pegawaitype as $data){
						?>
							<option value="<?=$data["id_jabatan"]?>" <?= $custdata->jabatan_id == $data["id_jabatan"] ? 'selected' : '' ?>><?=$data["nama"]?></option>
						<?php
							}
						?>
				</select>
			</div>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">Alamat</label>
			<div class="col-lg-10" style="padding-bottom: 10px;">
				<input type="text" id="alamatpegawai" name="alamatpegawai" class="form-control" value="<?= $custdata->alamat ?>">
			</div>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">Propinsi</label>
			<div class="col-lg-4" style="padding-bottom: 10px;">
				<select id="proppegawai" class="form-control select2" name="proppegawai" style="width:100%;">
						<option value="">Pilih Propinsi</option>
						<?php
								foreach ($propinsiall as $data){
						?>
								<option value="<?=$data["id_propinsi"]?>" <?= $custdata->propinsi == $data["id_propinsi"] ? 'selected' : '' ?>><?=$data["nama_propinsi"]?></option>
						<?php
								}
						?>
				</select>
			</div>
			<label class="control-label col-lg-2">Kota/Kabupaten</label>
			<div class="col-lg-4" style="padding-bottom: 10px;" id="divKab">
				<select id="kabpegawai" class="form-control select2" name="kabpegawai" style="width:100%;">
						<option value="">Pilih Propinsi Dahulu</option>
						<?php
								foreach ($kabupatenall as $data){
						?>
								<option value="<?=$data["id_kabupaten"]?>" <?= $custdata->kabupaten == $data["id_kabupaten"] ? 'selected' : '' ?>><?=$data["nama_kabupaten"]?></option>
						<?php
								}
						?>
				</select>
			</div>
			<div class="clearfix"></div>
			<label class="control-label col-lg-2">No. Telp</label>
			<div class="col-lg-4" style="padding-bottom: 10px;">
				<input type="text" id="telppegawai" name="telppegawai" class="form-control" value="<?= $custdata->telp ?>">
			</div>
			<label class="control-label col-lg-2">Email</label>
			<div class="col-lg-4" style="padding-bottom: 10px;">
				<input type="text" id="emailpegawai" name="emailpegawai" class="form-control" value="<?= $custdata->email ?>">
			</div>

			<div class="clearfix"></div>
			<hr style="margin: 10px 15px 20px 15px;">
			<div class="clearfix"></div>

			<div class="col-lg-2"></div>
			<div class="col-lg-4">
				<button type="submit" class="btn btn-info btn-block" name="submit">Simpan Data pegawai</button>
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
		var urlAdd = "<?php echo base_url().'admin_pegawai/lists_pegawai'; ?>";
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
	
			$('#proppegawai').change(function() {
					var urlHideUnhide = "<?php echo base_url().'admin_pegawai/get_opsi_kabupaten/'; ?>" + $('#proppegawai').val();
					$.ajax({
						url:urlHideUnhide,
						beforeSend: function() {
							NProgress.start();
						},
						success:function(data) { 
							NProgress.done();
							$("#divKab").html(data);
							$(".select2").select2();
						}
					});
					return false;
			});
			
			$('#submitpegawaiAdd').submit(function(event) {
				event.preventDefault();
				var page = $("#page").val();
				var cari = $("#cari").val();

				var idpegawai = $("#idpegawai").val();
				var nik = $("#nik").val();
				var nama = $("#namapegawai").val();
				var jabatan = $("#jabatanpegawai").val();
				var alamat = $("#alamatpegawai").val();
				var propinsi = $("#proppegawai").val();
				var kabupaten = $("#kabpegawai").val();
				var telp = $("#telppegawai").val();
				var email = $("#emailpegawai").val();
				
				var formData = {
						'page' : page,
						'cari' : cari,
						'idpegawai' : idpegawai,
						'nik' : nik,
						'nama' : nama,
						'jabatan' : jabatan,
						'alamat' : alamat,
						'propinsi' : propinsi,
						'kabupaten' : kabupaten,
						'telp' : telp,
						'email' : email
				};

				var urlSearch = "<?= base_url('admin_pegawai/simpan_pegawai') ?>";

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
