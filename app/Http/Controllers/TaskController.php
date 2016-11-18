<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\TaskRequest;
use Excel;

class TaskController extends Controller
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
        $tasks = DB::table('tasks')
                ->join('client', 'client.client_id', '=', 'tasks.client_id')
                ->select('client.name as cname', 'client.client_type as ctype', 'client.business_name as bname', 
                        'tasks.subject', 'tasks.description', 'tasks.priority', 'tasks.duedate', 'tasks.remarks',
                        'tasks.task_id')
                ->get();
        return view('task.index', compact('tasks'));
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
        return view('task.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        Task::create($request->all());
        return redirect()->route('task.index')->with('message', 'Task creted successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $client = DB::table('client')->where('client_id', $task->client_id)->first();
        return view('task.view', compact('task', 'client')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $clients = DB::table('client')
                ->select('client.name as cname', 'client.client_type as ctype', 'client.business_name as bname', 'client.client_id')
                ->get();
        return view('task.edit', compact('task', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->all());
        return redirect()->route('task.index')->with('message', 'Task Updated successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('task.index')->with('message', 'Task Deleted successful');
    }
    
    public function excel() {

        $tasks = Task::join('client', 'client.client_id', '=', 'tasks.client_id')
                ->select('client.name as cname', 'client.business_name as bname', 
                        'tasks.subject', 'tasks.description', 'tasks.priority', 'tasks.duedate', 'tasks.remarks')
                ->get();
        // Initialize the array which will be passed into the Excel
        // generator.
        $paymentsArray = []; 

        // Define the Excel spreadsheet headers
        $paymentsArray[] = ['Client Name', 'Busness Name','Subject','Description','Priority', 'Due Date', 'Remarks'];

        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($tasks as $payment) {
            $paymentsArray[] = $payment->toArray();
        }

        // Generate and return the spreadsheet
        Excel::create('tasks', function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Tasks');
            $excel->setCreator('Laravel')->setCompany('WJ Gilmore, LLC');
            $excel->setDescription('payments file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
            });

        })->download('xlsx');
    }
}
