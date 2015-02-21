<?php
/**
 * Created by PhpStorm.
 * User: yckao85
 * Date: 15/2/21
 * Time: 下午12:52
 */
class Student extends Eloquent {

    public $table = 'student';
    public $timestamps = false;
    public $hidden = array('password','account');
}
