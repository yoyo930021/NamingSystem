<?php
/**
 * Created by PhpStorm.
 * User: yckao85
 * Date: 15/2/18
 * Time: 下午6:07
 */
class course {
    public $id;
    public $subject_id;
    public $startTime;
    public $endTime;
}

class StudentController extends BaseController {
    public $id;
    private $student_Name;
    public $student_Class;
    private $courses;
    private $action;

    public function init($id,$action){
        switch ($action){
            case 'ClassInfo':
                getStudentClassInfo();
                break;
            case 'CourseStatus':
                getStudentCourseStatus();
                break;
            default:
                echo $action.'Not Found';
        }
    }

    private function getStudentClassInfo(){

    }

    private function getStudentCourseStatus(){

    }

}