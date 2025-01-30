<?php include("../inc/include_header.php");?>
<main class="container mt-5 maincontent">
		<div class="row justify-content-center gapAboveLarge">
			<div class="col-sm-12 col-md-8">
				<div class="extra-info-bar fixed-top">	
					<h1 class="clr1 pt-5">ಸಂಗ್ರಹ &gt; ಸಂಪುಟಗಳು</h1>
<?php include("include_secondary_nav.php");?>
				</div>		
			</div>
		</div>
		<div class="row justify-content-center volumes gapAboveLarge">		
<?php

include("connect.php");
require_once("common.php");

$query = 'select distinct volume from article order by volume';

$result = $db->query($query); 
$num_rows = $result ? $result->num_rows : 0;

$row_count = 10;
$count = 0;
$col = 1;

if($num_rows > 0)
{
	while($row = $result->fetch_assoc())
	{

		$yearString = getYear($row['volume']);

		echo '<div class="card shadow col-sm-4 col-md-1">';
		echo '<a href="get-parts.php?volume=' . $row['volume'] . '"><img src="img/covers/v/' . $row['volume'] . '.jpg" class="img-fluid" alt="volume '. toKannada(intval($row['volume'])) .'" /></a>';
		echo '<div class="card-body">';
		
		if($yearString)	
			echo '<a href="get-parts.php?volume=' . $row['volume'] . '">ಸಂಪುಟ '. toKannada(intval($row['volume'])) .'<br /><span class="small align-middle badge d-inline text-bg-warning">('. toKannada($yearString) .')</span></a>';
		else
			echo '<a href="get-parts.php?volume=' . $row['volume'] . '">ಸಂಪುಟ '. toKannada(intval($row['volume'])) .'</a>';

		echo '</div>';
		echo '</div>';

	}
}

if($result){$result->free();}
$db->close();

?>
		</div> 
	</main> 
<?php include("../inc/include_footer.php");?>
