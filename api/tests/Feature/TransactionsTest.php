<?php

namespace Tests\Feature;

use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_make_successful_transaction()
    {

        //Prepare data
        $accountFrom = factory(Account::class)->create([
            'balance' => 200,
        ]);
        $accountTo = factory(Account::class)->create();

        $data = [
            'to' => $accountTo->id,
            'amount' => 100,
            'details' => 'transaction 1'
        ];

        //Assert
        $this->post('/api/accounts/' .$accountFrom->id . '/transactions', $data)
            ->assertStatus(201)
            ->assertJsonStructure([
                'from',
                'to',
                'details',
                'amount'
            ]);
    }


    public function test_overspend_balance_will_fail()
    {
        //Prepare Data
        $accountFrom = factory(Account::class)->create([
            'balance' => 50
        ]);
        $accountTo = factory(Account::class)->create();

        $data = [
            'to' => $accountTo->id,
            'amount' => $accountFrom->balance + 1,
            'details' => 'transaction failed'
        ];

        $this->post('/api/accounts/' .$accountFrom->id . '/transactions', $data)
            ->assertStatus(403);
    }
}
