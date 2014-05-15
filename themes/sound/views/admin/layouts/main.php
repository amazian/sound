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
        <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/admin.css" rel="stylesheet" />

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
        
        <!-- Le javascript -->
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/common.js"></script>
    </head>

    <body>

        <div class="container">
            <div class="navbar navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container-fluid">
                        <a data-target=".nav-collapse" data-toggle="collapse" class="btn btn-navbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <a href="#" class="brand">&nbsp;</a>
                        <div class="nav-collapse">
                            <ul class="nav">
                                <li <?php if($this->action->getController()->getId() == "default"): ?>class="active"<?php endif; ?>><a href="<?php echo $this->createUrl('/admin'); ?>">Dashboard</a></li>
                                <li class="dropdown <?php if($this->action->getController()->getId() == "products" || $this->action->getController()->getId() == "categories" || $this->action->getController()->getId() == "manufacturers" || $this->action->getController()->getId() == "attributes" || $this->action->getController()->getId() == "attributeGroups"): ?>active<?php endif; ?>">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Catalog <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo $this->createUrl('/admin/categories'); ?>">Categories</a></li>
                                        <li><a href="<?php echo $this->createUrl('/admin/products'); ?>">Products</a></li>
                                        <li><a href="<?php echo $this->createUrl('/admin/specUnit'); ?>">Specs & Units</a></li>
                                        <li><a href="<?php echo $this->createUrl('/admin/manufacturers'); ?>">Brands</a></li>
                                        <li><a href="<?php echo $this->createUrl('/admin/topSales'); ?>">Top Sales</a></li>
                                        <li><a href="<?php echo $this->createUrl('/admin/orders'); ?>">Orders</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">Delivery & Payment<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?php echo $this->createUrl('/admin/deliveryMethods'); ?>">Delivery Methods</a></li>
                                        <li><a href="<?php echo $this->createUrl('/admin/payPal'); ?>">PayPal Configuration</a></li>
                                        <li><a href="<?php echo $this->createUrl('/admin/openPay'); ?>">OpenPay Configuration</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <ul class="nav pull-right">
                                <li><a href="<?php echo $this->createUrl('/'); ?>"><?php echo Yii::t('help', 'Store Front'); ?></a></li>
                                <li class="divider-vertical"></li>
                                <li class="dropdown">
                                    <a class="" href="<?php echo $this->createUrl('/admin/login/logout'); ?>"><?php echo Yii::t('site', 'Logout'); ?></a>
                                </li>
                            </ul>
                        </div><!-- /.nav-collapse -->
                    </div>
                </div>
            </div>

            <?php if (isset($this->breadcrumbs) && count($this->breadcrumbs)): ?>
                <ul class="breadcrumb">
                    <li><a href="<?php echo $this->createUrl('/admin'); ?>"><?php echo Yii::t('common', 'Home'); ?></a> <span class="divider">/</span></li>
                    <?php foreach ($this->breadcrumbs as $breadcrumb): ?>
                        <?php if ($breadcrumb == end($this->breadcrumbs)): ?>
                            <li class="active"><?php echo $breadcrumb; ?></li>
                        <?php else: ?>
                            <li><a href="#"><?php echo $breadcrumb; ?></a> <span class="divider">/</span></li>
                        <?php endif; ?>
                    <?php endforeach; ?><!-- breadcrumbs -->
                </ul>
            <?php endif ?>

            <?php echo $content; ?>

            <hr />

            <div class="footer">
                <p>Sound &copy; 2013 All Rights Reserved.</p>
            </div>

        </div> <!-- /container -->
        
    </body>
</html>