<!doctype html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />
		<title><?php echo CHtml::encode($this->pageTitle); ?></title>
		<?php
            $script = Yii::app()->clientScript;
            $script->registerCssFile(Yii::app()->request->baseUrl . '/media/stylesheet/grid.css');
            $script->registerCssFile(Yii::app()->request->baseUrl . '/media/stylesheet/fonts.css');
            $script->registerCssFile(Yii::app()->request->baseUrl . '/media/stylesheet/main.css');
            $script->registerCssFile(Yii::app()->request->baseUrl . '/media/stylesheet/lightbox.css');
            $script->registerScriptFile(Yii::app()->request->baseUrl . '/media/script/jquery.js');
            $script->registerScriptFile(Yii::app()->request->baseUrl . '/media/script/jquery-1.10.2.min.js');
            $script->registerScriptFile(Yii::app()->request->baseUrl . '/media/script/lightbox-2.6.min.js');
            $script->registerScriptFile(Yii::app()->request->baseUrl . '/media/script/html5.js');
		?>
	</head>
	<body>
		<header id="header">
			<?php $this->renderPartial('//blocks/header'); ?>
		</header><!-- end header -->
		<?php echo $content; ?>
		<footer>
			<?php $this->renderPartial('//blocks/footer'); ?>
		</footer>
	</body>
</html>