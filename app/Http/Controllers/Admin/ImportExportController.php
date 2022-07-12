<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\studentImport;
use App\Imports\userImport;
use App\Exports\studentExport;
use Excel;
use PDF;
use App\Models\User\Student;

class ImportExportController extends Controller
{
    public function index(){
        return view("admin.import",['title'=>"Student Account"]);
    }

    public function import(Request $req){
        Excel::Import(new studentImport, $req->file);
        return redirect('/admin/student');
    }

    public function exportExcel(){
        return Excel::download(new studentExport, 'student.xlsx');
    }

    public function exportCSV(){
        return Excel::download(new studentExport, 'student.csv');
    }

    public function exportPDF(){
        $collection =  Student::all();
        return view('admin.pdfView',['collection' => $collection, 'title'=>"Student Account"]);
    }

    public function savePDF(){
        $collection =  Student::all();
        $pdf = PDF::loadView('admin.pdfSave', compact('collection'));
        return $pdf->download('Student.pdf');
    }
}
