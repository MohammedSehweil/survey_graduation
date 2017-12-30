<?php

namespace App\Http\Controllers;

use App\ScheduleUni;
use App\Score;
use App\Solution;
use App\Student;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SchController extends Controller
{

    public function index(){

        $randNum = rand(1,2);
        logger('randNum : ' . $randNum);
        do{
            $student_id = Student::inRandomOrder()->first()->id;
            $student_course_uni = ScheduleUni::all()->where('STUDENT_NUMBER','=',$student_id)->pluck('time_slot','time_slot')->toArray();
        }while (sizeof($student_course_uni) != 0);
        $student_course_our = Solution::join('course_table','course_table.id','=','solution.course_id')
            ->join('student_course_table','student_course_table.course_id','=','solution.course_id')
            ->where('student_course_table.STUDENT_NUMBER','=',$student_id)->pluck('time_slot','time_slot')->toArray();

        if ($randNum == 1){
            $s = $student_course_our;
            $student_course_our = $student_course_uni;
            $student_course_uni = $s;
        }
        return view('test',compact('student_course_uni','student_course_our','student_id','randNum'));
    }

    public function save(Request $request){

        $score = Score::all()->first();
        $university_score = $score->university_score;
        $our_score = $score->our_score;
        $answer = $request->all();
        if (!isset($answer['option']))
            return;
        $randNum = $answer['randNum'];
        $answer = $answer['option'];
        if ($randNum == 1){
            if ($answer == "2"){
                $university_score+=1;
            }
            else if ($answer == "1"){
                $our_score+=1;
            }
        }
        else{
            if ($answer == "1"){
                $university_score+=1;
            }
            else if ($answer == "2"){
                $our_score+=1;
            }
        }
        $score->university_score = $university_score;
        $score->our_score = $our_score;
        $score->save();
    }

    public function score($pass){
        $score = Score::all()->first();
        $passsword = Score::find(2)->university_score;
        if ($passsword ==$pass){
            $university_score = $score->university_score;
            $our_score = $score->our_score;
            $sum = $university_score + $our_score;
        }
        else{
            $university_score = 'Hidden';
            $our_score = 'Hidden';
            $sum = 'Hidden';
        }

        return view('score',compact('university_score','our_score','sum'));
    }


}
