<?php
	session_start();

	require_once('koneksi/koneksi.php');
	
	if(isset($_GET['beli'])){
	if(empty($_SESSION['cart_'.$_GET['beli']])){
			$_SESSION['cart_'.$_GET['beli']]=1;
	}else{	
			$id = $_GET['beli'];
			$query="SELECT * FROM products WHERE id=$id";
			$result=$db->query($query);
			$row = $result->fetch_assoc();
			if($row['quantity']>$_SESSION['cart_'.$_GET['beli']]){
			$_SESSION['cart_'.$_GET['beli']]+=1;
		}
		
	}
}
	if (isset($_GET['remove'])){
		$_SESSION['cart_'.(int)$_GET['remove']]--;
	}

	if (isset($_GET['delete'])){
		$_SESSION['cart_'.(int)$_GET['delete']]='0';
	}

	function cart(){
		global $db;
		
		foreach($_SESSION as $name => $value){
			if($value>0){
				$id = substr($name,5,strlen($name)-5);
				$query="SELECT * FROM products WHERE id = $id";
				$result=$db->query($query);
				while($row=$result->fetch_assoc()){
					$sub=$value*$row['price'];
					echo $row['name']. ' x ' .$value.' @ '.$row['price']." = ".number_format($sub,2).
					'<a href="?beli='.$row['id'].'">[+]</a>'
					.'<a href="?remove='.$row['id'].'">[-]</a>'
					.'<a href="?delete='.$row['id'].'">DELETE</a>'
					."<br/>";
				}
			}else{
				echo"Belanja Kosong</br>";
			}
		}
	}
	
	function products(){
		global $db;
		global $id;
		$query = "SELECT * FROM products WHERE quantity > 0 ORDER BY name ASC";
		$result = $db->query($query);
		
		if($result->num_rows){
			while($row=$result->fetch_array()){
				echo"<div class='barang'>";
				
				echo "<p>".$row[0]."</p>";
				echo "<p>".$row[1]."</p>";
				echo "<p>".$row[2]."</p>";
				echo "<p>".$row[3]."</p>";
				echo "<p>".$row[4]."</p>";
				echo "<p>".$row[5]."</p>";
				echo "<a href='?beli=$row[0]'>Beli</a>";
				echo "<br/>";
				
				echo"</div>";
			}
		}else{
			echo"stok kosong";
		}
	}
	
?>









