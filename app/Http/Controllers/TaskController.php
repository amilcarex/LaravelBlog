<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\DB;
use App\Traits\FormatTime;
use App\Models\User;

class TaskController extends Controller
{
    //
    public $per_page = 10;

    public function list(Request $request)
    {
        
            $tasks = Task::Select('id', 'name', 'task_id', 'description', 'created_at', 'end_at', 'status_id')->whereNull('task_id')->paginate($this->per_page);
        
            foreach($tasks as $task){
                if($task->status_id == 1){
                    $task->status_id = 'Created';
                }
                if($task->status_id == 2){
                    $task->status_id = 'In Progress';
                }
                if($task->status_id == 1){
                    $task->status_id = 'Completed';
                }
            }
        return view('tasks.index', ['tasks' => $tasks]);
    }
    public function create(Request $request)
    {
        return view('tasks.create');
    }

    public function store(Request $request){

            $task = Task::create([
                'name' => $request->name,
                'description' => $request->description
            ]);

            if($task){

                return redirect()->route('index.task')->with(['success' => 'created']);
            }else{
                return redirect()->route('create.task')->with(['error' => 'error']);
            }
    }

    public function complete( $id){

        $task = Task::find($id);
        $task->status_id = 3;
        $pending_tasks = Task::where('status_id', '<>', 3)->get();
        $view = view('includes.tasks.pending', compact('pending_tasks'))->render();
        $authUser = User::find(auth()->user()->id);
        $role = $authUser->roles()->first();

        if($role->id != 1){
            return response()->json(['view' => $view, 'error' => 'Only a admin can manage this tasks']);
        }
        if($task->update()){
            $pending_tasks = Task::where('status_id', '<>', 3)->get();
            $view = view('includes.tasks.pending', compact('pending_tasks'))->render();
            return response()->json(['view' => $view]);
        }else{

            return response()->json(['view' =>$view, 'error' => 'Something was wrong']);
        }

        

    }
    public function edit($id){

        $task = Task::find($id);
        $statuses = DB::table('statuses')->select('id', 'name')->get();
        return view('tasks.edit', ['task' => $task, 'statuses' => $statuses]);
    }

    public function update(Request $request)
    {

        $task = Task::find($request->id);
        
        $task->name = $request->name;
        $task->description = $request->description;
        $task->status_id = $request->status;
        if($task->update()){
            return redirect()->route('edit.task', ['id' => $task->id])->with(['success' => 'edited']);
        }else{
            return redirect()->route('edit.task', ['id' => $task->id])->with(['error' => 'error']);
        }

    }
    public function destroy(Request $request)
    {

        $task = Task::find($request->record_id);
            if ($task->delete()) {
                return redirect()->route('index.task')->with(['success' => 'deleted']);
            } else {
                return redirect()->route('index.task')->with(['error' => 'error']);
            }
        
    }


    public function statistics()
    {
        $months_array = [];
        $tasks_array =[];
        $completeTasks_array =[];
        $incompleteTasks_array =[];
        $total_tasks = [];
        $months = 4;
        $year = date('Y');
        for ($i = 0; $i < $months; $i++) {
            $date = date('F', strtotime('-' . $i . ' month')); // previous month
            $month = date('m', strtotime('-'.$i.' month'));
            $complete_tasks = count(Task::whereNull('task_id')->where('status_id', '=', 3)->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->get());
            $incomplete_tasks = count(Task::whereNull('task_id')->where('status_id', '<>', 3)->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->get());
            $date = substr($date, 0, 3);
            $tasks_per_month = $complete_tasks + $incomplete_tasks;
            if($i == 0){
                $completed_current_month = $complete_tasks;
            }
            if($i == 1){
                $completed_previous_month = $complete_tasks;
            }
            array_push($total_tasks, $tasks_per_month);
            array_push($months_array, $date);
            array_push($completeTasks_array, $complete_tasks);
            array_push($incompleteTasks_array, $incomplete_tasks);
        }
        $completed_annual = count(Task::whereNull('task_id')->where('status_id', '=', 3)->whereYear('created_at', '=', $year)->get());
        $plus = 0;
        if(Task::whereNull('task_id')->orderBy('updated_at', 'desc')->first()){
            $updated =  Task::whereNull('task_id')->orderBy('updated_at', 'desc')->first();
            $updated = FormatTime::LongTimeFilter($updated->updated_at);
        }else{
            $updated = null;
        }   
        foreach($total_tasks as $tasks){
            $plus += $tasks;
        }
        $total = $plus;
        $completed = 0;
        foreach($completeTasks_array as $complete){
            $completed += $complete;
        }
        $incompleted = $total - $completed;
        
        $plus = (round(($plus + 5 / 2) / 5) * 5)+5;
        $months_array = array_reverse($months_array);
        $completeTasks_array = array_reverse($completeTasks_array);
        $incompleteTasks_array = array_reverse($incompleteTasks_array);

        array_push($tasks_array, $completeTasks_array);
        array_push($tasks_array, $incompleteTasks_array);
        return response()->json([ 'labels' => $months_array, 'series' => $tasks_array, 'high' => $plus, 'updated' => $updated, 'total' => $total, 'completed' => $completed, 'incompleted' => $incompleted, 'completed_annual' => $completed_annual, 'current_month' => $completed_current_month, 'last_month' => $completed_previous_month]);
    }

    public function pendingTasks(){
        $tasks = Task::whereNull('task_id')->where('status_id', '<>', 3)->orderBy('created_at', 'asc')->take(10)->get();
        foreach($tasks as $task){
            $task->tab = $task->name; 
        }
        return response()->json($tasks);
    }
}
