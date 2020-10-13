<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" />
		<title><?=$title?></title>
		<meta name="description" content="<?=$description?>" />
		<meta name="keywords" content="<?=$keywords?>" />

		<link rel="shortcut icon" href="<?=ASSETS_IMAGE.'icon.png'?>" />
		
    <!-- Bootstrap -->
    <link href="<?= ASSETS_CSS ?>bootstrap.min.css" rel="stylesheet">
    <link href="<?= ASSETS_CSS ?>font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ASSETS_CSS ?>animate.min.css">
    <link rel="stylesheet" href="<?= ASSETS_CSS ?>bootstrap-checkbox.css">

    <link href="<?= ASSETS_CSS ?>minoral.css" rel="stylesheet">

    <!-- Import Animate CSS -->
    <link rel="stylesheet" href="<?= ASSETS_CSS ?>animate/animate.css" />
	
	  <!-- Import Hamburgers CSS -->
    <link rel="stylesheet" href="<?= ASSETS_CSS ?>hamburgers/hamburgers.css" />

    <!-- Import Bootstrap CSS -->
    <link rel="stylesheet" href="<?= ASSETS_CSS ?>bootstrap/bootstrap.min.css" />

    <!-- Import Owl Carousel CSS -->
    <link rel="stylesheet" href="<?= ASSETS_CSS ?>owlcarousel/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?= ASSETS_CSS ?>owlcarousel/owl.theme.default.min.css" />
    
    <!-- Import CSS -->
    <link rel="stylesheet" href="<?= ASSETS_CSS ?>style.css"/>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="brownish-scheme">

    <!-- Preloader -->
    <!--<div class="mask"><div id="loader"></div></div>-->
    <!--/Preloader -->

    <!-- Wrap all page content here -->
    <!-- <div id="wrap"> -->

      <!-- Make page fluid -->
      <!-- <div class="row">          -->
        
        <!-- Page content -->
        <!-- <div id="content" class="col-md-12 full-page login">

          <div class="col-md-9 col-sm-12 col-xs-12 hidden-sm hidden-xs">
            <div><img src="<?= ASSETS_IMAGE ?>/bg_login.jpg" style="width:100%;margin-top: 20px;"></div>
          </div>
          <div class="welcome col-md-3 col-sm-12 col-xs-12">
            <img src="<?= ASSETS_IMAGE ?>/logo-footer-merah.png" alt class="logo">
            <h1><strong>Kejaksaan Negeri </strong>Jakarta Selatan</h1>
						<hr />
            <form id="form-signin" class="form-signin" action="" method="POST">
	             <section>
								<? if ($this->session->flashdata('error') != ''){ ?>
									<label class="alert alert-danger" style="width:100%"><?= $this->session->flashdata('error') ?></label>
								<? } ?>
								<div class="input-group">
                  <input type="text" class="form-control" name="username" placeholder="Username">
                  <div class="input-group-addon"><i class="fa fa-user"></i></div>
                </div>
                <div class="input-group">
                  <input type="password" class="form-control" name="password" placeholder="Password">
                  <div class="input-group-addon"><i class="fa fa-key"></i></div>
                </div>
              </section>
              <section class="new-acc">
                <button class="btn btn-greensea" type="submit">Log In</button>
              </section>
            </form>
          </div>
          
        </div> -->
        <!-- Page content end -->

      <!-- </div> -->
      <!-- Make page fluid-->

    <!-- </div> -->
    <!-- Wrap all page content end -->

    <div class="wrapper d-none d-lg-block">
      <img src="<?= ASSETS_IMAGE ?>/login_bg_1.png" class="position-fixed" style="top: 0;width: 23%;z-index: -1;" />
      <img src="<?= ASSETS_IMAGE ?>/login_bg_2.png" class="position-fixed" style="bottom: 0;width: 100%;z-index: -1;margin-bottom: -30px;" />
      
      <section class="login-sec d-flex align-items-center justify-content-center">
        <div class="text-center">
          <img src="<?= ASSETS_IMAGE ?>/jaksa_logo.png" class="h-auto mb-3" style="width: 90px;" />
          <h5 style="color: rgba(0,0,0,.6);">Welcome To The Journal</h5>
          <h3 class="text-uppercase"><strong>Kejaksaan Negeri Jakarta Selatan</strong></h3>
          <form id="form-signin" class="form-signin d-inline-block" action="" method="POST">
            <? if ($this->session->flashdata('error') != ''){ ?>
              <label class="alert alert-danger" style="width:100%"><?= $this->session->flashdata('error') ?></label>
            <? } ?>
            <div class="form-g mb-3 position-relative">
              <input type="text" class="form-login" name="username" placeholder="Username" />
              <img src="<?= ASSETS_IMAGE ?>/login_user.png" class="position-absolute h-auto" style="width: 35px;bottom: 5px;right: 0;" />
            </div>
            <div class="form-g mb-3 position-relative">
              <input type="password" class="form-login" name="password" placeholder="Password"s />
              <img src="<?= ASSETS_IMAGE ?>/login_password.png" class="position-absolute h-auto" style="width: 35px;bottom: 5px;right: 0;" />
            </div>
            <div class="form-g mt-4">
              <button type="submit" style="background: linear-gradient(to right, rgb(254,193,0) , rgb(247,228,0));border: none;padding: 7px 80px;font-size: 12pt;font-weight: bold;border-radius: 18px;">Log in</button>
            </div>
          </form>
        </div>
      </section>
      
    </div>

    <div class="wrapper-m d-block d-lg-none">
      <img src="<?= ASSETS_IMAGE ?>/login-m-top.png" class="position-fixed" style="top: 0;width: 100%;z-index: -1;" />
      <img src="<?= ASSETS_IMAGE ?>/login-m-bot.png" class="position-fixed" style="bottom: 0;width: 100%;z-index: -1;margin-bottom: -30px;" />
      
      <section class="login-sec d-flex align-items-center justify-content-center">
        <div class="text-center">
          <img src="<?= ASSETS_IMAGE ?>/jaksa_logo.png" class="h-auto mb-3" style="width: 90px;" />
          <h6 style="color: rgba(0,0,0,.6);">Welcome To The Journal</h6>
          <h6 class="text-uppercase mb-5"><strong>Kejaksaan Negeri Jakarta Selatan</strong></h6>
          <form id="form-signin" class="form-signin d-inline-block" action="" method="POST">
            <? if ($this->session->flashdata('error') != ''){ ?>
                <label class="alert alert-danger" style="width:100%"><?= $this->session->flashdata('error') ?></label>
            <? } ?>
            <div class="form-g mb-3 position-relative">
              <input type="text" class="form-login" name="username" placeholder="Username" />
              <img src="<?= ASSETS_IMAGE ?>/login_user.png" class="position-absolute h-auto" style="width: 35px;bottom: 5px;right: 0;" />
            </div>
            <div class="form-g mb-3 position-relative">
              <input type="password" class="form-login" name="password" placeholder="Password" />
              <img src="<?= ASSETS_IMAGE ?>/login_password.png" class="position-absolute h-auto" style="width: 35px;bottom: 5px;right: 0;" />
            </div>
            <div class="form-g mt-4">
              <button type="submit" style="background: linear-gradient(to right, rgb(254,193,0) , rgb(247,228,0));border: none;padding: 8px 50px;font-size: 10pt;font-weight: bold;border-radius: 18px;">Log in</button>
            </div>
          </form>
        </div>
      </section>
    </div>

    <!-- Import Jquery 3.3.1 -->
    <script type="text/javascript" src="<?= ASSETS_JS ?>jquery-3.3.1.min.js"></script>

    <!-- Import Bootstrap JS -->
    <script type="text/javascript" src="<?= ASSETS_JS ?>bootstrap/bootstrap.min.js"></script>

    <!-- Import Owl Carousel JS -->
    <script type="text/javascript" src="<?= ASSETS_JS ?>owlcarousel/owl.carousel.min.js"></script>

    <!-- Import WOW JS -->
    <script type="text/javascript" src="<?= ASSETS_JS ?>wow/wow.min.js"></script>

    <!-- Import Javascript -->
    <script type="text/javascript" src="<?= ASSETS_JS ?>script.js"></script>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?= ASSETS_JS ?>bootstrap.min.js"></script>
    <script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?lang=css&amp;skin=sons-of-obsidian"></script>
    <script src="<?= ASSETS_JS ?>plugins/jquery.nicescroll.min.js"></script>
    <script src="<?= ASSETS_JS ?>plugins/blockui/jquery.blockUI.js"></script>


    <script src="<?= ASSETS_JS ?>minoral.min.js"></script>

    <script>
    $(function(){
      
      $('.welcome').addClass('animated bounceIn');

    })
      
    </script>
  </body>
</html>