<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * お知らせモデル
 */
class News extends Model
{
	protected $table = 'news';
	protected $fillable = [
		'id',
		'created_at',
		'updated_at',
		'deleted_at',
		'status',
		'published_at',
		'title',
		'content',
		'category_id',
		'type',
		'url',
		'is_blank',
		'pdf_filename',
		'published_date', // published_at をアクセサ/ミューテタで分割
		'published_time', // published_at をアクセサ/ミューテタで分割
	];
	protected $appends = [
		'is_reserved',
	];
	protected $attributes = [ // 初期値
		'type' => 'entry',
		'published_at' => 'NOW',
	];

	use SoftDeletes;
	// protected $dates = [
	// 	'deleted_at',
	// 	'published_at',
	// ];
	protected $casts = [
		'deleted_at'   => 'datetime',
		'published_at' => 'datetime',
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
		// 基本的に公開日時が未来のものを除外するようにする。
		static::addGlobalScope('pastonly', function ($query) {
			$query->where('published_at', '<', DB::raw('CURRENT_TIMESTAMP'));
		});
		// 基本的に公開日が最新のものからソートする
		static::addGlobalScope('order', function ($query) {
			$query->orderBy('published_at', 'DESC');
			$query->orderBy('status', 'ASC');
		});
	}

	/**
	 * スコープ： full
	 *
	 * status=0でも未来の記事でも表示する
	 */
	public function scopeFull($query)
	{
		return $query
			->withoutGlobalScope('status')
			->withoutGlobalScope('pastonly')
		;
	}

	/**
	 * 追加属性：予約投稿であればTRUEを返す（公開状態で公開日時が未来になっているか）
	 */
	public function getIsReservedAttribute() {
		return (int)$this->status===1 && $this->published_at->isFuture();
	}

	/**
	 * アクセサ：「公開日時」を元に「公開日」「公開時間」を返す
	 */
	public function getPublishedDateAttribute() {
		return $this->published_at
			? $this->published_at->format('Y-m-d')
			: null
		;
	}
	public function getPublishedTimeAttribute() {
		return $this->published_at
			? $this->published_at->format('H:i')
			: null
		;
	}

	/**
	 * アクセサ：パーマリンク
	 */
	public function getPermalinkAttribute() {
		if('url'===$this->type) {
			// URLリンク
			return $this->url;
		} else if('pdf'===$this->type) {
			// PDFリンク
			return __SITE__.'/news/pdf/'.$this->id.'/';
		} else {
			// 通常記事
			return __SITE__.'/news/entry/'.$this->id.'/';
		}
	}

	/**
	 * アクセサ：URL及びPDF記事の時のみ、別ウィンドウが有効なら「 target="_balnk"」を返す
	 */
	public function getPermalinkBlankAttribute() {
		return in_array($this->type, ['url', 'pdf']) && $this->is_blank ? ' target="_blank"' : false;
	}

	/**
	 * ミューテタ：「公開日」「公開時間」を設定すると自動的に「公開日時」の値を更新するようにする
	 */
	public function setPublishedDateAttribute($value) {
		$this->attributes['published_at'] = $value . ' ' . date('H:i:s', strtotime(@$this->attributes['published_at']));
	}
	public function setPublishedTimeAttribute($value) {
		$this->attributes['published_at'] = date('Y-m-d', strtotime(@$this->attributes['published_at'])) . ' ' . $value;
	}

	/**
	 * ミューテタ：「別ウィンドウで開く」が未選択の場合は null を自動的にセット
	 */
	public function setIsBlankAttribute($value) {
		$this->attributes['is_blank'] = $value ?: null;
	}

	/**
	 * リレーション：お知らせカテゴリ
	 */
	public function category() {
		return $this->belongsTo('App\Models\NewsCategory');
	}
}
