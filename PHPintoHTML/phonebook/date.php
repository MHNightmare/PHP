<?php
			$tarikh =  date("y/m/d");
			include("jdf.php");
			$time = explode("/" , $tarikh);
			$date = gregorian_to_jalali("20".$time["0"],$time["1"],$time["2"],' / ');
?>
