<?php include("../inc/include_header.php");?>
<main class="container-fluid maincontent">
		<div class="row justify-content-center gapAboveLarge">
			<div class="col-sm-12 col-md-8">
<?php

include("connect.php");
require_once("common.php");

if(isset($_GET['vol'])){$volume = $_GET['vol'];}else{$volume = '';}
if(isset($_GET['part'])){$part = $_GET['part'];}else{$part = '';}

$dpart = preg_replace("/^0/", "", $part);
$dpart = preg_replace("/\-0/", "&ndash;", $dpart);

$yearMonth = getYearMonth($volume, $part);

$maasa = getmaasa($volume, $part);
$info = '';

if($yearMonth['month'] != '')
{
	$info = $info . getMonth($yearMonth['month']);
}
if($yearMonth['year'] != '')
{
	$info = $info . ' <span class="font_size">' . toKannada(intval($yearMonth['year'])) . '</span>';
}
if($maasa['maasa'] != '')
{
	$info = $info . ', ' . $maasa['maasa'] . '&nbsp;ಮಾಸ';
}
if($maasa['samvatsara'] != '')
{
	$info = $info . ', ' . $maasa['samvatsara'] . '&nbsp;ಸಂವತ್ಸರ';
}
$info = preg_replace("/^,/", "", $info);
$info = preg_replace("/^ /", "", $info);


echo '<div class="extra-info-bar fixed-top">';

if($part == '99')
{
	echo '<h1 class="clr1 pt-5">ಸಂಗ್ರಹ &gt; ವಿಶೇಷ ಸಂಚಿಕೆ' . ' (Volume ' . toKannada(intval($volume)) . ')</h1>';
}
else
{
	echo '<h1 class="clr1 pt-5">ಸಂಗ್ರಹ &gt; ಸಂಪುಟ ' . toKannada(intval($volume)) . ', ಸಂಚಿಕೆ '. toKannada($dpart) . '</h1>';
	echo '<p class="small clr2"> (' . $info . ')</p>';
}

include("include_secondary_nav.php");
echo '</div>';
echo '</div>';

if(!(isValidVolume($volume) && isValidPart($part)))
{
	echo '<div class="col-sm-12 col-md-8">';
	echo '<p class="aFeature clr2 text-center gapAboveLarge">Invalid URL</p>';
	echo '</div>';
	echo '</div>';
	echo '</main>';
	include("include_footer.php");

    exit(1);
}

$query = 'select * from article where volume=\'' . $volume . '\' and part=\'' . $part . '\'';

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;
//mysql_set_charset("utf8");

if($num_rows > 0)
{
	echo '<div class="col-sm-12 col-md-8 gapAboveLarge">';

	while($row = $result->fetch_assoc())
	{
		$query3 = 'select feat_name from feature where featid=\'' . $row['featid'] . '\'';
		$result3 = $db->query($query3); 
		$row3 = $result3->fetch_assoc();		
		
		$dpart = preg_replace("/^0/", "", $row['part']);
		$dpart = preg_replace("/\-0/", "-", $dpart);
		$sumne = preg_split('/-/' , $row['page']);
		$row['page'] = $sumne[0];
		if($result3){$result3->free();}

		echo '<div class="article">';
		echo ($row3['feat_name'] != '') ? '<div class="gapBelowSmall"><span class="aFeature clr2"><a href="feat.php?feature=' . urlencode($row3['feat_name']) . '&amp;featid=' . $row['featid'] . '">' . $row3['feat_name'] . '</a></span></div>' : '';
		$part = ($row['part'] == '99') ? 'SpecialIssue' : $row['part'];
		echo '	<span class="aTitle"><a target="_blank" href="bookreader/templates/book.php?volume=' . $row['volume'] . '&part=' . $part . '&page=' . $row['page'] . '">' . $row['title'] . '</a></span><br />';
		if($row['authid'] != 0) {

			echo '	<span class="aAuthor itl">&mdash; ';
			$authids = preg_split('/;/',$row['authid']);
			$authornames = preg_split('/;/',$row['authorname']);
			$a=0;
			foreach ($authids as $aid) {

				echo '<a href="auth.php?authid=' . $aid . '&amp;author=' . urlencode($authornames[$a]) . '">' . $authornames[$a] . '</a> ';
				$a++;
			}
			
			echo '	</span><br/>';
		}
		echo '</div>';
	}
}

if($result){$result->free();}
$db->close();

?>
			</div> 
		</div> 
	</main> 
<?php include("../inc/include_footer.php");?>
