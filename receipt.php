<!DOCTYPE html>
<html xmlns="">
<head>
	<title>Receipt</title>
</head>
<body>
	<?php
		$name = $_POST["name"];
		$apple = $_POST["apples"];
		$orange = $_POST["oranges"];
		$banana = $_POST["bananas"];
		$pmt = $_POST["pmt"];

		if ($apple == "") $apple = 0;
        if ($orange == "") $orange = 0;
        if ($banana == "") $banana = 0;

        $arr = array(0 => $apple, 1 => $orange, 2 => $banana);

		$total = ($apple * 69 +$orange *59 + $banana * 39)/100;

		$filename = '/home/nikhil/Documents/order.txt';
		$file = fopen($filename, 'c+');

		$file_contents = file_get_contents($filename);

		$cur_apple=0;
		$cur_orange=0;
		$cur_banana=0;

		if ($file_contents !== ""){
			preg_match("/Total number of apples: (\d+)/", $file_contents, $cur_apple);
			preg_match("/Total number of oranges: (\d+)/", $file_contents, $cur_orange);
			preg_match("/Total number of bananas: (\d+)/", $file_contents, $cur_banana);

			$cur_apple = intval($cur_apple[1]);
			$cur_orange = intval($cur_orange[1]);
			$cur_banana = intval($cur_banana[1]);
		}
		


		fseek($file,0);
		$next_apple = $cur_apple + $apple;
		$next_orange = $cur_orange + $orange;
		$next_banana = $cur_banana + $banana;

		$str = "Total number of apples: $next_apple\n";
		$str .= "Total number of oranges: $next_orange\n";
		$str .= "Total number of bananas: $next_banana";

		fwrite($file, $str);

		fclose($file);
	?>

	<table>
		<caption><b>Receipt for 
			<?php
			print $name;
			?>Paid using 
			<?php print $pmt; ?>
			</b>
		</caption>
		<tr>
			<th>Quantity</th>
			<th>Cost</th>
		</tr>
		<tr>
			<th>Apples</th>
			<td><?php print ("$apple"); ?></td>
			<td><?php print (($apple * 69.0)/100.0); ?></td>
		</tr>
		<tr>
			<th>Oranges</th>
			<td><?php print ("$orange"); ?></td>
			<td><?php print (($orange * 69.0)/100.0); ?></td>
		</tr>
		<tr>
			<th>Bananas</th>
			<td><?php print ("$banana"); ?></td>
			<td><?php print (($banana * 69.0)/100.0); ?></td>
		</tr>
		<tr>
			<th colspan=2>Total</th>
			<td>$ <?php print ("$total"); ?></th>
		</tr>
	</table>

</body>
</html>