<?php
//Subject模型 課程資料
class Cource extends Eloquent{
  //指定資料表
	protected $table='cource';
  //關閉自動維護時間的欄位
	public $timestamps = false;
}
