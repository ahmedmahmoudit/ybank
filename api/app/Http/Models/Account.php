<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Account extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'balance'
    ];

    public static function find($id)
    {
        $account = DB::table('accounts')
                    ->whereRaw("id=:id")
                    ->setBindings(['id' => $id])
                    ->get();

        return $account;
    }

    public static function updateBalance($id, $amount, $amountStatus = '+')
    {
        return DB::table( 'accounts' )
            ->whereRaw( "id=:id" )
            ->setBindings(['id' => $id])
            ->update( ['balance' => DB::raw( 'balance'.$amountStatus. $amount )] );
    }



}
