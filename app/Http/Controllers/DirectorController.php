<?php

namespace App\Http\Controllers;

use App\Director;
use App\Client;
use Illuminate\Http\Request;

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
        $directors = Director::all();
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Director $client)
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
