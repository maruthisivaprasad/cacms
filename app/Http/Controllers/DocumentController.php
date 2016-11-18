<?php

namespace App\Http\Controllers;

use App\Document;
use App\User;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DocumentRequest;
use Excel;

class DocumentController extends Controller
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
        $clients = DB::table('client')
                ->select('client.name as cname', 'client.client_type as ctype', 'client.business_name as bname', 'client.client_id')
                ->get();
        $documents = DB::table('documents')
                ->join('client', 'client.client_id', '=', 'documents.client_id')
                ->select('client.name as cname', 'client.client_type as ctype','client.business_name as bname', 'documents.title as title', 'documents.path as path', 
                        'documents.document_id', 'client.client_id')
                ->where('documents.is_active', '=', 1)
                ->get();
        return view('document.index', compact('clients', 'documents'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentRequest $request)
    {
        Document::create($request->all());
        $lastid =  Document::orderBy('document_id', 'desc')->first()->document_id;
        $file = $request->file('path');
        if($file!='')
        {
            $dir='images/'.$request->client_id;		
            if(!file_exists('images/'.$request->client_id)){
                    mkdir('images/'.$request->client_id,0777);
                    chmod('images/'.$request->client_id, 0777);
            }	
            
            $destinationPath = $dir;
            $ext = $file->getClientOriginalExtension();
            $filename = $request->title.'.'.$ext;
            $document = Document::find($lastid);
            $data['path'] = $filename;
            $document->update($data);
            $file->move($destinationPath,$filename);
        }
        return redirect()->route('document.index')->with('message', 'Document creted successful');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        $ddetail = DB::table('documents')->where('document_id', $document->document_id)->first();
        unlink('images/'.$ddetail->client_id.'/'.$ddetail->path);
        $document->delete();
        return redirect()->route('document.index')->with('message', 'Document Deleted successful');
    }
    
    public function excel() {

        $documents = Document::join('client', 'client.client_id', '=', 'documents.client_id')
                ->select('client.name as cname', 'client.business_name as bname', 'documents.title as title', 
                        'documents.path as path')
                ->where('documents.is_active', '=', 1)
                ->get();
        // Initialize the array which will be passed into the Excel
        // generator.
        $paymentsArray = []; 

        // Define the Excel spreadsheet headers
        $paymentsArray[] = ['Client Name', 'Business Name','Title','Path'];

        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($documents as $payment) {
            $paymentsArray[] = $payment->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('documents', function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Documents');
            $excel->setCreator('Laravel')->setCompany('WJ Gilmore, LLC');
            $excel->setDescription('payments file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
            });

        })->download('xlsx');
    }
}
