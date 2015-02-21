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
        return $class->name;
    }
}
