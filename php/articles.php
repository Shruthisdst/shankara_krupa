<?php include("../inc/include_header.php");?>
<main class="container-fluid maincontent" data-bs-theme="dark">
		<div class="row justify-content-center gapAboveLarge">
			<div class="col-sm-12 col-md-8">
				<div class="extra-info-bar fixed-top">	
					<h1 class="clr1 pt-5">ಸಂಗ್ರಹ &gt; ಲೇಖನಗಳು</h1>
					<div class="alphabet mt-2">
						<span class="letter"><a href="articles.php?letter=ಅ">ಅ</a></span>
						<span class="letter"><a href="articles.php?letter=ಆ">ಆ</a></span>
						<span class="letter"><a href="articles.php?letter=ಇ">ಇ</a></span>
						<span class="letter"><a href="articles.php?letter=ಈ">ಈ</a></span>
						<span class="letter"><a href="articles.php?letter=ಉ">ಉ</a></span>
						<span class="letter"><a href="articles.php?letter=ಊ">ಊ</a></span>
						<span class="letter"><a href="articles.php?letter=ಋ">ಋ</a></span>
						<span class="letter"><a href="articles.php?letter=ಎ">ಎ</a></span>
						<span class="letter"><a href="articles.php?letter=ಏ">ಏ</a></span>
						<span class="letter"><a href="articles.php?letter=ಐ">ಐ</a></span>
						<span class="letter"><a href="articles.php?letter=ಒ">ಒ</a></span>
						<span class="letter"><a href="articles.php?letter=ಓ">ಓ</a></span>
						<span class="letter"><a href="articles.php?letter=ಔ">ಔ</a></span>
						<span class="letter"><a href="articles.php?letter=ಕ">ಕ</a></span>
						<span class="letter"><a href="articles.php?letter=ಖ">ಖ</a></span>
						<span class="letter"><a href="articles.php?letter=ಗ">ಗ</a></span>
						<span class="letter"><a href="articles.php?letter=ಘ">ಘ</a></span>
						<span class="letter"><a href="articles.php?letter=ಚ">ಚ</a></span>
						<span class="letter"><a href="articles.php?letter=ಛ">ಛ</a></span>
						<span class="letter"><a href="articles.php?letter=ಜ">ಜ</a></span>
						<span class="letter"><a href="articles.php?letter=ಝ">ಝ</a></span>
						<span class="letter"><a href="articles.php?letter=ಟ">ಟ</a></span>
						<span class="letter"><a href="articles.php?letter=ಠ">ಠ</a></span>
						<span class="letter"><a href="articles.php?letter=ಡ">ಡ</a></span>
						<span class="letter"><a href="articles.php?letter=ಢ">ಢ</a></span>
						<span class="letter"><a href="articles.php?letter=ತ">ತ</a></span>
						<span class="letter"><a href="articles.php?letter=ಥ">ಥ</a></span>
						<span class="letter"><a href="articles.php?letter=ದ">ದ</a></span>
						<span class="letter"><a href="articles.php?letter=ಧ">ಧ</a></span>
						<span class="letter"><a href="articles.php?letter=ನ">ನ</a></span>
						<span class="letter"><a href="articles.php?letter=ಪ">ಪ</a></span>
						<span class="letter"><a href="articles.php?letter=ಫ">ಫ</a></span>
						<span class="letter"><a href="articles.php?letter=ಬ">ಬ</a></span>
						<span class="letter"><a href="articles.php?letter=ಭ">ಭ</a></span>
						<span class="letter"><a href="articles.php?letter=ಮ">ಮ</a></span>
						<span class="letter"><a href="articles.php?letter=ಯ">ಯ</a></span>
						<span class="letter"><a href="articles.php?letter=ರ">ರ</a></span>
						<span class="letter"><a href="articles.php?letter=ಲ">ಲ</a></span>
						<span class="letter"><a href="articles.php?letter=ವ">ವ</a></span>
						<span class="letter"><a href="articles.php?letter=ಶ">ಶ</a></span>
						<span class="letter"><a href="articles.php?letter=ಷ">ಷ</a></span>
						<span class="letter"><a href="articles.php?letter=ಸ">ಸ</a></span>
						<span class="letter"><a href="articles.php?letter=ಹ">ಹ</a></span>
						<span class="letter"><a href="articles.php?letter=ಳ">ಳ</a></span>
						<span class="letter"><a href="articles.php?letter=other">#</a></span>
					</div>
<?php include("include_secondary_nav.php");?>
				</div>
			</div>
			<div class="col-sm-12 col-md-8 gapAbove gapBelowLargeSpecial">
				<p class="mb-sm-5">&nbsp;</p>
			</div>
			<div class="col-sm-12 col-md-8">		
<?php

include("connect.php");
require_once("common.php");

if(isset($_GET['letter']))
{
	$letter=$_GET['letter'];
	
	if(!(isValidLetter($letter)))
	{
		echo '<p class="aFeature clr2 mt-5 text-center">Invalid URL</p>';
		echo '</div>';
		echo '</div>';
		echo '</main>';
		include("include_footer.php");

        exit(1);
	}
	
	($letter == '') ? $letter = 'ಅ' : $letter = $letter;
}
else
{
	$letter = 'ಅ';
}
if($letter == 'other')
{
	$query = "SELECT * FROM article WHERE title REGEXP '^[A-Za-z]'";
}
else
{
	$query = "select * from article where title like '$letter%' union select * from article where title like '\"$letter%' union select * from article where title like '\'$letter%' order by TRIM(BOTH '\'' FROM TRIM(BOTH '\"' FROM title))";
}

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

if($num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{
		$query3 = 'select feat_name from feature where featid=\'' . $row['featid'] . '\'';
		$result3 = $db->query($query3); 
		$row3 = $result3->fetch_assoc();
		
		$dpart = preg_replace("/^0/", "", $row['part']);
		$dpart = preg_replace("/\-0/", "-", $dpart);
		$info = '';
		if($row['month'] != '')
		{
			$info = $info . getMonth($row['month']);
		}
		if($row['year'] != '')
		{
			$info = $info . ' <span class="font_size">' . toKannada(intval($row['year'])) . '</span>';
		}
		if($row['maasa'] != '')
		{
			$info = $info . ', ' . $row['maasa'] . '&nbsp;ಮಾಸ';
		}
		if($row['samvatsara'] != '')
		{
			$info = $info . ', ' . $row['samvatsara'] . '&nbsp;ಸಂವತ್ಸರ';
		}
		$info = preg_replace("/^,/", "", $info);
		$info = preg_replace("/^ /", "", $info);

		$sumne = preg_split('/-/' , $row['page']);
		$row['page'] = $sumne[0];

		if($result3){$result3->free();}

		echo '<div class="article">';
		echo '	<div class="gapBelowSmall">';
		echo ($row3['feat_name'] != '') ? '<span class="aFeature clr2"><a href="feat.php?feature=' . urlencode($row3['feat_name']) . '&amp;featid=' . $row['featid'] . '">' . $row3['feat_name'] . '</a></span> | ' : '';
		echo '<span class="aIssue clr5"><a href="toc.php?vol=' . $row['volume'] . '&amp;part=' . $row['part'] . '">';
		echo ($row['part'] == '99') ? 'ಸಂಪುಟ ' . toKannada(intval($row['volume'])) . ', ವಿಶೇಷ ಸಂಚಿಕೆ' : '  ಸಂಪುಟ ' . toKannada(intval($row['volume'])) . ', ಸಂಚಿಕೆ ' . toKannada($dpart);
		echo  ' <span class="font_resize">(' . $info . ')</span>' .'</a></span>';
		echo '</div>';
		$part = ($row['part'] == '99') ? 'ವಿಶೇಷ ಸಂಚಿಕೆ' : $row['part'];
		echo '	<span class="aTitle"><a target="_blank" href="bookreader/templates/book.php?volume=' . $row['volume'] . '&part=' . $part . '&page=' . $row['page'] . '">' . $row['title'] . '</a></span><br />';
		if($row['authid'] != 0) {

			echo '<span class="aAuthor itl">&mdash; ';
			$authids = preg_split('/;/',$row['authid']);
			$authornames = preg_split('/;/',$row['authorname']);
			$a=0;
			foreach ($authids as $aid) {

				echo '<a href="auth.php?authid=' . $aid . '&amp;author=' . urlencode($authornames[$a]) . '">' . $authornames[$a] . '</a> ';
				$a++;
			}
			
			echo '</span><br/>';
		}
		echo '</div>';
	}
}
else
{
	echo '<p class="clr2 sml mt-5 text-center">ಇಲ್ಲಿ \'' . $letter . '\' ಅಕ್ಷರದಿಂದ ಪ್ರಾರಂಭವಾಗುವ ಲೇಖನಗಳಿಲ್ಲ</p>';
}

if($result){$result->free();}
$db->close();

?>
			</div> 
		</div> 
	</main> 
<?php include("../inc/include_footer.php");?>
