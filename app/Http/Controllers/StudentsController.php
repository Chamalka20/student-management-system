<?php

namespace App\Http\Controllers;

use App\Models\Student;
use domain\facades\StudentFacade;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    protected $student;
    
    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function index (){
        $studentList['students'] =StudentFacade::all();
        return view('pages.students.index')->with($studentList);
    }
    public function add (Request $request){

        StudentFacade::add($request);
        return redirect()->back();
    }

    public function delete ($studentId){

        StudentFacade::delete($studentId);
        return redirect()->back();
    }
    public function active ($studentId){

        StudentFacade::active($studentId);
        return redirect()->back();
    }

    public function edit (Request $request){

        $student['student'] =StudentFacade::edit($request);
        return view('pages.students.edit')->with($student);
    }

    public function update(Request $request, $studentId) {

       StudentFacade:: update($request,$studentId);
    
        return redirect()->back()->with('success', 'Student updated successfully');
    }


}
