<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function list(){
        return response()->json(Students::all(), 200);
    }

    public function addStudent(Request $request){
        $request->validate([
            'studentname' => 'required|string|max:255',
            'studentemail' => 'required|email|unique:students,studentemail|max:255',
        ]);

        $student = new Students();
        $student->studentname = $request->studentname;
        $student->studentemail = $request->studentemail;

        if($student->save()){
            return response()->json(['message' => 'Student has been added successfully'], 201);
        } else {
            return response()->json(['message' => 'Failed to add student'], 500);
        }
    }

    public function updateStudent(Request $request, $id){
        $request->validate([
            'studentname' => 'required|string|max:255',
            'studentemail' => 'required|email|unique:students,studentemail,'.$id.'|max:255',
        ]);

        $student = Students::find($id);
        if(!$student){
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->studentname = $request->studentname;
        $student->studentemail = $request->studentemail;

        if($student->save()){
            return response()->json(['message' => 'Student has been updated successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to update student'], 500);
        }
    }

    public function deleteStudent($id){
        $student = Students::find($id);
        if(!$student){
            return response()->json(['message' => 'Student not found'], 404);
        }

        if($student->delete()){
            return response()->json(['message' => 'Student has been deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to delete student'], 500);
        }
    }

    public function searchStudent($studentname){
        $students = Students::where('studentname', 'like', '%'.$studentname.'%')->get();
        if($students->isEmpty()){
            return response()->json(['message' => 'No student found'], 404);
        } else {
            return response()->json(['result' => $students], 200);
        }
    }
}