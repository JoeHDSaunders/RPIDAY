<?php
	ini_set('display_errors',1);
	error_reporting(-1);
	ob_start();
	
	$UID = $_GET["uid"];
	
	header("Content-type: text/xml; charset=utf-8");

	echo "<messagesAmount>";
	
	$conf = parse_ini_file("../rpidayconfig.ini");
	
	$conn = mysqli_connect($conf["host"], $conf["user"], $conf["password"], $conf["database"]);

	if(! $conn ){
		mysqli_close($conn);
		die("<error>503</error></messagesAmount>");
	}
	
				
	$checkUserIDQuery = "SELECT COUNT(1) FROM USERS WHERE ID=?";
	$getUserIDCheck = mysqli_prepare($conn, $checkUserIDQuery);
	$getUserIDCheck->bind_param('s', $UID);
	$getUserIDCheck->execute();
	$getUserIDCheck->store_result();
	$getUserIDCheck->bind_result($RESULT);
	$getUserIDCheck->fetch();
	$getUserIDCheck->close();
	
	if($RESULT){
		//WID IS THE WEATHER ID
		$getUserDataQuery = $conf["getUserDataQuery"];
		$getUserData = mysqli_prepare($conn, $getUserDataQuery);
		$getUserData->bind_param('s', $UID);
		$getUserData->execute();
		$getUserData->store_result();
		$getUserData->bind_result($FORENAME, $SURNAME, $PRI_COLOR, $SEC_COLOR, $TRI_COLOUR, $TIMEZONE, $BIRTHDAY, $WID, $WIND_UNIT, $TEMP_UNIT, $FONT_SIZE, $FONT_TYPE, $ALARM_LENGTH, $ALARM_SOUND, $TIME_DATE_FORMAT);
		$getUserData->fetch();
		$getUserData->close();
		
		echo "<userData>";
		echo "<forename>" . $FORENAME . "</forename>";
		echo "<surname>" . $SURNAME . "</surname>";
		echo "<pri_color>" . $PRI_COLOR . "</pri_color>";
		echo "<sec_color>" . $SEC_COLOR . "</sec_color>";
		echo "<tri_colour>" . $TRI_COLOUR . "</tri_colour>";
		echo "<timezone>" . $TIMEZONE . "</timezone>";
		echo "<birthday>" . $BIRTHDAY . "</birthday>";
		echo "<wid>" . $WID . "</wid>";
		echo "<wind_unit>" . $WIND_UNIT . "</wind_unit>";
		echo "<temp_unit>" . $TEMP_UNIT . "</temp_unit>";
		echo "<font_size>" . $FONT_SIZE . "</font_size>";
		echo "<font_type>" . $FONT_TYPE . "</font_type>";
		echo "<alarm_length>" . $ALARM_LENGTH . "</alarm_length>";
		echo "<alarm_sound>" . $ALARM_SOUND . "</alarm_sound>";
		echo "<time_date_format>" . $TIME_DATE_FORMAT . "</time_date_format>";
		echo "</userData>";
	}else{
		die("<error>404</error></messagesAmount>");
	}
	
	mysqli_close($conn);	
	echo"<error>200</error>";
	echo"</messagesAmount>";
	
?>