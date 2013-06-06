<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=640px, target-densitydpi=260;"/>
<meta name="format-detection" content="telephone=no" />
<title><?php echo CHtml::encode( $this->pageTitle ); ?></title>
<?php Resource::loadJs( 'app' )?>
<?php Resource::loadCss( 'app' )?>
</head>
<body>
<?php echo $content; ?>
</body>
</html>