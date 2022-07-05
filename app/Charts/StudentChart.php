<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\User\Student;
use DB;

class StudentChart extends BaseChart
{
    public function handler(Request $request): Chartisan
    {
        $month = date('m');
        $year = date('Y');
        $date = Student::select( DB::raw('DATE(created_at) AS date'),DB::raw('COUNT(*) AS count'))
        ->whereMonth('created_at', '=', $month)
        ->whereYear('created_at', '=', $year)
        ->groupBy( DB::raw('DATE(created_at)'))
        ->get();
        
        $studentLabel = [];
        $studentCount = [];

        foreach($date as $data){
            array_push($studentLabel,date('M d', strtotime($data->date)));
            array_push($studentCount,$data->count);
        }

        return Chartisan::build()
            ->labels($studentLabel)
            ->dataset('Number of Student Registered', $studentCount);
    }
}