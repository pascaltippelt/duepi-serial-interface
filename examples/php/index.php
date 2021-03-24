<?php

include 'pelletstove.php';
$aStove = new cStove;

$setPower = $_GET['setPower'];
$setTemperature = $_GET['setTemp'];

if (!($setPower === NULL)) {	
	$aStove->setPowerState($setPower);
}

if (!($setTemperature === NULL)) {
	$aStove->setTargetTemperature($setTemperature);
}
$stoveState = $aStove->getState();
$targetTemperature = $aStove->getTargetTemp();

?>

<head>

<title>Duepi-Pelletstove-Interface</title>
</head>

<body>

<h1>Duepi-Pelletstove-Interface</h1>
<h2>Actions</h2>
	<form>
    	<select name="setPower" style="width:50px">
        <?php
			if (($stoveState == 1) or ($stoveState == 3)) {
				echo "<option value=\"0\">Off</option>
					  <option value=\"1\">On 1</option>
            		  <option value=\"2\">On 2</option>
            		  <option value=\"3\">On 3</option>
            		  <option value=\"4\">On 4</option>
            		  <option value=\"5\">On 5</option>";
			}
			if (($stoveState == 0) or ($stoveState == 3)) {
				echo "<option value=\"1\">On 1</option>
            		  <option value=\"2\">On 2</option>
            		  <option value=\"3\">On 3</option>
            		  <option value=\"4\">On 4</option>
            		  <option value=\"5\">On 5</option>";
			}
		?>                    
        </select>
        <input type="submit" name="button_power" value="Send">
	</form>
    <form>
    	<select name="setTemp" style="width:50px">
        <?php
			for ($i = 10; $i <= 40; $i++) {
				if ($i == $targetTemperature) {
					echo "<option value=\"" . $i . "\" selected>" . $i ."°C</option>";
				} else {
					echo "<option value=\"" . $i . "\">" . $i ."°C</option>";
				}
			}
        ?>
        </select>    
        <input type="submit" name="button_temp" value="Send">
    </form>
<p>Currently the stove has the state "<?php echo $aStove->stove_states[$stoveState]; ?>&quot;. The ambient temperature is <?php echo $aStove->getAmbientTemp()?>. Target temperature is <?php echo $targetTemperature?>.</p>

</body>
</html>