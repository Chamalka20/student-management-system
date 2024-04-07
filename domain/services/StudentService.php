<?php

namespace domain\services;

use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class StudentService{

    protected $student;
    
    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    public function all (){
       return $studentList['students'] =$this->student->all();
        
    }
    public function add (Request $request){

    
        $validatedData = $request->validate([
            'name' => 'required|string|max:45',
            'age' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('images', $imageName);

            $validatedData['image'] = $imagePath;
        }
        $this->student->create($validatedData);

        
    }

    public function delete ($studentId){
        $student= $this->student->find($studentId);
        $student->delete();
        
    }
    public function active ($studentId){
        $student= $this->student->find($studentId);
        $student->status =1;
        $student->update();
        
    }

    public function edit (Request $request){

       return $this->student->find($request->studentId); 
    }

    public function update(Request $request, $studentId) {

        $validatedData = $request->validate([
            'name' => 'required|string|max:45',
            'age' => 'required|integer|min:0',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
    
      
        $student = Student::findOrFail($studentId);
        
       
        $student->name = $validatedData['name'];
        $student->age = $validatedData['age'];
    
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('images', $imageName);
    
           
            if ($student->image) {
                Storage::delete($student->image);
            }
    
            $student->image = $imagePath;
        }
    
        
        $student->save();
    
        
    }

}