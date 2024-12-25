<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function list(){
        return Students::all();
    }
    public function addStudent(Request $request){
        $students = new Students();
        $students->studentname = $request->studentname;
        $students->studentemail = $request->studentemail;
        if($students->save()){
            return response()->json(['message' => 'Student has been added successfully'], 201);
        }else{
            return response()->json(['message' => 'Failed to add student'], 500);
        }
    }
    public function updateStudent(Request $request, $id){
        $students = Students::find($id);
        if(!$students){
            return response()->json(['message' => 'Student not found'], 404);
        }
        $students->studentname = $request->studentname;
        $students->studentemail = $request->studentemail;
        if($students->save()){
            return response()->json(['message' => 'Student has been updated successfully'], 200);
        }else{
            return response()->json(['message' => 'Failed to update student'], 500);
        }
    }
}