<?php

namespace App\Http\Controllers;

use App\student;
use App\course;
use Illuminate\Http\Request;
class StudentController extends Controller
{

    public function attach_student_with_associated_courses(Request $request , student $std_id){

        $request->validate([
            'course_id' => 'required|array',
        ]);
       $std_id->courses()->attach($request->course_id);

       return response()->json([  "status"=>"id attached successfully",]);
    }

    public function student(student $student)
    {

        return response()->json(["attached id with student " => $student->load('courses')]);

    }



}
