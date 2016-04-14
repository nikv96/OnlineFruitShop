<!DOCTYPE html>
<html xmlns="">

<head>
    <title>Receipt for CZ3006 Online Fruit Shop</title>
</head>

<body>
    <?php
        //Obtaining post data from the form
		$name = $_POST["name"];
		$apple = $_POST["apples"];
		$orange = $_POST["oranges"];
		$banana = $_POST["bananas"];
		$pmt = $_POST["pmt"];

        //Defaulting values to zero in case they are absent
		if ($apple == "") $apple = 0;
        if ($orange == "") $orange = 0;
        if ($banana == "") $banana = 0;
    
        //Computing the total
		$total = ($apple * 69 +$orange *59 + $banana * 39)/100;

		//Change according to the computer specs
		$filename = 'order.txt';
		$file = fopen($filename, 'c+');
    
        //getting all the file values in a string
		$file_contents = file_get_contents($filename);

		$cur_apple=0;
		$cur_orange=0;
		$cur_banana=0;

		if ($file_contents !== ""){
            //Applying regular expressions matching
			preg_match("/Total number of apples: (\d+)/", $file_contents, $cur_apple);
			preg_match("/Total number of oranges: (\d+)/", $file_contents, $cur_orange);
			preg_match("/Total number of bananas: (\d+)/", $file_contents, $cur_banana);
            
            //first array value
			$cur_apple = intval($cur_apple[1]);
			$cur_orange = intval($cur_orange[1]);
			$cur_banana = intval($cur_banana[1]);
		}
		

        //seeking to zero so that we can rewrite content
		fseek($file,0);
        //computing next fruit values
		$next_apple = $cur_apple + $apple;
		$next_orange = $cur_orange + $orange;
		$next_banana = $cur_banana + $banana;
        
        //appending to string to print to file
		$str = "Total number of apples: $next_apple\n";
		$str .= "Total number of oranges: $next_orange\n";
		$str .= "Total number of bananas: $next_banana";
        
        //writing to file
		fwrite($file, $str);
        
        //closing the file
		fclose($file);
	?>
        <!--Table for receipt-->
        <table border="border">
            <caption>
                <b>
				<p>Receipt for <?php print $name; ?></p>
				<p>Paid using <?php print $pmt; ?></p>
			</b>
            </caption>
            <br>
            <tr>
                <th></th>
                <th>Quantity</th>
                <th>Cost</th>
            </tr>
            <tr>
                <th>Apples</th>
                <td>
                    <?php print ("$apple"); ?>
                </td>
                <td>
                    <?php print (($apple * 69.0)/100.0); ?>
                </td>
            </tr>
            <tr>
                <th>Oranges</th>
                <td>
                    <?php print ("$orange"); ?>
                </td>
                <td>
                    <?php print (($orange * 59.0)/100.0); ?>
                </td>
            </tr>
            <tr>
                <th>Bananas</th>
                <td>
                    <?php print ("$banana"); ?>
                </td>
                <td>
                    <?php print (($banana * 39.0)/100.0); ?>
                </td>
            </tr>
            <tr>
                <th colspan=2>Total</th>
                <td>
                    <?php print ("$total"); ?>
                </td>
            </tr>
        </table>

</body>

</html>