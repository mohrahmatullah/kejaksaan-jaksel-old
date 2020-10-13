<div class="col-lg-8">
	<form class="" id="submitcarireport" method="post" action="" enctype="multipart/form-data">
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


<div class="col-lg-4">
	<button class="btn btn-primary" style="float:right;margin-right:20px;" onclick="getPDF('.pdf-download')"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Export Report to PDF</button>
</div>


<div class="clearfix"></div>
<hr style="margin: 10px 15px 10px 15px;">
<div class="clearfix"></div>
						
<? if ($this->session->flashdata('pesan') != ''){ ?>
<div class="form-group row" style="padding: 0 20px 0 15px;">
	<label class="alert alert-success col-lg-12"><?= $this->session->flashdata('pesan') ?></label>
</div>
<? } ?>	

<div class="col-lg-8">
	<label for="sd">Start Date</label>
    <div id="start_date" class="input-group date date-picker">
      <input type="text" name="sd" class="form-control" title="Start Date" placeholder="Start Date" value="">
      <span class="input-group-addon">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
    </div>
</div>	
<div class="col-lg-8">
	<label for="ed">End Date</label>
    <div id="end_date" class="input-group date date-picker">
      <input type="text" name="ed" class="form-control" title="End Date" placeholder="End Date" value="">
      <span class="input-group-addon">
        <i class="glyphicon glyphicon-calendar"></i>
      </span>
    </div>
  </div>
</div>									

<div class="table-responsive pdf-download">
    <table  class="posttable display table table-bordered table-striped" id="dynamic-table">
    <thead>
    <tr>
        <th style="width: 20px;">No</th>
        <th>Tanggal</th>
        <th>Nama Pegawai</th>
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
		var urlAdd = "<?php echo base_url().'admin_report/lists_report/0/1'; ?>";
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
	
	$(document).ready(function() {	
	
			$('#submitcarireport').submit(function(event) {
				event.preventDefault();
				var cari = $("#caricust").val();
				
				var formData = {
						'cari' : cari
				};

				var urlSearch = "<?= base_url('admin_report/lists_report') ?>" ;

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
<script src="<?= ASSETS_JS ?>kendo.all.min.js"></script>
<script type="text/javascript">
  function getPDF(selector) {
      kendo.drawing.drawDOM($(selector)).then(function (group) {
        kendo.drawing.pdf.saveAs(group, "Report-sprint-kejaksaan-negeri.pdf");
      });
    }
</script>
