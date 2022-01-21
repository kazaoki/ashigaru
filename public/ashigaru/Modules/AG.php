<?php

// バージョン
define('__ASHIGARU_VERSION__', '1.0.1');

class AG
{
	/**
	 * アクセスしてきたIPを返す（プロクシやフォワード先のちゃんとしたクライアントIP）
	 *
	 * @return string
	 */
	public static function access_ip()
	{
		return
		@$_SERVER['REMOTE_ADDR']
			? $_SERVER['REMOTE_ADDR']
			: (
				@$_SERVER['HTTP_X_FORWARDED_FOR']
					? $_SERVER['HTTP_X_FORWARDED_FOR']
					: @$_SERVER['HTTP_X_ORIGINAL_FORWARDED_FOR']
			)
		;
	}

	/**
	 * HTMLエスケープ
	 *
	 * @param mixed $raw_string
	 * @return string
	 */
	public static function h($raw_string)
	{
		return htmlspecialchars($raw_string, ENT_QUOTES, 'UTF-8');
	}

	/**
	 * Flashメッセージ追加
	 *
	 * ex. \AG::flash_set('データの登録に成功しました。', 'primary'); // primary, success, warning, danger
	 *
	 * @param string $message
	 * @param string $class
	 * @return $added_session_data
	 * @see https://getuikit.com/docs/alert
	 */
	public static function flash_set($message, $class='primary')
	{
		if(!@$_SESSION['flashes']) $_SESSION['flashes'] = [];
		return $_SESSION['flashes'][] = [
			'message' => $message,
			'class'   => $class,
		];
	}

	/**
	 * Flashメッセージ取得＆クリア
	 *
	 * ex. $flashes = \AG::flash_get();
	 * ex. foreach(\AG::flash_get() as $flash) { $flash['message']... $flash['class']... };
	 *
	 * @return $flashes
	 */
	public static function flash_get()
	{
		$flashes = isset($_SESSION['flashes']) ? $_SESSION['flashes'] : null;
		unset($_SESSION['flashes']);
		return $flashes;
	}

	/**
	 * CSRFトークンを返す
	 *
	 * @return string $token
	 * @see https://qiita.com/mpyw/items/8f8989f8575159ce95fc
	 */
	public static function csrf_generate()
	{
		if (session_status() === PHP_SESSION_NONE) {
			throw new \BadMethodCallException('Session is not active.');
		}
		return hash('sha256', session_id());
	}

	/**
	 * 引数からCSRFトークンを検証する（エラーの場合、false返しまたはthrow）
	 *
	 * @param string $token
	 * @param boolean $throw
	 * @return boolean
	 */
	public static function csrf_validate($token, $throw = false)
	{
		$success = self::csrf_generate() === $token;
		if(!$success && $throw) {
			throw new \RuntimeException('CSRF validation failed.', 400);
		}
		return $success;
	}

	/**
	 * INPUT値からCSRFトークンを検証する（エラーの場合、400エラーで終了）
	 *
	 * @param string $input_name
	 * @return void
	 */
	public static function csrf_check($input_name='csrf_token')
	{
		if(!self::csrf_validate(filter_input(INPUT_POST, $input_name))) {
			header('Content-Type: text/plain; charset=UTF-8', true, 400);
			die('CSRF validation failed.');
		}
	}

	/**
	 * ページナビ用情報を返す関数
	 *
	 * $pager = pager([
	 *     'now'   => 3,     // 現在のページ
	 *     'per'   => 10,    // 1ページに表示する個数
	 *     'count' => 5300,  // すべての個数
	 *     'links' => 5      // 表示したいページリンク個数（なるべく中心に現ページがくるようにリストが作らます）
	 *     'href_template' => 'https://xxx.com/list/page/%d/' // 各ページのURLを生成する際の雛形を用意。差し込み処理は用意してないので各自 sprintf()とかで使ってね。
	 * ]);
	 * 指定のページ数が正しくない場合は false のみ返す
	 *
	 * @param array $args
	 * @return $args
	 */
	public static function pager($args)
	{
		if (!@$args['links']) $args['links'] = 5;
		extract($args);
		$now = $now<1 ? 1 : intval($now);
		$last_page = intval($count / $per) + (($count % $per) ? 1 : 0);
		if ($last_page === 0) $last_page = 1;
		$pages = array();
		$head_page = $now - intval(($args['links'] - 1) / 2);
		if ($head_page < 1) $head_page = 1;
		$tail_page = $head_page + ($args['links'] - 1);
		if ($last_page < $tail_page) {
			$rest = $tail_page - $last_page;
			if ($head_page > $rest) {
				$head_page -= $rest;
				$tail_page = $head_page + $args['links'];
			}
		}
		foreach (range($head_page, $tail_page) as $page) {
			if ($last_page < $page) continue;
			$pages[] = array(
				'page' => $page,
				'active' => ($now == $page ? ' active' : ''),
			);
		}
		$tail_page = end($pages)['page'];
		$prev_page = $now - 1;
		if ($prev_page < 1) $prev_page = 1;
		$next_page = $now + 1;
		if ($next_page > $last_page) $next_page = $last_page;
		$show_from = ($now - 1) * $per + 1;
		$show_to = ($now == $last_page) ? $show_from + ($count - 1) % $per : $show_from + ($per - 1);
		$offset = $show_from - 1;
		$href_template = $args['href_template'];

		// 正しいページ数を指定されたか
		if(!(1<=$now && $now<=$last_page)) return false;

		// データまとめ
		$result = compact(
			'pages',
			'last_page',
			'head_page',
			'tail_page',
			'prev_page',
			'next_page',
			'now',
			'per',
			'count',
			'links',
			'show_from',
			'show_to',
			'offset',
			'href_template'
		);

		return $result;
	}

	/**
	 * hiddenを一度に返す（特定用途キー指定可能）
	 *
	 * @param array|null $keys [任意、未指定の場合は全データ]
	 * @param array|null $param
	 * @return string
	 */
	public static function hiddens($keys=null, $param=null)
	{
		$html = '';

		// パラメータセット
		if(null===$param) $param = array_merge($_GET, $_POST);

		// 指定キーのみ
		if(is_array($keys) && count($keys)) {
			$param = array();
			foreach($keys as $key) {
				$param[$key] = @$_POST[$key] ? @$_POST[$key] : @$_GET[$key];
			}
		}

		// 再帰関数定義
		$f = function($vars, $prefix) use(&$f, &$html) {
			foreach($vars as $key=>$value) {
				if(is_array($value)) {
					$f($value, strlen($prefix) ? $prefix.'['.$key.']' : $key);
				} else {
					$html .= '<input type="hidden" name="'.$prefix.($prefix ? '['.self::h($key).']' : self::h($key)).'" value="'.self::h($value).'">'."\n";
				}
			}
		};

		// 再帰実行
		$f($param, '');

		return $html;
	}

	/**
	 * 指定キーを除外してhiddenを一度に返す
	 *
	 * @param array|null $exclude_keys [必須]
	 * @param array|null $param
	 * @return string
	 */
	public static function hiddens_exclude($exclude_keys, $param=null)
	{
		$html = '';

		// パラメータセット
		if(null===$param) $param = array_merge($_GET, $_POST);

		// キー指定除外
		foreach($exclude_keys as $key) {
			unset($param[$key]);
		}

		// 再帰関数定義
		$f = function($vars, $prefix) use(&$f, &$html) {
			foreach($vars as $key=>$value) {
				if(is_array($value)) {
					$f($value, strlen($prefix) ? $prefix.'['.$key.']' : $key);
				} else {
					$html .= '<input type="hidden" name="'.$prefix.($prefix ? '['.static::h($key).']' : static::h($key)).'" value="'.static::h($value).'">'."\n";
				}
			}
		};

		// 再帰実行
		$f($param, '');

		return $html;
	}

	/**
	 * 指定ファイルが指定の拡張子かどうか
	 * -------------------------------------------------------------------------------------------------
	 *
	 * @param $file string
	 * @param $exts string|array
	 * @return bool
	 */
	public static function in_exts($filename, $exts) {
		if(!is_array($exts)) $exts = [$exts];
		return in_array(
			strtolower(pathinfo($filename, PATHINFO_EXTENSION)),
			$exts
		);
	}

	/**
	 * 指定ファイルをimgタグのsrc属性用にロードして整形する
	 * -------------------------------------------------------------------------------------------------
	 *
	 * @param $file string
	 * @return string
	 */
	public static function get_base64_src($file) {
		if(!file_exists($file)) return false;
		$src = '';
		switch(exif_imagetype($file)){
			case IMAGETYPE_GIF  : $src = 'data:image/gif;base64,'; break;
			case IMAGETYPE_JPEG : $src = 'data:image/jpeg;base64,'; break;
			case IMAGETYPE_PNG  : $src = 'data:image/png;base64,'; break;
			default : $src = 'data:application/octet-stream;base64,';
		}
		return $src.base64_encode(file_get_contents($file));
	}

	/**
	 * 指定ファイルの拡張子を返す（exif_imagetype()使用）
	 * -------------------------------------------------------------------------------------------------
	 *
	 * @param $file string
	 * @return string
	 */
	public static function get_ext_from_file($file) {
		$ext = '';
		switch(exif_imagetype($file)){
			case IMAGETYPE_GIF  : $ext = 'gif'; break;
			case IMAGETYPE_JPEG : $ext = 'jpg'; break;
			case IMAGETYPE_PNG  : $ext = 'png'; break;
			default : $ext = false;
		}
		return $ext;
	}

	/**
	 * 拡張子なしのファイルベース名とパスと拡張子郡と渡し、最初に見つかった拡張子のファイル名を返す
	 * -------------------------------------------------------------------------------------------------
	 */
	public static function find_file($basename, $path, $exts=['jpg', 'jpeg', 'jpe', 'png', 'gif'])
	{
		if(!strlen($basename)) return;
		foreach($exts as $ext) {
			if(file_exists($path.'/'.$basename.'.'.$ext)) return $basename.'.'.$ext;
		}
	}

	/**
	 * BASE64で入ってきたPOSTデータを元に、ファイルを保存/更新/削除する
	 * -------------------------------------------------------------------------------------------------
	 */
	public static function base64_submit($filebase, $uploads_path, $base64=null, $delete=null)
	{
		if(!($base64||$delete)) return;

		// 新たなファイルが指定されているか
		if($base64) {
			// 新たにファイルがあれば既存のは削除
			foreach (glob($uploads_path.'/'.$filebase.'.*') as $filepath) {
				unlink($filepath);
			}

			// 新たなファイルを保存
			$tmpfile = tempnam('/tmp', 'ag-');
			file_put_contents($tmpfile, base64_decode(preg_replace('/^.*?base64\,/', '', $base64)));
			$ext = self::get_ext_from_file($tmpfile);
			chmod($tmpfile, 0644);
			$outfile = $uploads_path.'/'.$filebase.'.'.$ext;
			rename($tmpfile, $outfile);
			return $outfile;
		}

		// 削除指定の場合削除。
		else if($delete) {
			self::delete_by_glob($filebase.'.*', $uploads_path);
		}
	}

	/**
	 * ワイルドカードでファイル一掃
	 * -------------------------------------------------------------------------------------------------
	 */
	public static function delete_by_glob($glob, $uploads_path)
	{
		foreach (glob($uploads_path.'/'.$glob) as $filepath) {
			unlink($filepath);
		}
	}

	/**
	 * 指定画像ファイルを指定のサイズ以内にリサイズ（サイズ内に収まっていれば何もしない。
	 * -------------------------------------------------------------------------------------------------
	 */
	public static function resize(string $file, int $max_width, int $max_height)
	{
		// ファイル情報読み出し
		list($org_width, $org_height, $type) = getimagesize($file);

		// 画像データロード
		switch ($type) {
			case IMAGETYPE_JPEG: $original = @imagecreatefromjpeg($file); break;
			case IMAGETYPE_PNG:  $original = @imagecreatefrompng($file);  break;
			case IMAGETYPE_GIF:  $original = @imagecreatefromgif($file);  break;
			default: return false;
		}
		if(!$original) return false;

		// サイズ内に収まっていれば何もしない。
		if($org_width <= $max_width && $org_height <= $max_height) return true;

		// リサイズ
		if(($org_width / $org_height) <= ($max_width / $max_height)) {
			$new_width = $max_height * ($org_width / $org_height);
			$new_height = $max_height;
		} else {
			$new_width = $max_width;
			$new_height = $max_width * ($org_height / $org_width);
		}
		$canvas = imagecreatetruecolor($new_width, $new_height);
		imagecopyresampled($canvas, $original, 0, 0, 0, 0, $new_width, $new_height, $org_width, $org_height);

		// 保存
		switch ($type) {
			case IMAGETYPE_JPEG: imagejpeg($canvas, $file);   break;
			case IMAGETYPE_PNG:  imagepng($canvas, $file, 9); break;
			case IMAGETYPE_GIF:  imagegif($canvas, $file);    break;
			default: return false;
		}

		// メモリ解放
		@imagedestroy($original);
		@imagedestroy($canvas);

		return true;
	}

	/**
	 * 指定文字数よりながければカットして「...」付けて返す
	 * -------------------------------------------------------------------------------------------------
	 */
	public static function string_cut(string $text, int $limit, string $tail_char='...')
	{
		return mb_strlen($text) > $limit
			? mb_substr($text, 0, $limit).$tail_char
			: $text
		;
	}
}
