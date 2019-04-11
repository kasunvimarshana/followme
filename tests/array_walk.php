<?php 

/** 
* Zip together the keys and values of an array using the provided glue 
* 
* The values of the array are replaced with the new computed value 
* 
* @param array $data 
* @param string $glue 
*/ 
function zip(&$data, $glue=': ') 
{ 
    if(!is_array($data)) { 
        throw new InvalidArgumentException('First parameter must be an array'); 
    } 

    array_walk($data, function(&$value, $key, $joinUsing) { 
        $value = $key . $joinUsing . $value; 
    }, $glue); 
} 

$myName = 'Matthew Purdon'; 
$myEmail = 'matthew@example.com'; 
$from = "$myName <$myEmail>"; 

$headers['From'] = $from; 
$headers['Reply-To'] = $from; 
$headers['Return-path'] = "<$myEmail>"; 
$headers['X-Mailer'] = "PHP" . phpversion() . ""; 
$headers['Content-Type'] = 'text/plain; charset="UTF-8"'; 

zip($headers); 

$headers = implode("\n", $headers); 
$headers .= "\n"; 

echo $headers; 

/* 
From: Matthew Purdon <matthew@example.com> 
Reply-To: Matthew Purdon <matthew@example.com> 
Return-path: <matthew@example.com> 
X-Mailer: PHP5.3.2 
Content-Type: text/plain; charset="UTF-8" 
*/ 
?>