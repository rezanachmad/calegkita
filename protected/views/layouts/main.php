<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jumbotron.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCwx2_GlAXTtijW98xK-H0QhPBTMmdTbPU&sensor=true"></script>
    </head>

    <body>

        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo Yii::app()->createUrl('site/index'); ?>"><?php echo CHtml::encode(Yii::app()->name); ?></a>
                </div>
                <div class="navbar-collapse collapse">
                    <div class="navbar-form navbar-right">
                        <?php if (Yii::app()->user->isGuest) : ?>
                            <a href="<?php echo Yii::app()->createUrl('site/login'); ?>">
                                <button type="button" class="btn btn-success">Login</button>
                            </a>
                            <a href="<?php echo Yii::app()->createUrl('register/index'); ?>">
                                <button type="button" class="btn btn-success">Register</button>
                            </a>
                        <?php else: ?>
                            <span style="color: white">
                                Halo, Rezan <?php Yii::app()->user->getState('name'); ?>
                            </span>
                            <a href="<?php echo Yii::app()->createUrl('site/logout'); ?>">
                                <button type="button" class="btn btn-default">Logout</button>
                            </a>
                        <?php endif; ?>
                    </div>
                </div><!--/.navbar-collapse -->
            </div>
        </div>

        <?php echo $content; ?>


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js"></script>
    </body>
</html>
