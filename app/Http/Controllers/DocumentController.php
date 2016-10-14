<?php

namespace App\Http\Controllers;

use App\Document;
use App\User;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DocumentRequest;

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
        $clients = Client::pluck('name', 'client_id');
        $documents = DB::table('documents')
                ->join('client', 'client.client_id', '=', 'documents.client_id')
                ->select('client.name as cname', 'documents.title as title', 'documents.path as path', 
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
}