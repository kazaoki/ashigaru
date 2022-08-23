<?php

global $_VALIDON;
global $_VALIDON_ENV;
mb_language('Japanese');
mb_internal_encoding('utf-8');

/**
 * Validon設定
 */
// 定義がない場合の警告（true:する false:しない）
$_VALIDON_ENV['NOTICE'] = false;
// 自動トリム機能
$_VALIDON_ENV['TRIM'] = true;
// 値ごとの共通事前バリデート
// $_VALIDON_ENV['BEFORE'] = function($key, &$value, &$params, &$errors, &$changes){ error_log('<<< BEFORE >>>'); };
// 値ごとの共通事後バリデート
// $_VALIDON_ENV['AFTER'] = function($key, &$value, &$params, &$errors, &$changes){ error_log('<<< AFTER >>>'); };

/**
 * 状態
 */
$_VALIDON['status'] = function(&$value, &$params, &$errors, &$changes)
{
	// 条件
	if(!strlen($value)) return 'どちらか選択してください。';
};

/**
 * 公開日時
 */
$_VALIDON['published_date'] = function(&$value, &$params, &$errors, &$changes)
{
	// 条件
	if(!strlen($value)) return '日付を入力してください。';
};
$_VALIDON['published_time'] = function(&$value, &$params, &$errors, &$changes)
{
	// 条件
	if(!strlen($value)) return '時間を入力してください。';
};

/**
 * タイトル
 */
$_VALIDON['title'] = function(&$value, &$params, &$errors, &$changes)
{
	// 条件
	if(!strlen($value)) return '入力してください。';
};

/**
 * カテゴリ
 */
$_VALIDON['category_id'] = function(&$value, &$params, &$errors, &$changes)
{
	// 条件
	if(!strlen($value)) return '選択してください。';
};

/**
 * 記事タイプ
 */
$_VALIDON['type'] = function(&$value, &$params, &$errors, &$changes)
{
	// 条件
	if(!strlen($value)) return '選択してください。';
};

/**
 * 本文
 */
$_VALIDON['content'] = function(&$value, &$params, &$errors, &$changes)
{
	// 条件
	if('entry'===$params['type']) {
		if(!strlen($value)) return '入力してください。';
	}
};

/**
 * PDFファイルアップロード
 */
$_VALIDON['pdf'] = function(&$value, &$params, &$errors, &$changes)
{
	// 条件
	if('pdf'===$params['type']) {
		if(is_array($value)) {
			if($value['size']>1024*1024*5) return '5MBを超えないファイルを選択してください。';
		} else {
			if(!($params['pdf_upped'] || $params['pdf_base64'])) return 'PDFファイルを選択してください。';
		}
	}
};

/**
 * URLリンク
 */
$_VALIDON['url'] = function(&$value, &$params, &$errors, &$changes)
{
	// 条件
	if('url'===$params['type']) {
		if(!strlen($value)) return '入力してください。';
	}
};
