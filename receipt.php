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

		if ($apple == "") $apple = 0;
        if ($orange == "") $orange = 0;
        if ($banana == "") $banana = 0;

        $arr = array(0 => $apple, 1 => $orange, 2 => $banana);

		$total = ($apple * 69 +$orange *59 + $banana * 39)/100;

		$filename = '/home/nikhil/Documents/Web Projects/Simple-WebApp/order.txt';
		$file = fopen($filename, 'rw');
		$i = 0;
		$line1 = fgets($file);
		$cur_apple = substr($line1, strlen($line1)-3, 2);
		$line2 = fgets($file);
		$cur_orange = substr($line2, strlen($line2)-3, 2);
		$line3 = fgets($file);
		$cur_banana = substr($line3, strlen($line3)-3, 2);

		$next_apple = $cur_apple + $apple;
		$next_orange = $cur_orange + $orange;
		$next_banana = $cur_banana + $banana;

		$str = "Total number of apples: $next_apple \n
		Total number of oranges: $next_orange\n
		Total number of bananas: $next_banana";

		fwrite($file, $str);

		fclose($file);
	?>

	<table>
		<caption>Receipt for 
			<?php
			print $name;
			?>
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