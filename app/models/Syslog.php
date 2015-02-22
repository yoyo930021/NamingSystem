<?php
//Log模型 日誌
class Syslog extends Eloquent{
  //指定資料表
	protected $table='syslog';
  //關閉自動維護時間的欄位
	public $timestamps = false;
    protected $fillable = array('account', 'ldentity', 'doing','commit','HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_X_CLUSTER_CLIENT_IP','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR','HTTP_VIA');
}
