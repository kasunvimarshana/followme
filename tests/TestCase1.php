<?php

is_bool($variable);
    
public function muFunction(Request $request){
    Request::filled('field_name');
    Request::has('field_name');
    Request::exists('field_name');
    
    $name = $request->input('name');
    $uri = $request->path(); // http://domain.com/foo/bar => foo/bar
    if($request->is('admin/*')) {}
    // Without Query String...
    $url = $request->url();
    // With Query String...
    $url = $request->fullUrl();
    $method = $request->method();
    if($request->isMethod('post')) {}
    $name = $request->input('name', 'Sally');
    $name = $request->input('products.0.name');
    $names = $request->input('products.*.name');
    $name = $request->query('name');
    $name = $request->query('name', 'Helen');
    $input = $request->only(['username', 'password']);
    $input = $request->only('username', 'password');
    $input = $request->except(['credit_card']);
    $input = $request->except('credit_card');
    
    if($request->has('name')) {}
    if($request->filled('name')) {}
    
    /*
    count(array,mode);
    mode	Optional. Specifies the mode. Possible values:
    0 - Default. Does not count all elements of multidimensional arrays
    1 - Counts the array recursively (counts all the elements of multidimensional arrays)
    */
}

?>

<?php
$days = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
 
// Printing array size
echo 'Total number of elements in the $days array is - ' . count($days);
echo "<br>";
echo 'Total number of elements in the $days array is - ' . sizeof($days);
?>