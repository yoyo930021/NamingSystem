<?php
//Teacher模型 老師資料
class Teacher extends Eloquent{
  //指定資料表
	protected $table='teacher';
  //關閉自動維護時間的欄位
	public $timestamps = false;
    protected $fillable = array('name','class_id','account','password');
}
