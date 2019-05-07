<?php

///////////////////////////////////////
$a = ['name'=>'Gaurav','age'=>23] ;
$b = new ArrayObject($a) ;
$b['test'] = true ;
$c = $b->getArrayCopy() ;
echo "<pre>",var_dump($c),"</pre>" ;
///////////////////////////////////////
///////////////////////////////////////
$copy = create_function('$a', 'return $a;');
$_ARRAY2 = array_map($copy, $_ARRAY);
///////////////////////////////////////

?>