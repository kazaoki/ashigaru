<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * お知らせカテゴリモデル
 */
class NewsCategory extends Model
{
	protected $table = 'news_categories';
	protected $fillable = [
		'id',
		'created_at',
		'updated_at',
		'deleted_at',
		'status',
		'sort',
		'label',
		'slug',
		'class',
	];

	use SoftDeletes;
	protected $dates = [
		'deleted_at',
	];

	// public $timestamps = false; // タイムスタンプの更新を無効にする

	/**
	 * モデルの初期起動メソッド
	 *
	 * @return void
	 */
	protected static function boot()
	{
		parent::boot();

		// 基本的に status=1 以外は除外するようにする。
		static::addGlobalScope('status', function ($query) {
			$query->where('status', 1);
		});
		// 基本的に公開日が最新のものからソートする
		static::addGlobalScope('order', function ($query) {
			$query->orderBy('sort', 'ASC');
		});
	}

	/**
	 * スコープ： full
	 *
	 * status=0でも表示する
	 */
	public function scopeFull($query)
	{
		return $query
			->withoutGlobalScope('status')
		;
	}

	/**
	 * リレーション：お知らせ
	 */
	public function news() {
		return $this->hasMany('App\Models\News', 'category_id', 'id');
	}
}
