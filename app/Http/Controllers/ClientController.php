<?php

namespace App\Http\Controllers;

use App\Client;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests\ClientRequest;

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
}
