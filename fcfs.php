<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="lib/response.css" />
		<link rel="stylesheet" type="text/css" href="lib/fcfs.css" />
        <title>الگوریتم های زمان بندی پردازشگر به زبان PHP</title>
		
		<script type="text/javascript" src="lib/jquery.min.js"></script>
		<script type="text/javascript" src="lib/js.js"></script>
    </head>
    <body dir="rtl">
		<div class="response">
			<div class="chart" align="center">
<?php
//////////////////////////////////////////////////
////////////	Create Array	/////////////////
////////////////////////////////////////////////
$arr = array();
$PC = array();
$finish=array();

////////////////////////////////////////////////
////////////	Arrange Processes 	///////////
//////////////////////////////////////////////

FOR($j=1;$j<=$_GET['count'];$j++)
{

$max=999999999;

	FOR($i=1;$i<=$_GET['count'];$i++)
	{
		IF( ISSET($_GET['PC_'.$i]) && $max>$_GET['PC_'.$i] )
		{
			$max=$_GET['PC_'.$i];
			$cout=$i;
		}
	}
	
	
$arr[]=$cout;
$PC[$cout]=$_GET['PC_'.$cout];
unset($_GET['PC_'.$cout]);
	
}

/////////////////////////////////////////////////////
///////////////	Processes Chart	////////////////////
///////////////////////////////////////////////////

$time=0;
$sum_div=0;

$chart='';
$times='';

FOR($i=0,$c=1;$i<$_GET['count'];$i++)
{
	if($c>10){$c=1;}

	if( $PC[$arr[$i]]>$time )
	{
		$chart .= '<div class="c0">'.($PC[$arr[$i]]-$time).'</div>';
		$times .= '<div class="t">'.$time.'</div>';
		$time=$PC[$arr[$i]];
		$sum_div +=1;
	}
	
	$chart .= '<div class="c'.$c++.'">'.$_GET['PN_'.$arr[$i]].'</div>';
	$times .= '<div class="t">'.$time.'</div>';
	$time= $time + $_GET['PB_'.$arr[$i]];
	$sum_div +=1;
	$finish[]=$time;
	
}

$times .= '<div class="t">'.$time.'</div></div><br><br>';

echo $chart.'<br>'.$times;

///////////////////////////////////////////////////
/////////////	Processes Formula	///////////////
///////////////////////////////////////////////////

$response_math='';
$wait_math='';

$response=0;
$wait=0;

FOR($i=0;$i<$_GET['count'];$i++)
{

	// response //
	$response_math .= '('.$finish[$i].' - '.$PC[$arr[$i]].')';
	$response = $response + ($finish[$i] - $PC[$arr[$i]]);

	// waiting //
	$wait_math .= '('.$finish[$i].' - '.$PC[$arr[$i]].' - '.$_GET['PB_'.$arr[$i]].')';
	$wait = $wait + ($finish[$i] - $PC[$arr[$i]] - $_GET['PB_'.$arr[$i]]);
	
	
	IF( ($i+1)!=$_GET['count'] ){ $response_math .= ' + '; $wait_math .= ' + '; }
	
}



echo '<div align="center" class="math">
			<table>
					<tr>
						<td rowspan="2">میانگین زمان پاسخ:&nbsp;&nbsp;</td>
						<td style="border-bottom:1px solid #000;">'.$response_math.'</td>
						<td rowspan="2">='.($response/$_GET['count']).'</td>
					</tr>
					<tr>
						<td>'.$_GET['count'].'</td>
					</tr>
			 </table><br><br>
	 
	 
			<table>
					<tr>
						<td rowspan="2">میانگین زمان انتظار: &nbsp;&nbsp;</td>
						<td style="border-bottom:1px solid #000;">'.$wait_math.'</td>
						<td rowspan="2">='.($wait/$_GET['count']).'</td>
					</tr>
					<tr>
						<td>'.$_GET['count'].'</td>
					</tr>
			 </table>
	 
	 
	 </div>
	 <div class="logo" align="center">
			<img src="lib/logo.png" />
			<div class="header"><label id="lbl_key_back" onclick="history.back();"><span></span></label>الگوریتم زمانبندی FCFS پردازشگر به زبان PHP</div>
			<div class="footer">طراحی و برنامه نویسی توسط امیر حسین حسین زاده کریمی</div>
	</div>

		</div>
		<div class="main_logo" align="center">
			<img src="lib/FCFS.png" />
		</div>
    </body>
<style>
';

for($i=1;$i<=$sum_div;$i++)
{
	echo '	.chart div:nth-child('.$i.'){animation: '.$sum_div.'s linear '.($i-1).'s normal none infinite fade;}'."\n";
}

?>
</style>	

</html>