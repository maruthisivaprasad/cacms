<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PaymentRequest;
use Excel;

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
        $id = $payable = '';
        if(isset($_GET))
        {
            foreach($_GET as $key=>$value)
                $id = $key;
            $fee = DB::table('fees')->where('fee_id', $id)->first();
            if(!empty($fee))
            {
                $payable = $fee->fees;
                $servicename = $fee->service_name;
                $balance = $fee->balance;
            }
            else
            {
                $payable = '';
                $servicename = '';
                $balance = '';
            }
        }
        $payments = DB::table('client')
                ->join('fees', 'fees.client_id', '=', 'client.client_id')
                ->select('client.name as cname', 'client.client_type as ctype', 'client.business_name as bname', 'fees.fee_id')
                ->get();
        return view('payment.create', compact('payments', 'id', 'payable', 'servicename','balance'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        if(isset($_POST))
        {
            $fee = DB::table('fees')->where('fee_id', $_POST['fee_id'])->first();
            if($fee->balance < $_POST['paid_amount'])
                return redirect()->route('payment.create')->with('message', 'Payment amount was greater than the balance');
            $amountreceived = $fee->amount_receive + $_POST['paid_amount'];
            $balance = $fee->fees - $amountreceived;
            DB::table('fees')->where('fee_id', $_POST['fee_id'])->update(['amount_receive' => $amountreceived, 'balance'=>$balance]);
        }
        Payment::create($request->all());
        return redirect()->route('fee.show', ['id' => $_POST['fee_id']])->with('message', 'Payment creted successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        $payment = DB::table('payment')
                ->join('fees', 'fees.fee_id', '=', 'payment.fee_id')
                ->join('client', 'client.client_id', '=', 'fees.client_id')
                ->select('client.name as cname', 'client.client_type as ctype', 'client.business_name as bname', 
                        'fees.fees as fees', 'fees.balance as balance', 'payment.service_name','fees.fee_id',
                        'payment.payment_amount', 'payment.payment_id', 'payment.paid_amount',
                        'payment.payment_mode', 'payment.check_no', 'payment.paymentdate', 'payment.remarks')
                ->where('payment_id', $payment->payment_id)->first();
        //echo "<pre>";print_r($payments);exit;
        return view('payment.view', compact('payment')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        $payinfo = DB::table('client')
                ->join('fees', 'fees.client_id', '=', 'client.client_id')
                ->select('client.name as cname', 'client.client_type as ctype', 'client.business_name as bname', 'fees.fee_id')
                ->get();
        return view('payment.edit', compact('payment', 'payinfo'));
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
    
    public function excel() {

        $payments = Payment::join('fees', 'fees.fee_id', '=', 'payment.fee_id')
                ->join('client', 'client.client_id', '=', 'fees.client_id')
                ->select('client.name as cname', 'client.business_name as bname', 
                        'fees.fees as fees', 'fees.balance as balance', 'payment.service_name',
                        'payment.payment_amount', 'payment.paid_amount',
                        'payment.payment_mode', 'payment.check_no', 'payment.paymentdate', 'payment.remarks')
                ->get();
        // Initialize the array which will be passed into the Excel
        // generator.
        $paymentsArray = []; 

        // Define the Excel spreadsheet headers
        $paymentsArray[] = ['Client Name', 'Business Name','Fees','Balance','Service Name', 'Payment Amount', 'Paid Amount', 'Payment Mode', 'Check Number', 'Payment Date', 'Remarks'];

        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($payments as $payment) {
            $paymentsArray[] = $payment->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('payments', function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Payments');
            $excel->setCreator('Laravel')->setCompany('WJ Gilmore, LLC');
            $excel->setDescription('payments file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
            });

        })->download('xlsx');
    }
}
