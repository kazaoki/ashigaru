<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
// use \Illuminate\Database\Capsule\Manager as DB;

/**
 * 管理者モデル
 */
class Admin extends Model
{
	protected $table = 'admins';
	protected $fillable = [
		'id',
		'created_at',
		'updated_at',
		'status',
		'login_id',
		'login_pw',
	];

	/**
	 * リレーション：login_sessions
	 */
	public function login_sessions()
	{
		return $this->hasMany('App\Models\LoginSession', 'login_id', 'login_id');
	}
}
