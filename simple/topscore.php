<?php

function foosBallScoreBoard($filename)
{
	$handle = fopen($filename, "r");
	$row = 0;
	$results = array();

	if ($handle) {
	    while (($row = fgetcsv($handle)) !== false) {
	    	if (empty($fields)) 
	        {
	            $fields = $row;
	            continue;
	        }

	        if(count($row) != 4) {
	        	echo "Error: provided data missing either score value or persons name";
	        	continue;
	        }
	        for ($i=0; $i<4;$i+=2) 
	        {
	        	if(array_key_exists($row[$i], $results)){
	        		$val = $results[$row[$i]];
	        		$results[$row[$i]] =  $val + $row[$i+1] ;
	        	} else {
	        		$results[$row[$i]] = $row[$i+1] ;
	        	}
	        }
	        unset($row);
	    }
	    if (!feof($handle)) 
	    {
	        echo "Error: unexpected fgetcsv() failn";
	    }
	    fclose($handle);
	}

	return $results;
}
function printTopContestants($csvArray)
{
	$topContestant = array();
	$max=0;
	foreach ($csvArray as $key=>$val)
	{
	    if($val>$max){
	    	$topContestant[$key] = $val;
	    	$max = $val;
	    }
	}

	echo "Top Contestants are: "."\n";
	echo str_pad("Name",20," ") . "|" .  str_pad("Score",10," ") . "\n";
	echo str_pad("",31,"-") . "\n";
	foreach($topContestant as $topCon => $topScore){
		echo str_pad($topCon,20," ") . "|" . str_pad($topScore,10," ") . "\n";
	}
}
$filename = "texttt.csv";
$csvArray = foosBallScoreBoard($filename);
printTopContestants($csvArray);

?>
