<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MpesaSdk\StkPush;
use Illuminate\Support\Facades\DB;


class ProcessorController extends Controller
{
    public function system_logs($userid, $action, $description){
        DB::table('system_logs')->insert([
            'user_id' => $userid,
            'action' => $action,
            'description' => $description,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
