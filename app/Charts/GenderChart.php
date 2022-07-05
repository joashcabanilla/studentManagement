<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\User\Student;

class GenderChart extends BaseChart
{
    public function handler(Request $request): Chartisan
    {
        $male = Student::where('gender','=','male')->count();
        $female = Student::where('gender','=','female')->count();
        return Chartisan::build()
            ->labels(['Male','Female'])
            ->dataset('Gender', [$male,$female]);
    }
}