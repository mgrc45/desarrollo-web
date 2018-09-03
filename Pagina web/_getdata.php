<?php
/*
 * FCKeditor - The text editor for Internet - http://www.fckeditor.net
 * Copyright (C) 2003-2010 Frederico Caldeira Knabben
 *
 * == BEGIN LICENSE ==
 *
 * Licensed under the terms of any of the following licenses at your
 * choice:
 *
 *  - GNU General Public License Version 2 or later (the "GPL")
 *    http://www.gnu.org/licenses/gpl.html
 *
 *  - GNU Lesser General Public License Version 2.1 or later (the "LGPL")
 *    http://www.gnu.org/licenses/lgpl.html
 *
 *  - Mozilla Public License Version 1.1 or later (the "MPL")
 *    http://www.mozilla.org/MPL/MPL-1.1.html
 *
 * == END LICENSE ==
 *
 * This page lists the data posted by a form.
 */
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
	<head>
		<title>Get Data</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="robots" content="noindex, nofollow">
	</head>
	<body style="font-family:Arial, Helvetica, sans-serif">
		<h1>All data Get by the form</h1>
		
		<table border="1" cellspacing="0" id="outputSample">
			<colgroup><col width="210"><col></colgroup>
			<thead>
				<tr>
					<th>Field Name</th>
					<th>Value</th>
				</tr>
			</thead>
<?php

if ( isset( $_GET ) ) $postArray = &$_GET ; //4.1.0 or later, use $_GET
else $postArray = &$HTTP_GET_VARS  ; //prior to 4.1.0, use HTTP_GET_VARS 

foreach ( $postArray as $sForm => $value )
{
	if ( get_magic_quotes_gpc() )
		$postedValue = htmlspecialchars( stripslashes( $value ) ) ;
	else
		$postedValue = htmlspecialchars( $value ) ;

	echo "<tr>";
	echo "<th>".htmlspecialchars($sForm)."</th>";
	echo "<td><pre>";
	if (is_array($value) == false) 
		echo $postedValue; 
	else
		{
		$stringTmp = (string)"";
		foreach ($value as $value1) $stringTmp .= "$value1,";
		echo substr($stringTmp,0,-1);
		}
	echo "</pre></td>";
	echo "</tr>";
}
?>
		</table>
	</body>
</html>
