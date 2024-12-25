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
}