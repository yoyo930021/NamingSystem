<?php
/**
 * Created by PhpStorm.
 * User: yckao85
 * Date: 15/2/18
 * Time: 下午6:07
 */
class StudentController extends BaseController {



    public function login()
    {
        $settings=Setting::find(0);
        if($settings->server_state==1)
        {
            $account=Input::get('inputAccount');
            $password=Input::get('inputPassword');
            $password = sha1(sha1($password) . "place");
            $student=Student::where('account','=',$account)->count();
            if($student>0)
            {
                $student=Student::where('account','=',$account)->firstOrFail();
                if ($student->password==$password)
                {
                    Session::flush();
                    Session::regenerate();
                    Session::put('studentlogin',true);
                    Session::put('id',$student->id);
                    Session::put('account',$student->account);
                    Session::put('name', $student->name);
                    Session::put('class_id',$student->class_id);
                    Session::put('seat',$student->seat);
                    yslog($account,"student","login","success");
                    return Redirect::to('/student');
                }
                else
                {
                    yslog($account,"student","login","failed");
                    return Redirect::to('/')->with('error', '#');
                }
            }
            else
            {
                yslog($account,"student","login","failed");
                return Redirect::to('/')->with('error', '#');
            }
        }
        else
        {
            return Redirect::to('/');
        }
    }

    public function timetable()
    {
        if (Session::get('studentlogin')==true)
        {
            $week1=Timetable::where('section','=','1')->orderBy('week')->get();
            $week2=Timetable::where('section','=','2')->orderBy('week')->get();
            $week3=Timetable::where('section','=','3')->orderBy('week')->get();
            $week4=Timetable::where('section','=','4')->orderBy('week')->get();
            $week5=Timetable::where('section','=','5')->orderBy('week')->get();
            $week6=Timetable::where('section','=','6')->orderBy('week')->get();
            $week7=Timetable::where('section','=','7')->orderBy('week')->get();
            return View::make('student.timetable')->with('week1',$week1)->with('week2',$week2)->with('week3',$week3)->with('week4',$week4)->with('week5',$week5)->with('week6',$week6)->with('week7',$week7);
        }
        else
        {
            return View::make('student.login');
        }
    }

    public function logout()
    {
        yslog(Session::get('account'),"student","logout","success");
        Session::regenerate();
        Session::flush();
        return Redirect::to('/')->with('logout', '#');
    }




}

