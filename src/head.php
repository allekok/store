<?php
require("site.php");
?>
<!DOCTYPE HTML>
<html dir="rtl">
	<head>
		<title>
			<?php echo _TITLE; ?>
		</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width">
		<link rel="stylesheet"
		      href="<?php echo _PATH; ?>src/style/main.css">
	</head>
	<body>
		<header>
			<h1>
				<a href="<?php echo _PATH; ?>">
					<?php echo _TITLE; ?>
				</a>
			</h1>
			<a href="<?php echo _PATH; ?>checkout.php"
			   class="icon"
			   title="سبد خرید">
				shopping_cart
			</a>
		</header>
		<main>
