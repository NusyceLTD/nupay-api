<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\BaseController;
use App\Models\Receive;
use App\Models\Send;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends BaseController
{
    public function doDeposite(Request $request)
    {

    }

    public function doTransfert(Request $request)
    {
        $request->validate(['email_to' => 'required', 'description' => 'required', 'wallet' => 'required', 'ammount' => 'required']);
        DB::beginTransaction();
        $receive = Receive::create([
            'user_id' => $user->id,
            'from_id' => Auth::user()->id,
            'transaction_state_id' => 3, // waiting confirmation
            'gross' => $request->amount,
            'currency_id' => $currency->id,
            'currency_symbol' => $currency->symbol,
            'fee' => $receive_fee,
            'net' => $request->amount - $receive_fee,
            'description' => $request->description,
            'send_id' => 0
        ]);

        $send = Send::create([
            'user_id' => Auth::user()->id,
            'to_id' => $user->id,
            'transaction_state_id' => 3, // waiting confirmation
            'gross' => $request->amount,
            'currency_id' => $currency->id,
            'currency_symbol' => $currency->symbol,
            'fee' => $send_fee,
            'net' => $request->amount - $send_fee,
            'description' => $request->description,
            'receive_id' => $receive->id
        ]);

        $receive->send_id = $send->id;
        $receive->save();

        $user->RecentActivity()->save($receive->Transactions()->create([
            'user_id' => $receive->user_id,
            'entity_id' => $receive->id,
            'entity_name' => Auth::user()->name,
            'transaction_state_id' => 3, // waiting confirmation
            'money_flow' => '+',
            'currency_id' => $currency->id,
            'thumb' => Auth::user()->avatar,
            'currency_symbol' => $currency->symbol,
            'activity_title' => 'Payment Received',
            'gross' => $receive->gross,
            'fee' => $receive->fee,
            'net' => $receive->net,
        ]));

        Auth::user()->RecentActivity()->save($send->Transactions()->create([
            'user_id' => Auth::user()->id,
            'entity_id' => $send->id,
            'entity_name' => $user->name,
            'transaction_state_id' => 3, // waiting confirmation
            'money_flow' => '-',
            'thumb' => $user->avatar,
            'currency_id' => $currency->id,
            'currency_symbol' => $currency->symbol,
            'activity_title' => 'Payment Sent',
            'gross' => $send->gross,
            'fee' => $send->fee,
            'net' => $send->net
        ]));
        DB::commit();
    }

    public function requestPayement(Request $request)
    {

    }

    public function doWithDraw(Request $request)
    {

    }
}
