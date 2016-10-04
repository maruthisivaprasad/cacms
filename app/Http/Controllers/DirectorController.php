<?php

namespace App\Http\Controllers;

use App\Director;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DirectorRequest;

class DirectorController extends Controller
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
        $directors = DB::table('director')
                ->join('client', 'client.client_id', '=', 'director.client_id')
                ->select('client.name as cname', 'client.client_type as ctype', 'client.business_name as bname', 
                        'director.name as dname', 'director.phone as dphone', 'director.email as demail',
                        'director.din', 'director.director_id')
                ->get();
        //$directors = Director::all();
        return view('director.index', compact('directors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::pluck('name', 'client_id');
        return view('director.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DirectorRequest $request)
    {
        Director::create($request->all());
        return redirect()->route('director.index')->with('message', 'Director creted successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Director $director)
    {
        $client = DB::table('client')->where('client_id', $director->client_id)->first();
        return view('director.view', compact('director', 'client')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Director $director)
    {
        $clients = Client::pluck('name', 'client_id');
        return view('director.edit', compact('director', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DirectorRequest $request, Director $director)
    {
        $director->update($request->all());
        return redirect()->route('director.index')->with('message', 'Director Updated successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Director $director)
    {
        $director->delete();
        return redirect()->route('director.index')->with('message', 'Director Deleted successful');
    }
}
