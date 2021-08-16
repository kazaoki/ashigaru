<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Capsule\Manager as DB;

/**
 * 管理者モデル
 */
class LoginSession extends Model
{
	protected $table = 'login_sessions';
	protected $fillable = [
		'id',
		'created_at',
		'updated_at',
		'status',
		'login_id',
		'access_ip',
		'session_id',
	];

	/**
	 * リレーション：admin
	 */
	public function admin()
	{
		return $this->belongsTo('App\Models\Admin', 'login_id', 'login_id');
	}
}
