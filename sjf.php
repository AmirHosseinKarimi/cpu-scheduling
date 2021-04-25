<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="lib/response.css" />
		<link rel="stylesheet" type="text/css" href="lib/sjf.css" />
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
$TMPPRO=array();


////////////////////////////////////////////////
////////////	Get First Proccess 	///////////
//////////////////////////////////////////////

$C_MIN=999999999;
$TMPPRO[1]=1;

FOR($i=1;$i<=$_GET['count'];$i++)
{
	IF( ISSET($_GET['PC_'.$i]) && $C_MIN>$_GET['PC_'.$i] )
	{
		$C_MIN=$_GET['PC_'.$i];
		$TMPPRO[1]=$i;
	}
	ELSEIF( ISSET($_GET['PC_'.$i]) && $C_MIN==$_GET['PC_'.$i] )
	{
		$TMPPRO[]=$i;
	}
}

IF( count($TMPPRO)>1 )
{
	$B_MIN=999999999;
	
	FOR($i=1;$i<=count($TMPPRO);$i++)
	{
		IF( $B_MIN>$_GET['PB_'.$TMPPRO[$i]] )
		{
			$B_MIN=$_GET['PB_'.$TMPPRO[$i]];
			$WIN=$TMPPRO[$i];
		}
	}
	
	// SET PROCCESS TO SORT ARRAY AND REMOVE
	$arr[]=$WIN;
	$PC[$WIN]=$_GET['PC_'.$WIN];
	unset($_GET['PC_'.$WIN]);	
	
}
ELSE
{
	// SET PROCCESS TO SORT ARRAY AND REMOVE
	$arr[]=$TMPPRO[1];
	$PC[$TMPPRO[1]]=$_GET['PC_'.$TMPPRO[1]];
	unset($_GET['PC_'.$TMPPRO[1]]);
}


$NW=$PC[$arr[0]]+$_GET['PB_'.$arr[0]];

//echo $NW."<br>";

////////////////////////////////////////////////
////////////	Arrange Processes 	///////////
//////////////////////////////////////////////

FOR($h=1;$h<=$_GET['count'];$h++)
{
	// Regenerate Array
	unset($TMPPRO);
	$TMPPRO = Array();
	// GET ALL READY PROCCESS
	FOR($i=1;$i<=$_GET['count'];$i++)
	{
		IF( ISSET($_GET['PC_'.$i]) && $_GET['PC_'.$i]<=$NW )
		{
			$TMPPRO[]=$i;
		}
	}

	// SORT PROCCESS IF NOT ALONE
	IF( count($TMPPRO)>1 )
	{
		//echo 'Multi => ';
		$B_MIN=999999999;

		FOR($i=0;$i<count($TMPPRO);$i++)
		{
			IF( $_GET['PB_'.$TMPPRO[$i]]<$B_MIN )
			{
				$B_MIN=$_GET['PB_'.$TMPPRO[$i]];
				$WIN=$TMPPRO[$i];
			}
		}
		
		// SET PROCCESS TO SORT ARRAY AND REMOVE
		$arr[]=$WIN;
		$PC[$WIN]=$_GET['PC_'.$WIN];
		unset($_GET['PC_'.$WIN]);
	}
	ELSEIF( count($TMPPRO)==1 )
	{
		//echo 'Single => ';
		// SET PROCCESS TO SORT ARRAY AND REMOVE
		$arr[]=$TMPPRO[0];
		$PC[$TMPPRO[0]]=$_GET['PC_'.$TMPPRO[0]];
		unset($_GET['PC_'.$TMPPRO[0]]);
	}
	ELSE
	{
		//echo 'Else => ';
		// GET NEXT PROSSECCES
		$C_MIN=999999999;
		// Regenerate Array
		unset($TMPPRO);
		$TMPPRO = Array();

		FOR($i=1;$i<=$_GET['count'];$i++)
		{
			IF( ISSET($_GET['PC_'.$i]) && $C_MIN>$_GET['PC_'.$i] )
			{
				$C_MIN=$_GET['PC_'.$i];
				$TMPPRO[1]=$i;
			}
			ELSEIF( ISSET($_GET['PC_'.$i]) && $C_MIN==$_GET['PC_'.$i] )
			{
				$TMPPRO[]=$i;
			}
		}
		
		IF( count($TMPPRO)>1 )
		{
			$B_MIN=999999999;
			
			FOR($i=1;$i<=count($TMPPRO);$i++)
			{
				IF( $B_MIN>$_GET['PB_'.$TMPPRO[$i]] )
				{
					$B_MIN=$_GET['PB_'.$TMPPRO[$i]];
					$WIN=$TMPPRO[$i];
				}
			}
			
			// SET NOW TIME
			$NW=$_GET['PC_'.$WIN];
			// SET PROCCESS TO SORT ARRAY AND REMOVE
			$arr[]=$WIN;
			$PC[$WIN]=$_GET['PC_'.$WIN];
			unset($_GET['PC_'.$WIN]);
			
		}
		ELSEIF(  count($TMPPRO)==1  )
		{
			// SET NOW TIME
			$NW=$_GET['PC_'.$TMPPRO[1]];
			// SET PROCCESS TO SORT ARRAY AND REMOVE
			$arr[]=$TMPPRO[1];
			$PC[$TMPPRO[1]]=$_GET['PC_'.$TMPPRO[1]];
			unset($_GET['PC_'.$TMPPRO[1]]);
		}
		
		
	}
	
	$CNNT=(count($arr))-1;
	// NOW TIME
	$NW=$NW+$_GET['PB_'.$arr[$CNNT]];	
	//echo $NW.' = '.count($TMPPRO).'<br>';
	
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
			<div class="header"><label id="lbl_key_back" onclick="history.back();"><span></span></label>الگوریتم زمانبندی SJF پردازشگر به زبان PHP</div>
			<div class="footer">طراحی و برنامه نویسی توسط امیر حسین حسین زاده کریمی</div>
	</div>

		</div>
		<div class="main_logo" align="center">
			<img src="lib/SJF.png" />
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