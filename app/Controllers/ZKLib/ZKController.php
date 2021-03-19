<?php


namespace App\Controllers\ZKLib;

use Illuminate\Support\Carbon;

class ZKController
{

    public static function createUser($uid, $userid, $name, $password = '')
    {
        $zk = new ZKLib('192.168.1.100');
        $zk->connect();
        $zk->setTime(Carbon::now()->timezone('GMT+8')->format('h:i'));
        $zk->setUser($uid, $userid, $name, $password);
        $zk->disconnect();
    }


    public static function getAttendance()
    {
        $zk = new ZKLib('192.168.1.100');
        $zk->connect();
        $zk->setTime(Carbon::now()->timezone('GMT+8')->format('h:i'));
        $attendance = $zk->getAttendance();
        $zk->disconnect();
        return $attendance;
    }
    public static function clearAttendance(){
        $zk = new ZKLib('192.168.1.100');
        $zk->connect();
        $zk->clearAttendance();
        $zk->disconnect();
    }
}