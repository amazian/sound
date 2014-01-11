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

        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="brand" href="<?php echo $this->createUrl('/site/index'); ?>"><img alt="YOSON AUDIO" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo-home.png" /> </a>
                    <div class="nav-collapse collapse">
                        <p class="navbar-text pull-right">
                            <!--Logged in as <a href="#" class="navbar-link">Username</a>-->
                        </p>
                        <ul class="nav">

                            <li class="active"><a href="<?php echo $this->createUrl('/site/about'); ?>">公司簡介<br />About</a></li>
                            <li><a href="http://www.yosonaudio.com.tw/news_list.asp" target="_blank">最新消息<br />News</a></li>
                            <li><a href="http://yosonaudio.blogspot.tw/" target="_blank">部落格<br />Blog</a></li>
                            <li><a href="<?php echo $this->createUrl('/site/contact'); ?>">聯絡我們<br />Contact Us</a></li>
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        
        
        <div class="container">	
            <div class="row">
                <?php echo $content; ?>
            </div>
        </div> <!-- /container -->

        <footer>
            <div class="container">
                <div class="row">
                    <div class="span3">
                        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo_footer.png" />
                    </div>
                    <div class="span9">
                        <p>佑昇音響有限公司 台北市八德路一段五之二號一樓</p>
                        <p>Yoson Audio Copyright © 2011 All Rights Reserved. TEL:(02)23939677 FAX:(02)23939667. System Designed by <a href="http://www.amazianteam.com">Amazian</a>. Art designed by 一化設計.</p>
                    </div>
                </div>
            </div>
        </footer>


        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/bootstrap.min.js"></script>
    </body>
</html>
