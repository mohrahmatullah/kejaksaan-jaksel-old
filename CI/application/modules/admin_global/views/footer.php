      </div>
      <!-- Make page fluid-->

    </div>
    <!-- Wrap all page content end -->
		
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?= ASSETS_JS ?>bootstrap.min.js"></script>
    <script src="<?= ASSETS_JS ?>plugins/jquery.nicescroll.min.js"></script>
    <script src="<?= ASSETS_JS ?>plugins/blockui/jquery.blockUI.js"></script>
    <script src="<?= ASSETS_JS ?>plugins/summernote/summernote.min.js"></script>
    <script src="<?= ASSETS_JS ?>plugins/chosen/chosen.jquery.min.js"></script>
    <script src="<?= ASSETS_JS ?>plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?= ASSETS_JS ?>plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
    <script src="<?= ASSETS_JS ?>minoral.min.js"></script>
		<script src="<?= ASSETS_JS ?>plugins/ckeditor/ckeditor.js"></script>
    <script src="<?= ASSETS_PLUGINS ?>select2/select2.full.min.js"></script>
		<script src="<?= ASSETS_JS ?>nprogress.js"></script>
		
    <script>

    //initialize file upload button function
    $(document)
      .on('change', '.btn-file :file', function() {
        var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
    });

    $(function(){
      
      //load wysiwyg editor
      $('#input06').summernote({
        height: 130   //set editable area's height
      });

      //chosen select input
      $(".chosen-select").chosen({disable_search_threshold: 10});

      //initialize datepicker
      $('.datepicker').datepicker({
				format: 'dd-mm-yyyy',
        todayHighlight: true
      });

      //initialize file upload button
      $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
          log = numFiles > 1 ? numFiles + ' files selected' : label;
        
        if( input.length ) {
          input.val(log);
        } else {
          if( log ) alert(log);
        }
        
      });
      $(".select2").select2();

    })
      
		CKEDITOR.replace('ckeditor',{ 
			filebrowserWindowWidth: '900',
			filebrowserWindowHeight: '400',
			filebrowserImageBrowseUrl: '<?php echo base_url()?>assets/kcfinder/browse.php?opener=ckeditor&type=images',
			filebrowserFlashBrowseUrl: '<?php echo base_url()?>assets/kcfinder/browse.php?opener=ckeditor&type=Flash',			
		});
		
   </script>
		
  </body>
</html>