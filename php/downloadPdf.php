<?php

	exec('find ../ReadWrite/ -mmin +10 -type f -name "*.pdf" -exec rm {} \;');
	$downloadURL = '../index.php';
	$titleid = $_GET['titleid'];
	if(isset($_GET['titleid']) && $_GET['titleid'] != "")
	{
		include("connect.php");
		$vars = explode('_', $titleid);
		$volume = $vars[2];
		$part = $vars[3];
		$page = $vars[4];
		$page_end = $vars[5];
		$pdfList = '';
		$query1 = "select cur_page from ocr where volume = '$volume' and part = '$part' and cur_page between '$page' and '$page_end'";
		$result1 = $db->query($query1) or die("query problem"); 
		echo $query1;
		while($row = $result1->fetch_assoc())
		{
			$pdfList .= '../Volumes/pdf/' . $volume . '/' . $part . '/' . $row["cur_page"] . '.pdf ';
		}
		
		$downloadURL = '../ReadWrite/Shankara_Krupa_' . $volume . '_' . $part . '_' . $page . '-'.$page_end. '.pdf';
		system ('pdftk ' . $pdfList . ' cat output ' . $downloadURL);
		//~ echo 'pdftk ' . $pdfList . ' cat output ' . $downloadURL;
	}
	@header("Location: $downloadURL");
?>
