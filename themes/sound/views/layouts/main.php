<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $this->pageTitle; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Le styles -->
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-responsive.css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap-deletethis.css" rel="stylesheet" />
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery.rating.css" rel="stylesheet" />

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="<?php echo Yii::app()->baseUrl; ?>/js/html5shiv.js"></script>
        <![endif]-->
		
        <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css">
        <!--[if IE 7]>
          <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome-ie7.min.css">
        <![endif]-->

        <!-- Fav icon -->
        <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/img/favicon.png">
    </head>

    <body>
        <div class="container">	
            <div class="row">
                <?php echo $content; ?>
            </div>
        </div> <!-- /container -->


        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.rating.pack.js"></script>
    </body>
</html>
