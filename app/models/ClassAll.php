<?php
/**
 * Created by PhpStorm.
 * User: yoyoiu
 * Date: 2015/2/21
 * Time: 下午 2:05
 */
//Class模型  班級
class ClassAll extends Eloquent{
    //指定資料表
    protected $table='class';
    //關閉自動維護時間欄位
    public $timestamps = false;
    protected $fillable = array('name','teacher_id','enabled');
    public function teacher()
    {
        return $this->hasOne('Teacher','class_id');
    }
    public function student()
    {
        return $this->hasMany('Student','class_id');
    }

}
