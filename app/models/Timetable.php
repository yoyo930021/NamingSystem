<?php
//Timetable模型 課表
class Timetable extends Eloquent{
    //指定資料表
	protected $table='timetable';
    //關閉自動維護時間的欄位
	public $timestamps = false;
    protected $fillable = array('class_id','week','section','subject_id');
    public function subject()
    {
        return $this->hasOne('Subject','id','subject_id');
    }
}
