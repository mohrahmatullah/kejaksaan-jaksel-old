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
    <link rel="stylesheet" href="<?= ASSETS_CSS ?>summernote.css">
    <link rel="stylesheet" href="<?= ASSETS_CSS ?>summernote-bs3.css">
    <link rel="stylesheet" href="<?= ASSETS_CSS ?>chosen.min.css">
    <link rel="stylesheet" href="<?= ASSETS_CSS ?>chosen-bootstrap.css">
    <link rel="stylesheet" href="<?= ASSETS_CSS ?>datepicker3.css">
    <link rel="stylesheet" href="<?= ASSETS_CSS ?>bootstrap-colorpicker.css">
    <link rel="stylesheet" href="<?= ASSETS_CSS ?>bootstrap-checkbox.css">
    <link href="<?= ASSETS_CSS ?>minoral.css" rel="stylesheet">
    <link href="<?= ASSETS_CSS ?>nprogress.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= ASSETS_PLUGINS ?>select2/select2.min.css">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?= ASSETS_JS ?>jquery-1.10.2.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="brownish-scheme">

		<? if ($nav_active == 'home1'){ ?>
    <!-- Preloader -->
    <div class="mask"><div id="loader"></div></div>
    <!--/Preloader -->
		<? } ?>

    <!-- Wrap all page content here -->
    <div id="wrap">

      <!-- Make page fluid -->
      <div class="row">

