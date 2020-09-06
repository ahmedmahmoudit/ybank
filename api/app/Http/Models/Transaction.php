<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'form', 'to', 'details', 'amount'
    ];

    public static function accountList($accountId)
    {
        $account = DB::table( 'transactions' )
            ->whereRaw( "`from`=? OR `to`=?" , [$accountId, $accountId])
            ->get();

        return $account;
    }
}
