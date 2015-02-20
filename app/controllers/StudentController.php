<?php
/**
 * Created by PhpStorm.
 * User: yckao85
 * Date: 15/2/18
 * Time: 下午6:07
 */
class StudentController extends BaseController {
    public $id;
    private $student_Name;
    public $student_Class;
    private $courses;
    private $action;

    private function getStudentClassInfo($id){
        $result=DB::select('select * from student where id = ?', array($id));
        return $result;
    }

    private function getStudentCourseStatus(){
        echo 'getStudentCourseStatus';
    }

    public function init($id,$action){
        switch ($action){
            case 'ClassInfo':
                $this->getStudentClassInfo($id);
                break;
            case 'CourseStatus':
                $this->getStudentCourseStatus();
                break;
            default:
                return $action.' Not Found.';
        }
    }
}

class course {
    public $id;
    public $subject_id;
    public $startTime;
    public $endTime;
}

