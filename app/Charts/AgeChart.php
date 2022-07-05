<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\Models\User\Student;

class AgeChart extends BaseChart
{
    public function handler(Request $request): Chartisan
    {
        $age = Student::selectRaw('age, COUNT(age) as count')->groupBy('age')->get();
        $ageLabel = [];
        $ageCount = [];
        foreach($age as $data){
            array_push($ageLabel,$data->age);
            array_push($ageCount,$data->count);
        }
        return Chartisan::build()
            ->labels($ageLabel)
            ->dataset('Count', $ageCount);
    }
}