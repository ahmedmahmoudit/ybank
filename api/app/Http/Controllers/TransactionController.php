<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller {

    public function list( $accountId )
    {
        return Transaction::accountList($accountId);
    }

    public function store( TransactionRequest $request, $accountId )
    {
        $attributes = $request->only( 'to', 'amount', 'details' );

        $accountFrom = Account::find($accountId);

        if ( $attributes['amount'] > $accountFrom->first()->balance )
        {
            abort( 403 );
        }

        $data = [
            'from'    => $accountId,
            'to'      => $attributes['to'],
            'amount'  => $attributes['amount'],
            'details' => $attributes['details']
        ];

        try{

            DB::table( 'transactions' )->insert( $data );
            Account::updateBalance($accountId, $attributes['amount'], '-');
            Account::updateBalance($attributes['to'], $attributes['amount']);

            return \Response::json( $data, 201 );

        } catch (\Exception $e){

            return \Response::json( $e, 500 );
        }
    }
}
