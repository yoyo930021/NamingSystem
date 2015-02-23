<?php
/**
 * Created by PhpStorm.
 * User: yoyoiu
 * Date: 2015/2/21
 * Time: 下午 2:05
 */
//Post模型 學程內容
class Post extends Eloquent{
    //指定資料表
    protected $table='post';
    //關閉自動維護時間欄位
    public $timestamps = false;
    protected $fillable = array('id','title','author','content');

}
