<?php

namespace Ag;

class AccessIp
{
	static public function get() {
		return
			@$_SERVER['REMOTE_ADDR'] ??
			@$_SERVER['HTTP_X_FORWARDED_FOR'] ??
			@$_SERVER['HTTP_X_ORIGINAL_FORWARDED_FOR']
		;
	}
}
