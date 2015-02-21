<?php
/**
 * Created by PhpStorm.
 * User: yckao85
 * Date: 15/2/21
 * Time: 下午1:01
 */
class ClassController extends BaseController {
    public function info($id){
        $class=Classes::find($id);
        $students=Student::where('class_id', '=', $id);
        $teacher=Teacher::find($class->teacher_id);
        return '{"Teacher":'.$teacher->toJson().',"Students":'.$students->select(array('id', 'name'))->get()->toJson().'}';
    }
}
