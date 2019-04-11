<?php

    $from = date('2018-01-01');
    $to = date('2018-05-02');
    Reservation::whereBetween('reservation_from', [$from, $to])->get();

    $reservations = Reservation::whereBetween('reservation_from', array($from, $to))->get();

    $now = date('Y-m-d');
    $reservations = Reservation::where('reservation_from', '>=', $now)
        ->where('reservation_from', '<=', $to)
        ->get();

    $list=  (new LeaveApplication())->whereDate('from','<=', $today)->whereDate('to','>=', $today)->get();

    public function current(){
        $from = date('Y-m-d' . ' 00:00:00', time()); //need a space after dates.
        $to = date('Y-m-d' . ' 24:60:60', time());

        $current = Connection::where('user_id',$this->user_id)
            ->where('status','active')->whereBetween('created_at', array($from, $to))
            ->first();

        return $current;
    }

?>