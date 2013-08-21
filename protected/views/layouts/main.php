<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
<?php
$home ;
    if(Yii::app()->user->checkAccess('0'))
    $home ='Modules';
    elseif (Yii::app()->user->checkAccess('1'))
    $home ='Modules';
    elseif (Yii::app()->user->checkAccess('2'))
    $home='Courses';
    elseif(Yii::app()->user->checkAccess('3'))
    $home='Country';
?>
	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php
                if(Yii::app()->user->isGuest)
                    $this->widget('zii.widgets.CMenu',array('items' =>array(array())));
                
                else
                $this->widget('zii.widgets.CMenu',array(
                    'encodeLabel'=>false,
			'items'=>array(
				array('label'=>$home, 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                            array('label'=>'<i style="float:right;margin-right:50px;">Notifications ('.Yii::app()->session['notifications'].')</i>', 'url'=>array('grade/notification'), 'visible'=>Yii::app()->user->checkAccess('0'))
			),
		)); ?>
	</div><!-- mainmenu -->
	

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
	Copyright &copy; <?php echo date('Y'); ?> by EdHat.<br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
