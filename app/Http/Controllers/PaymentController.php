<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PaymentRequest;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = DB::table('payment')
                ->join('fees', 'fees.fee_id', '=', 'payment.fee_id')
                ->join('client', 'client.client_id', '=', 'fees.client_id')
                ->select('client.name as cname', 'client.client_type as ctype', 'client.business_name as bname', 
                        'fees.fees as fees', 'fees.balance as balance', 'payment.service_name','fees.fee_id',
                        'payment.payment_amount', 'payment.payment_id', 'payment.paid_amount',
                        'payment.payment_mode', 'payment.check_no', 'payment.paymentdate', 'payment.remarks')
                ->get();
        //$directors = Director::all();
        return view('payment.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payments = DB::table('client')
                ->join('fees', 'fees.client_id', '=', 'client.client_id')
                ->select('client.name as cname', 'client.client_type as ctype', 'client.business_name as bname', 'fees.fee_id')
                ->get();
        return view('payment.create', compact('payments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        Payment::create($request->all());
        return redirect()->route('payment.index')->with('message', 'Payment creted successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        $client = DB::table('client')->where('client_id', $payment->client_id)->first();
        return view('payment.view', compact('$payment', 'client')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        $clients = Client::pluck('name', 'client_id');
        return view('payment.edit', compact('payment', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentRequest $request, Payment $payment)
    {
        $payment->update($request->all());
        return redirect()->route('payment.index')->with('message', 'payment Updated successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payment.index')->with('message', 'payment Deleted successful');
    }
}
