<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Traits\FormatTime;
use Illuminate\Support\Facades\DB;
use stdClass;

class StatisticsController extends Controller
{
    //


    public function index(Request $request)
    {

        //Tasks 

        $months_array = [];
        $tasks_array = [];
        $completeTasks_array = [];
        $incompleteTasks_array = [];
        $total_tasks = [];
        $months = 4;
        $year = date('Y');
        for ($i = 0; $i < $months; $i++) {
            $date = date('F', strtotime('-' . $i . ' month')); // previous month
            $date = substr($date, 0, 3);
            $month = date('m', strtotime('-' . $i . ' month'));
            $complete_tasks = count(Task::whereNull('task_id')->where('status_id', '=', 3)->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->get());
            $tasks_per_month = count(Task::whereNull('task_id')->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $year)->get());
            $incomplete_tasks = $tasks_per_month - $complete_tasks;
            if ($i == 0) {
                $completed_current_month = $complete_tasks;
            }
            if ($i == 1) {
                $completed_previous_month = $complete_tasks;
            }
            array_push($total_tasks, $tasks_per_month);
            array_push($months_array, $date);
            array_push($completeTasks_array, $complete_tasks);
            array_push($incompleteTasks_array, $incomplete_tasks);
        }
        $completed_annual = count(Task::whereNull('task_id')->where('status_id', '=', 3)->whereYear('created_at', '=', $year)->get());
        $plus = 0;
        if (Task::whereNull('task_id')->orderBy('updated_at', 'desc')->first()) {
            $updated =  Task::whereNull('task_id')->orderBy('updated_at', 'desc')->first();
            $updated = FormatTime::LongTimeFilter($updated->updated_at);
        } else {
            $updated = null;
        }
        foreach ($total_tasks as $tasks) {
            $plus += $tasks;
        }
        $total = $plus;
        $completed = 0;
        foreach ($completeTasks_array as $complete) {
            $completed += $complete;
        }
        $incompleted = $total - $completed;

        $plus = (round(($plus + 5 / 2) / 5) * 5) + 5;
        $completeTasks_array = array_reverse($completeTasks_array);
        $incompleteTasks_array = array_reverse($incompleteTasks_array);
        $months_array = array_reverse($months_array);
        array_push($tasks_array, $completeTasks_array);
        array_push($tasks_array, $incompleteTasks_array);

        $tasks_statistics = new stdClass();
        $tasks_statistics->months = $months_array;
        $tasks_statistics->series = $tasks_array;
        $tasks_statistics->high = $plus;
        $tasks_statistics->updated = $updated;
        $tasks_statistics->total = $total;
        $tasks_statistics->completed = $completed;
        $tasks_statistics->incompleted = $incompleted;
        $tasks_statistics->completed_annual = $completed_annual;
        $tasks_statistics->current_month = $completed_current_month;
        $tasks_statistics->last_month = $completed_previous_month;

        //visits 

        $previousYear = date('Y', strtotime('-' . 1 . ' year'));
        $currentYear = date('Y');
        $visits = DB::table('public_views')->select('views')->whereYear('updated_at', $currentYear)->whereNull('post_id')->whereNull('post_tittle')->orderBy('updated_at', 'desc')->get();
        $total_visits = 0;

        if (DB::table('public_views')->whereYear('updated_at', $currentYear)->orderBy('updated_at', 'desc')->first()) {
            $updated = DB::table('public_views')->whereYear('updated_at', $currentYear)->orderBy('updated_at', 'desc')->first();
            $updated = FormatTime::LongTimeFilter(new \Datetime($updated->updated_at));
        } else {
            $updated = 0;
        }

        foreach ($visits as $page_visits) {
            $total_visits = $total_visits + $page_visits->views;
        }
        $current_month = date('m');
        $previous_month = date('m', strtotime('-' . 1 . ' month'));
        $current_month_visits = DB::table('public_views')->select('views')->whereYear('updated_at', $currentYear)->whereMonth('updated_at', $current_month)->whereNull('post_id')->whereNull('post_tittle')->orderBy('updated_at', 'desc')->get();


        $previous_month_visits = DB::table('public_views')->select('views')->whereYear('updated_at', $currentYear)->whereMonth('updated_at', $previous_month)->whereNull('post_id')->whereNull('post_tittle')->orderBy('updated_at', 'desc')->get();

        $total_current_month = 0;
        $total_previous_month = 0;

        foreach ($previous_month_visits as $page_visits) {
            $total_previous_month = $total_previous_month + $page_visits->views;
        }
        foreach ($current_month_visits as $page_visits) {
            $total_current_month = $total_current_month + $page_visits->views;
        }

        $months = 12;
        $i = 1;
        $x = 1;
        $visits_array_previous_year = [];
        $visits_array_current_year = [];
        $series = [];

        for ($i; $i <= $months; $i++) {
            $month_visits = DB::table('public_views')->select('views')->whereMonth('updated_at', $i)->whereYear('updated_at', $previousYear)->whereNull('post_id')->whereNull('post_tittle')->get();
            $total_per_month = 0;
            if (count($month_visits) > 0) {
                foreach ($month_visits as $visit_per_month) {
                    $total_per_month = $total_per_month + $visit_per_month->views;
                }
                array_push($visits_array_previous_year, $total_per_month);
            } else {
                array_push($visits_array_previous_year, $total_per_month);
            }
        }
        for ($x; $x <= $months; $x++) {
            $month_visits = DB::table('public_views')->select('views')->whereMonth('updated_at', $x)->whereYear('updated_at', $currentYear)->whereNull('post_id')->whereNull('post_tittle')->get();
            $total_per_month = 0;
            if (count($month_visits) > 0) {
                foreach ($month_visits as $visit_per_month) {
                    $total_per_month = $total_per_month + $visit_per_month->views;
                }
                array_push($visits_array_current_year, $total_per_month);
            } else {
                array_push($visits_array_current_year, $total_per_month);
            }
        }
        $high_per_month = max($visits_array_current_year) > max($visits_array_previous_year) ? max($visits_array_current_year) : max($visits_array_previous_year);
        $high = (round(($high_per_month + 5 / 2) / 5) * 5) + 15;
        array_push($series, $visits_array_previous_year);
        array_push($series, $visits_array_current_year);


        $visits_statistics = new stdClass();
        $visits_statistics->previous_month = $total_previous_month;
        $visits_statistics->current_month = $total_current_month;
        $visits_statistics->series = $series;
        $visits_statistics->high = $high;
        $visits_statistics->total_visits = $total_visits;
        $visits_statistics->updated = $updated;


        return response()->json(['tasks_statistics' => $tasks_statistics, 'visits_statistics' => $visits_statistics]);
    }
    
}
