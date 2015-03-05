<?php
/**
 * Created by PhpStorm.
 * User: yckao85
 * Date: 15/2/18
 * Time: 下午6:07
 */
class AdminController extends BaseController {

    
    public function login()
    {
        $account=Input::get('inputAccount');
        $password=Input::get('inputPassword');
        if (Auth::attempt(array('account' => $account, 'password' => $password)))
        {
            yslog($account,"admin","login","success");
            return Redirect::intended('/admin');
        }
        else
        {
            yslog($account,"admin","login","failed");
            return View::make('admin.login');
        }
    }

    public function postall()
    {
        $post=Post::all();
        return View::make('admin.postall')->with('posts',$post);
    }
    public function postadd()
    {
        return View::make('admin.postadd');
    }
    public function postaction($action,$id)
    {
        switch ($action)
        {
            case 'modify':
                $post=Post::find($id);
                return View::make('admin.postadd')->with('title',$post->title)->with('content',$post->content)->with('id',$id);
                break;
            case 'top':
                $post=Post::all();
                for($i=0;$i<count($post);$i++)
                {
                    if($post[$i]->id==$id)
                    {
                        if($i<=0)
                        {
                            return Redirect::to('/admin.post');
                            break;
                        }
                        else
                        {
                            $temp1=$post[$i-1]->id;
                            $post[$i-1]->id=100000000;
                            $post[$i-1]->save();
                            $temp2=$post[$i]->id;
                            $post[$i]->id=$temp1;
                            $post[$i]->save();
                            $post[$i-1]->id=$temp2;
                            $post[$i-1]->save();
                            return Redirect::to('/admin.post')->with('status','move');
                            break;
                        }
                    }
                }
                break;
            case 'down':
                $post=Post::all();
                for($i=0;$i<count($post);$i++)
                {
                    if($post[$i]->id==$id)
                    {
                        if(($i+1)>=count($post))
                        {
                            return Redirect::to('/admin.post');
                            break;
                        }
                        else
                        {
                            $temp1=$post[$i+1]->id;
                            $post[$i+1]->id=100000000;
                            $post[$i+1]->save();
                            $temp2=$post[$i]->id;
                            $post[$i]->id=$temp1;
                            $post[$i]->save();
                            $post[$i+1]->id=$temp2;
                            $post[$i+1]->save();
                            return Redirect::to('/admin.post')->with('status','move');
                            break;
                        }
                    }
                }
                break;
            case 'del':
                Post::destroy($id);
                return Redirect::to('/admin.post')->with('status','delect');
                break;
        }
    }

    public function postwrite($action)
    {
        switch ($action)
        {
            case 'add':
                $post=new Post;
                $post->title=Input::get('title');
                $post->author=Auth::user()->name;
                $post->content=Input::get('content');
                $post->save();
                return Redirect::to('/admin.post')->with('status','add');
                break;
            case 'modify':
                $post=Post::find(Input::get('id'));
                $post->title=Input::get('title');
                $post->author=Auth::user()->name;
                $post->content=Input::get('content');
                $post->save();
                return Redirect::to('/admin.post')->with('status','modify');
                break;
            case 'delall':
                $choose=Input::get('post');
                if(isset($choose))
                {
                    for($i=0;$i<count($choose);$i++)
                    {
                        Post::destroy($choose[$i]);
                    }
                }
                return Redirect::to('/admin.post')->with('status','delect');
                break;
        }
    }

    public function classall()
    {
        $classall=ClassAll::all();
        $teacher=Teacher::all();

        return View::make('admin.classall')->with('classall',$classall)->with('teachers',$teacher);
    }
    public function classadd()
    {
        $classone=new ClassAll;
        $classone->name=Input::get('classname');
        $classone->teacher_id=Input::get('teacher');
        $classone->save();
        $teachers=Teacher::all();
        $teacher=Teacher::find(Input::get('teacher'));
        $teacher->class_id=$classone->id;
        $teacher->save();
        return Redirect::to('/admin.class')->with('status','add');
    }
    public function classaction($action,$id)
    {
        switch ($action)
        {
            case 'modify':
                $teacher=Teacher::all();
                $classone=ClassAll::find($id);
                $student=Student::all();
                $classstudent=$classone->student;
                return View::make('admin.classmodify')->with('teachers',$teacher)->with('classone',$classone)->with('students',$student)->with('id',$id)->with('classstudents',$classstudent);
                break;
            case 'del':
                $students=Student::all();
                foreach($students as $student)
                {
                    if($student->class_id==$id)
                    {
                        $student->class_id=0;
                        $student->save();
                    }
                }
                ClassAll::destroy($id);
                return Redirect::to('/admin.class')->with('status','delect');
                break;
        }
    }
    public function classwrite($action,$id = null)
    {
        switch ($action)
        {
            case 'modify':
                $classone=ClassAll::find(Input::get('id'));
                $classone->name=Input::get('classname');
                $classone->teacher_id=Input::get('teacher');
                $classone->save();
                $teachers=Teacher::all();
                foreach($teachers as $teacher)
                {
                    if($teacher->class_id==$id)
                    {
                        $teacher->class_id=0;
                        $teacher->save();
                    }
                }
                $teacher=Teacher::find(Input::get('teacher'));
                $teacher->class_id=$id;
                $teacher->save();
                $students=Student::all();
                foreach($students as $student)
                {
                    if($student->class_id==$id)
                    {
                        $student->class_id=0;
                        $student->save();
                    }
                }
                $choosestudent=Input::get('student');
                foreach($choosestudent as $choosed)
                {
                    $student=Student::find($choosed);
                    $student->class_id=$id;
                    $student->save();
                }
                return Redirect::to('/admin.class')->with('status','modify');
                break;
            case 'delall':
                $choose=Input::get('classone');
                if(isset($choose))
                {
                    for($i=0;$i<count($choose);$i++)
                    {
                        $students=Student::all();
                        foreach($students as $student)
                        {
                            if($student->class_id==$choose[$i])
                            {
                                $student->class_id=0;
                                $student->save();
                            }
                        }
                        ClassAll::destroy($choose[$i]);
                    }
                }
                return Redirect::to('/admin.class')->with('status','delect');
                break;
        }
    }

    public function subjectall()
    {
        $subject=Subject::all();
        $teacher=Teacher::all();
        $classall=ClassAll::all();
        return View::make('admin.subjectall')->with('subjects',$subject)->with('teachers',$teacher)->with('classall',$classall);
    }
    public function subjectadd()
    {
        $subjects=new Subject;
        $subjects->name=Input::get('subjectname');
        $subjects->class_id=Input::get('class');
        $subjects->teacher_id=Input::get('teacher');
        $subjects->enabled=1;
        $subjects->save();
        return Redirect::to('/admin.subject')->with('status','add');
    }
    public function subjectaction($action,$id)
    {
        switch ($action)
        {
            case 'modify':
                $teacher=Teacher::all();
                $subject=Subject::find($id);
                $classall=ClassAll::all();
                return View::make('admin.subjectmodify')->with('teachers',$teacher)->with('classall',$classall)->with('subject',$subject)->with('id',$id);
                break;
            case 'del':
                $cources=Cource::all();
                foreach($cources as $cource)
                {
                    if($cource->subject_id==$id)
                    {
                        $cource->delect();
                    }
                }
                Subject::destroy($id);
                return Redirect::to('/admin.subject')->with('status','delect');
                break;
        }
    }
    public function subjectwrite($action,$id = null)
    {
        switch ($action)
        {
            case 'modify':
                $subject=Subject::find(Input::get('id'));
                $subject->name=Input::get('subjectname');
                $subject->teacher_id=Input::get('teacher');
                $subject->class_id=Input::get('classchoose');
                $subject->enabled=Input::get('enable');
                $subject->save();
                return Redirect::to('/admin.subject')->with('status','modify');
                break;
            case 'delall':
                $choose=Input::get('subjects');
                if(isset($choose))
                {
                    for($i=0;$i<count($choose);$i++)
                    {
                        $cources=Cource::all();
                        foreach($cources as $cource)
                        {
                            if($cource->subject_id==$choose[$i])
                            {
                                $cource->delect();
                            }
                        }
                        Subject::destroy($choose[$i]);
                    }
                }
                return Redirect::to('/admin.subject')->with('status','delect');
                break;
        }
    }

    public function studentall()
    {
        $student=Student::all();
        return View::make('admin.studentall')->with('students',$student);
    }
    public function studentaction($action,$id)
    {
        switch ($action)
        {
            case 'modify':
                $classall=ClassAll::all();
                $student=Student::find($id);
                return View::make('admin.studentadd')->with('classall',$classall)->with('student',$student)->with('id',$id);
                break;
            case 'del':
                Student::destroy($id);
                return Redirect::to('/admin.student')->with('status','delect');
                break;
        }
    }
    public function studentadd()
    {
        $classall=ClassAll::all();
        return View::make('admin.studentadd')->with('classall',$classall);
    }
    public function studentwrite($action,$id = null)
    {
        switch ($action)
        {
            case 'add':
                $student=new Student;
                $student->name=Input::get('name');
                $student->seat=Input::get('number');
                $student->account=Input::get('account');
                $student->password=sha1(sha1(Input::get('password')) . "place");
                $student->class_id=Input::get('classname');
                $student->save();
                return Redirect::to('/admin.student')->with('status','add');
                break;
            case 'modify':
                $student=Student::find(Input::get('id'));
                $student->name=Input::get('name');
                $student->seat=Input::get('number');
                $student->account=Input::get('account');
                if(Input::get('password')!="oooooooo") {
                    $student->password = sha1(sha1(Input::get('password')) . "place");
                }
                $student->class_id=Input::get('classname');
                $student->save();
                return Redirect::to('/admin.student')->with('status','modify');
                break;
            case 'delall':
                $choose=Input::get('students');
                if(isset($choose))
                {
                    for($i=0;$i<count($choose);$i++)
                    {
                        Student::destroy($choose[$i]);
                    }
                }
                return Redirect::to('/admin.student')->with('status','delect');
                break;
        }
    }

    public function teacherall()
    {
        $teacher=Teacher::all();
        $classall=ClassAll::all();
        return View::make('admin.teacherall')->with('teachers',$teacher)->with('classall',$classall);
    }
    public function teacheradd()
    {
        $classall=ClassAll::all();
        return View::make('admin.teacheradd')->with('classall',$classall);
    }
    public function teacheraction($action,$id)
    {
        switch ($action)
        {
            case 'modify':
                $classall=ClassAll::all();
                $teacher=Teacher::find($id);
                return View::make('admin.teacheradd')->with('classall',$classall)->with('teacher',$teacher)->with('id',$id);
                break;
            case 'del':
                Teacher::destroy($id);
                return Redirect::to('/admin.teacher')->with('status','delect');
                break;
        }
    }
    public function teacherwrite($action,$id = null)
    {
        switch ($action)
        {
            case 'add':
                $teacher=new Teacher;
                $teacher->name=Input::get('name');
                $teacher->account=Input::get('account');
                $teacher->password=sha1(sha1(Input::get('password')) . "place");
                $teacher->class_id=Input::get('classname');
                $teacher->save();
                return Redirect::to('/admin.teacher')->with('status','add');
                break;
            case 'modify':
                $teacher=Teacher::find(Input::get('id'));
                $teacher->name=Input::get('name');
                $teacher->account=Input::get('account');
                if(Input::get('password')!="oooooooo") {
                    $teacher->password = sha1(sha1(Input::get('password')) . "place");
                }
                $teacher->class_id=Input::get('classname');
                $teacher->save();
                return Redirect::to('/admin.teacher')->with('status','modify');
                break;
            case 'delall':
                $choose=Input::get('teachers');
                if(isset($choose))
                {
                    for($i=0;$i<count($choose);$i++)
                    {
                        Teacher::destroy($choose[$i]);
                    }
                }
                return Redirect::to('/admin.teacher')->with('status','delect');
                break;
        }
    }

    public function adminall()
    {
        $admin=User::all();
        return View::make('admin.adminall')->with('admins',$admin);
    }
    public function adminadd()
    {
        return View::make('admin.adminadd');
    }
    public function adminaction($action,$id)
    {
        switch ($action)
        {
            case 'modify':
                $admin=User::find($id);
                return View::make('admin.adminadd')->with('admin',$admin)->with('id',$id);
                break;
            case 'del':
                User::destroy($id);
                return Redirect::to('/admin.admin')->with('status','delect');
                break;
        }
    }
    public function adminwrite($action,$id = null)
    {
        switch ($action)
        {
            case 'add':
                $admin=new User;
                $admin->name=Input::get('name');
                $admin->account=Input::get('account');
                $admin->password=Hash::make(Input::get('password'));
                $admin->save();
                return Redirect::to('/admin.admin')->with('status','add');
                break;
            case 'modify':
                $admin=User::find(Input::get('id'));
                $admin->name=Input::get('name');
                $admin->account=Input::get('account');
                if(Input::get('password')!="oooooooo") {
                    $admin->password = Hash::make(Input::get('password'));
                }
                $admin->save();
                return Redirect::to('/admin.admin')->with('status','modify');
                break;
            case 'delall':
                $choose=Input::get('admins');
                if(isset($choose))
                {
                    for($i=0;$i<count($choose);$i++)
                    {
                        User::destroy($choose[$i]);
                    }
                }
                return Redirect::to('/admin.admin')->with('status','delect');
                break;
        }
    }
    public function logall()
    {
        $log=Syslog::all();
        return View::make('admin.logall')->with('logs',$log);
    }
    public function logclear()
    {
        DB::statement('TRUNCATE TABLE syslog');
        return Redirect::to('/admin.log')->with('status','clear');
    }
    public function setting()
    {
        return View::make('admin.setting');
    }
    public function status($action)
    {
        switch($action)
        {
            case 'open':
                $setting=Setting::find(0);
                $setting->server_state=1;
                $setting->admin_id=Auth::user()->id;
                $setting->save();
                return Redirect::to('/admin.setting')->with('status', 'open');
                break;
            case 'stop':
                $setting=Setting::find(0);
                $setting->server_state=0;
                $setting->admin_id=Auth::user()->id;
                $setting->save();
                return Redirect::to('/admin.setting')->with('status', 'stop');
                break;
        }
    }



    public function logout()
    {
        yslog(Auth::user()->account,"admin","logout","success");
        Auth::logout();
        return Redirect::to('/admin')->with('logout', '#');
    }
}

