<?php

namespace App\Http\Controllers;

use App\Client;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ClientRequest;
use Excel;

class ClientController extends Controller
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
        $clients = Client::all();
        return view('client.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::pluck('name', 'id');
        return view('client.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        Client::create($request->all());
        $lastid =  Client::orderBy('client_id', 'desc')->first()->client_id;
        $file = $request->file('photo');
        if($file!='')
        {
            $destinationPath = 'images/clientimage';
            $ext = $file->getClientOriginalExtension();
            $filename = $lastid.'.'.$ext;
            $client = Client::find($lastid);
            $data['photo'] = $filename;
            $client->update($data);
            $file->move($destinationPath,$filename);
        }
        return redirect()->route('client.index')->with('message', 'Client creted successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
       $user = DB::table('users')->where('id', $client->assigned_user)->first();
       $directors = DB::table('director')
                ->join('client', 'client.client_id', '=', 'director.client_id')
                ->select('client.name as cname', 'client.client_type as ctype', 'client.business_name as bname', 
                        'director.name as dname', 'director.phone as dphone', 'director.email as demail',
                        'director.din', 'director.director_id')
               ->where('director.client_id', '=', $client->client_id)
                ->get();
       $fees = DB::table('fees')
                ->join('client', 'client.client_id', '=', 'fees.client_id')
                ->select('client.name as cname', 'client.client_type as ctype', 'client.business_name as bname', 
                        'fees.service_name', 'fees.fees', 'fees.amount_receive', 'fees.balance', 'fees.type',
                        'fees.fee_id')
               ->where('fees.client_id', '=', $client->client_id)
                ->get();
       $documents = DB::table('documents')
                ->join('client', 'client.client_id', '=', 'documents.client_id')
                ->select('client.name as cname', 'client.client_type as ctype','client.business_name as bname', 'documents.title as title', 'documents.path as path', 
                        'documents.document_id', 'client.client_id')
                ->where('documents.is_active', '=', 1)
               ->where('documents.client_id', '=', $client->client_id)
                ->get();
       $payments = DB::table('payment')
                ->join('fees', 'fees.fee_id', '=', 'payment.fee_id')
                ->join('client', 'client.client_id', '=', 'fees.client_id')
                ->select('client.name as cname', 'client.client_type as ctype', 'client.business_name as bname', 
                        'fees.fees as fees', 'fees.balance as balance', 'payment.service_name','fees.fee_id',
                        'payment.payment_amount', 'payment.payment_id', 'payment.paid_amount',
                        'payment.payment_mode', 'payment.check_no', 'payment.paymentdate', 'payment.remarks')
                ->where('client.client_id', $client->client_id)->get();
       $tasks = DB::table('tasks')
                ->join('client', 'client.client_id', '=', 'tasks.client_id')
                ->select('client.name as cname', 'client.client_type as ctype', 'client.business_name as bname', 
                        'tasks.subject', 'tasks.description', 'tasks.priority', 'tasks.duedate', 'tasks.remarks',
                        'tasks.task_id')
                ->where('client.client_id', $client->client_id)->get();
       return view('client.view', compact('client', 'user', 'directors', 'fees', 'documents', 'payments', 'tasks')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        $users = User::pluck('name', 'id');
        return view('client.edit', compact('client', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, Client $client)
    {
        $client->update($request->all());
        $file = $request->file('photo');
        if($file!='')
        {
            $destinationPath = 'images/clientimage';
            $ext = $file->getClientOriginalExtension();
            if($ext!='')
            {
                $ap = base_path();
                $delete = $ap.'/'.$destinationPath.'/'.$client->photo;
                unlink($delete);
                $filename = $client->client_id.'.'.$ext;
                $data['photo'] = $filename;
                $file->move($destinationPath,$filename);
                $client->update($data);
            }
        }
        return redirect()->route('client.index')->with('message', 'Client Updated successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('client.index')->with('message', 'Client Deleted successful');
    }
    
    public function excel() {

        $clients = Client::select('name', 'client_type', 'business_name', 'address', 'mobile', 'email', 'pan', 'uidai',
                'office_address', 'office_landline', 'website', 'business_nature', 'company_type', 'client_status')
                ->get();
        // Initialize the array which will be passed into the Excel
        // generator.
        $paymentsArray = []; 

        // Define the Excel spreadsheet headers
        $paymentsArray[] = ['Name', 'Client Type', 'Business Name' ,'Address','Mobile','Email', 'PAN', 'UIDAI', 
            'Office Address', 'Office Landline', 'Website', 'Business Nature', 'Company Type', 'Client Status'];

        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($clients as $payment) {
            $paymentsArray[] = $payment->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('clients', function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Clients');
            $excel->setCreator('Laravel')->setCompany('WJ Gilmore, LLC');
            $excel->setDescription('payments file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
            });

        })->download('xlsx');
    }
}
