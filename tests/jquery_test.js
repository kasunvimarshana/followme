if (typeof $("#dataTable").data('timer') !== 'undefined'){
    // your code here
}

if( $("#dataTable").data().hasOwnProperty("timer") ){
     // the data-time property exists, now do you business! .....
 }
 
 jQuery.hasData( p )
 
const object1 = new Object();
object1.property1 = 42;
console.log(object1.hasOwnProperty('property1'));
// expected output: true
console.log(object1.hasOwnProperty('toString'));
// expected output: false
console.log(object1.hasOwnProperty('hasOwnProperty'));
// expected output: false

//convert jquery object to html (string)
//console.log($('#id').html());
//console.log($('#id').prop('outerHTML'));
