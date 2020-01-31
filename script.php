<?php

$filename = "spreadsheet.csv";
$csvArray = csvtoarray($filename, ";", true);
    
/* 

String $filename (REQUIRED) is the path to the csv file
String $separator (OPTIONAL) is the separator, default is ","
Bool $hasheaders (OPTIONAL) defines whether or not the csv has headers to form an associative array, default is false

*/

function csvtoarray($filename, $separator = ",", $hasheaders = false)
{
    $row = 0;
    $i = 0;
    $results = array();
    
    $handle = @fopen($filename, "r");
    
    if ($handle) 
    {
        while (($row = fgetcsv($handle, 4096)) !== false) 
        {

            foreach ($row as $string)
            {
                $stringarray = explode($separator, $string);
                
                if ($i == 0 && $hasheaders == true)
                {
                    $headers = $stringarray;
                    $nbheaders = count($headers);
                    
                } else {
                    
                    if ($hasheaders == true)
                    {
                        
                        $y = $i - 1;

                    } else {
                        
                       $y = $i;
                        
                    }
                    
                    
                    foreach ($stringarray as $k=>$val) {
                        
                        if(isset($headers[$k])) {
                            
                           $results[$y][$headers[$k]] = $val;
                            
                        }
                        
                        else {
                            
                            $results[$y][$k] = $val;
                            
                        }
                        
                    }
                        
                }
                
            }
            
            $i++;
        }
        if (!feof($handle)) 
        {
            echo "Error: unexpected fgets() failn";
        }
        fclose($handle);
    }
    
    print_r($results);
    
    return $results;
}
