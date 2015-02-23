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


    public function logout()
    {
        yslog(Auth::user()->account,"admin","logout","success");
        Auth::logout();
        return Redirect::to('/admin')->with('logout', '#');
    }
}

