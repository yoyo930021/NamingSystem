<?php
//Subject模型 課程資料
class Subject extends Eloquent{
  //指定資料表
	protected $table='subject';
  //關閉自動維護時間的欄位
	public $timestamps = false;
    protected $fillable = array('name','class_id','teacher_id','enabled');
}
