<?php

namespace App\Http\Controllers;

use App\Client;
use App\Fee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\FeeRequest;

class FeeController extends Controller
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
        $fees = DB::table('fees')
                ->join('client', 'client.client_id', '=', 'fees.client_id')
                ->select('client.name as cname', 'client.client_type as ctype', 'client.business_name as bname', 
                        'fees.service_name', 'fees.fees', 'fees.amount_receive', 'fees.balance', 'fees.type',
                        'fees.fee_id')
                ->get();
        //$fees = Fee::all();
        return view('fee.index', compact('fees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = DB::table('client')
                ->select('client.name as cname', 'client.client_type as ctype', 'client.business_name as bname', 'client.client_id')
                ->get();
        return view('fee.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeeRequest $request)
    {
        Fee::create($request->all());
        return redirect()->route('fee.index')->with('message', 'Fee creted successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Fee $fee)
    {
        $payments = DB::table('payment')
                ->join('fees', 'fees.fee_id', '=', 'payment.fee_id')
                ->join('client', 'client.client_id', '=', 'fees.client_id')
                ->select('client.name as cname', 'client.client_type as ctype', 'client.business_name as bname', 
                        'fees.fees as fees', 'fees.balance as balance', 'payment.service_name','fees.fee_id',
                        'payment.payment_amount', 'payment.payment_id', 'payment.paid_amount',
                        'payment.payment_mode', 'payment.check_no', 'payment.paymentdate', 'payment.remarks')
                ->where('payment.fee_id', $fee->fee_id)->get();
        $client = DB::table('client')->where('client_id', $fee->client_id)->first();
        return view('fee.view', compact('fee', 'client', 'payments')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Fee $fee)
    {
        $clients = DB::table('client')
                ->select('client.name as cname', 'client.client_type as ctype', 'client.business_name as bname', 'client.client_id')
                ->get();
        return view('fee.edit', compact('fee', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FeeRequest $request, Fee $fee)
    {
        $fee->update($request->all());
        return redirect()->route('fee.index')->with('message', 'Fee Updated successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fee $fee)
    {
        $fee->delete();
        return redirect()->route('fee.index')->with('message', 'Fee Deleted successful');
    }
    
    public function excel() {

        $fees = Fees::join('client', 'client.client_id', '=', 'fees.client_id')
                ->select('client.name as cname', 'client.client_type as ctype', 'client.business_name as bname', 
                        'fees.service_name', 'fees.fees', 'fees.amount_receive', 'fees.balance', 'fees.type',
                        'fees.fee_id')
                ->get();
        // Initialize the array which will be passed into the Excel
        // generator.
        $paymentsArray = []; 

        // Define the Excel spreadsheet headers
        $paymentsArray[] = ['dname', 'dphone','demail','din','ctype'];

        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($fees as $payment) {
            $paymentsArray[] = $payment->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('fees', function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Fees');
            $excel->setCreator('Laravel')->setCompany('WJ Gilmore, LLC');
            $excel->setDescription('payments file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
            });

        })->download('xlsx');
    }
}
