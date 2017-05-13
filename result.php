<?php
$data = unserialize(file_get_contents('hasil.txt'));
// var_dump($data[0]);
function rekursif($array) {
	if($array['item'] == "null") {
		echo "\n<div class='new_node'>";
		echo "<div class='root'>";
		echo "root";
		echo "</div>";
		echo "<ul>";
		
		echo "<p>Luthfi</p>";
		foreach($array['child'] as $key => $value) {
			echo "<li>";
			rekursif($value);
			echo "</li>";
		}
		echo "</ul>";
		echo "</div>";
	} else {
		if(!empty($array['child'])) {
			echo "<div class='new_node'>";
			echo "<ul>";
			echo "<p>" . $array['item'] . " : " . $array['count'] . "</p>";
			foreach($array['child'] as $key => $value) {
				echo "<li>";
				rekursif($value);
				echo "</li>";
			}
			echo "</ul>";
			echo "</div>";
		} else {
			echo "<div class='new_node'>";
			echo "<ul>";
			echo "<li>";
			echo "<p>" . $array['item'] . " : " . $array['count'] . "</p>";
			echo "</li>";
			echo "</ul>";
			echo "</div>";
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		.new_node{
			border:1px solid #000;
		}

		.new_node>ul>li{
			display:table-cell;
			text-align: center;
			float:none;
		}
	</style>
</head>
<body>
<?php rekursif($data[0]); ?>
</body>
</html>