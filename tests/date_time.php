<?php

/*
$date = date_create('2019-04-15');
date_add($date, date_interval_create_from_date_string('40 days'));
echo date_format($date, 'Y-m-d');
*/

/*
$date = date('Y-m-j');
$newdate = strtotime('+2 month', strtotime($date));
$newdate = date('Y-m-j', $newdate);
echo $newdate;
*/

use Carbon\Carbon; //composer require nesbot/carbon

//{{  \Carbon\Carbon::parse($user->from_date)->format('d/m/Y') }}
$mutable = Carbon::now();
$immutable = CarbonImmutable::now();
$modifiedMutable = $mutable->add(1, 'day');
$modifiedImmutable = CarbonImmutable::now()->add(1, 'day');
echo Carbon::createFromFormat('Y-m-d H', '1975-05-21 22')->toDateTimeString();
$dt = Carbon::now();
$dt_copy = $dt->copy();

$dt = Carbon::now()->subMonths(3)->format('Y-m-d');
$dt = Carbon::now()->toDateString();

@push('js')
<script>
    $(function(){
        //guess user timezone
        $('#tz').val(moment.tz.guess());
        console.log( moment().add(5, 'M').format('YYYY-MM-DD') );
        console.log( moment().add(5, 'months').format('YYYY-MM-DD') );
    })
</script>
@endpush
    
public function someFunction(Request $request){
    $this->getTimezone($request);
    $ip = $this->getClientIp();
}

?>