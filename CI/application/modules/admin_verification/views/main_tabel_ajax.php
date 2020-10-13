<div class="col-lg-8">
	<form class="" id="submitcariverification" method="post" action="" enctype="multipart/form-data">
			<label class="control-label col-lg-1 col-xs-10 col-sm-10" style="margin-top:8px;padding:0;">Cari</label>
			<div class="col-lg-5" style="padding:0;">
					<input type="text" id="caricust" name="caricust" class="form-control" value="">
			</div>
			<div class="col-lg-1 col-xs-1 col-sm-1" style="padding:0;">
				<button class="btn btn-info" id="caribtn" onclick="caricust();" type="submit"><i class="fa fa-search"></i></button>
			</div>
			<div class="col-lg-1 col-xs-1 col-sm-1" style="padding:0;">
				<a class="btn btn-warning" id="carireset" href="javascript:void(0);" onclick="carireset();" type="button" title="reset"><i class="fa fa-refresh"></i></a>
			</div>
			<div class="col-lg-4"></div>
	</form>
</div>

<!--
<div class="col-lg-4">
	<button class="btn btn-primary" style="float:right;margin-right:20px;" id="addverificationbtn" onclick="addnew();"><i class="fa fa-plus-square"></i> Tambah Verifikasi File</button>
</div>
-->

<div class="clearfix"></div>
<hr style="margin: 10px 15px 10px 15px;">
<div class="clearfix"></div>
						
<? if ($this->session->flashdata('pesan') != ''){ ?>
<div class="form-group row" style="padding: 0 20px 0 15px;">
	<label class="alert alert-success col-lg-12"><?= $this->session->flashdata('pesan') ?></label>
</div>
<? } ?>											

<div class="table-responsive">
    <table  class="posttable display table table-bordered table-striped" id="dynamic-table">
    <thead>
    <tr>
        <th style="width: 20px;">No</th>
        <th>Tanggal</th>
        <th>Nama Pegawai</th>
        <th>Peraturan Nomor/SOP/Sprint</th>
        <th>File Before/After</th>
        <th>Status</th>
        <th>Approved By</th>
        <th width="12%">&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $total = $count;
    foreach ($rec as $data){
							?>  
    <tr>
        <td><?= $no; ?></td>
        <td><?= date('d-m-Y', strtotime($data['tglbuat'])) ?></td>
        <td><?= $data['namapegawai'] ?></td>
        <td><?= $data['nomorperaturan'] ?><br><?= $data['namasop'] ?><br><?= $data['namauraian'] ?></td>
        <td>
        	<? if ($data['file_before'] != ''){ ?>
        	<a href="<?= base_url().'uploads/verification-file/before/'.$data['file_before'] ?>" target="_blank"><i class="fa fa-file-o"></i></a> (<?= date('d-m-Y H:i', strtotime($data['time_before'])) ?>)
        	<? } ?>
        	<? if ($data['file_after'] != ''){ ?>
        	<br><a href="<?= base_url().'uploads/verification-file/after/'.$data['file_after'] ?>" target="_blank"><i class="fa fa-file-text-o"></i></a> (<?= date('d-m-Y H:i', strtotime($data['time_after'])) ?>)
        	<? } ?>
        </td>
        <td class="text-center">
        	<? if ($data['file_before'] != '' && $data['file_after'] != '' && $data['approved_kasub'] == '1'){ ?>
        	<span class="label label-success">Terverifikasi</span>
        	<? } else if ($data['file_before'] != '' && $data['file_after'] != '' && $data['approved_kasub'] == '0'){ ?>
        	<span class="label label-warning">Menunggu Approval</span>
        	<? } else { ?>
        	<span class="label label-danger">Belum Diproses</span>
        	<? } ?>
        </td>
        <td class="text-center">
        	<? if ($data['approved_kasub'] == '1' && $data['approved_kasie'] == '0' && $data['approved_kajari'] == '0'){ ?>
        	<span class="label label-success">Approved by KASUB</span>
        	<? } else if ($data['approved_kasub'] == '1' && $data['approved_kasie'] == '1' && $data['approved_kajari'] == '0'){ ?>
        	<span class="label label-success">Approved by KASIE</span>
        	<? } else if ($data['approved_kasub'] == '1' && $data['approved_kasie'] == '1' && $data['approved_kajari'] == '1'){ ?>
        	<span class="label label-success">Approved by KAJARI</span>
        	<? } ?>
        </td>
        <td style="text-align:center;">
            <a class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="editid(<?=$data["id_uraian"] ?>,<?= $hal ?>,'<?= $cari ?>');" title="Update" type="button"><i class="fa fa-pencil"></i></a>
			<? if ($this->session->userdata('user_login_level') == 'superadmin' && $data["id_verification"] != ''){ ?>
				<a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="if (confirm('Apakah data akan dihapus ?')) deleteid(<?=$data["id_verification"] ?>,<?= $hal ?>,'<?= $cari ?>')" title="Delete" type="button"><i class="fa fa-trash"></i></a>
			<? } ?>
        </td>
    </tr>
    <?php
    $no++;
    }
    ?>               
    </tbody>
    </table>
</div>
												
<?= $paginator ?>
		
<script>
	function carireset(){
		var urlAdd = "<?php echo base_url().'admin_verification/lists_verification/0/1'; ?>";
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
		return false;
	}
	
	function addnew(){
		var urlAdd = "<?php echo base_url().'admin_verification/add_verification'; ?>";
		$.ajax({
			url:urlAdd,
			beforeSend: function() {
				NProgress.start();
			},
			success:function(data) { 
				NProgress.done();
				$("#ajax_page").html(data);
				$(".select2").select2();
			    $('#tanggal').datepicker({
			    	format: 'dd-mm-yyyy',
			        todayHighlight: true
			    });
			    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
			        
			        var input = $(this).parents('.input-group').find(':text'),
			          log = numFiles > 1 ? numFiles + ' files selected' : label;
			        
			        if( input.length ) {
			          input.val(log);
			        } else {
			          if( log ) alert(log);
			        }
			        
			    });
			    $('#deskripsi').summernote({
			        height: 150   //set editable area's height
			    });
			}
		});
		//return false;
	}
	
	function editid(id,page,cari){
		var urlHideUnhide = "<?php echo base_url().'admin_verification/edit_verification/'; ?>" + id + "/" + page + "/" + cari;
		$.ajax({
			url:urlHideUnhide,
			beforeSend: function() {
				NProgress.start();
			},
			success:function(data) { 
				NProgress.done();
				$("#ajax_page").html(data);
				$(".select2").select2();
			    $('#tanggal').datepicker({
			    	format: 'dd-mm-yyyy',
			        todayHighlight: true
			    });
			    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
			        
			        var input = $(this).parents('.input-group').find(':text'),
			          log = numFiles > 1 ? numFiles + ' files selected' : label;
			        
			        if( input.length ) {
			          input.val(log);
			        } else {
			          if( log ) alert(log);
			        }
			        
			    });
			    $('#deskripsi').summernote({
			        height: 150   //set editable area's height
			    });
			}
		});
		return false;
	}

	function deleteid(id,page,cari){
		var urlHideUnhide = "<?php echo base_url().'admin_verification/delete/'; ?>" + id + "/" + page + "/" + cari;
		$.ajax({
			url:urlHideUnhide,
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
	
	$(document).ready(function() {	
	
			$('#submitcariverification').submit(function(event) {
				event.preventDefault();
				var cari = $("#caricust").val();
				
				var formData = {
						'cari' : cari
				};

				var urlSearch = "<?= base_url('admin_verification/lists_verification') ?>" ;

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

