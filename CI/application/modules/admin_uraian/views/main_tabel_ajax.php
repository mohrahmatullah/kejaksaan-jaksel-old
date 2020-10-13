<div class="col-lg-8">
	<form class="" id="submitcariuraian" method="post" action="" enctype="multipart/form-data">
			<label class="control-label col-lg-1 col-xs-2 col-sm-2" style="margin-top:8px;padding:0;">Cari</label>
			<div class="col-lg-5 col-xs-6 col-sm-6" style="padding:0;">
					<input type="text" id="caricust" name="caricust" class="form-control" value="">
			</div>
			<div class="col-lg-1 col-xs-2 col-sm-2" style="padding:0;">
				<button class="btn btn-info" id="caribtn" onclick="caricust();" type="submit"><i class="fa fa-search"></i></button>
			</div>
			<div class="col-lg-1 col-xs-2 col-sm-2" style="padding:0;">
				<a class="btn btn-warning" id="carireset" href="javascript:void(0);" onclick="carireset();" type="button" title="reset"><i class="fa fa-refresh"></i></a>
			</div>
			<div class="col-lg-4"></div>
	</form>
</div>
<div class="col-lg-4 col-xs-12 col-sm-12">
	<button class="btn btn-primary" style="float:right;margin-right:20px;" id="adduraianbtn" onclick="addnew();"><i class="fa fa-plus-square"></i> Tambah Sprint</button>
</div>

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
        <th>Nama SOP</th>
        <th>Nama Sprint</th>
        <th>File</th>
        <th>Nama PIC</th>
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
        <td><?= $data['namasop'] ?></td>
        <td><?= $data['nama'] ?></td>
        <td>
        	<? if ($data['file'] != ''){ ?>
        	<a href="<?= base_url().'uploads/uraian-kerja/'.$data['file'] ?>" target="_blank"><i class="fa fa-file-o"></i></a>
        	<? } ?>
        </td>
        <td><?= $data['namauser'] ?></td>
        <td style="text-align:center;">
            <a class="btn btn-primary btn-sm" href="javascript:void(0);" onclick="editid(<?=$data["id_uraian"] ?>,<?= $hal ?>,'<?= $cari ?>');" title="Edit" type="button"><i class="fa fa-pencil"></i></a>
			<? if ($this->session->userdata('user_login_level') == 'superadmin'){ ?>
				<a class="btn btn-danger btn-sm" href="javascript:void(0);" onclick="if (confirm('Apakah data akan dihapus ?')) deleteid(<?=$data["id_uraian"] ?>,<?= $hal ?>,'<?= $cari ?>')" title="Delete" type="button"><i class="fa fa-trash"></i></a>
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
		var urlAdd = "<?php echo base_url().'admin_uraian/lists_uraian/0/1'; ?>";
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
		var urlAdd = "<?php echo base_url().'admin_uraian/add_uraian'; ?>";
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
		var urlHideUnhide = "<?php echo base_url().'admin_uraian/edit_uraian/'; ?>" + id + "/" + page + "/" + cari;
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
		var urlHideUnhide = "<?php echo base_url().'admin_uraian/delete/'; ?>" + id + "/" + page + "/" + cari;
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
	
			$('#submitcariuraian').submit(function(event) {
				event.preventDefault();
				var cari = $("#caricust").val();
				
				var formData = {
						'cari' : cari
				};

				var urlSearch = "<?= base_url('admin_uraian/lists_uraian') ?>" ;

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

