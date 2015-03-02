<?php require('cart.php');?>
<html>
	<head>
		<style>
		.barang{
			display: inline-block;
			border : 1px solid black;
			padding:30px;
			margin-left:15px;
			margin-right:15px;		
			margin-top:40px;
		}
		.keranjang{
			border : 1px solid black;
		}
		</style>
	</head>
	<body>
	<div class="keranjang">
		<?php cart();?>
	</div>
		
	<div>	
		<?php products();?>
	</div>
	</body>
</html>