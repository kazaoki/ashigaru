<?php

/**
 * 追加のユーザー関数/ドメイン関数はこちらに。
 */
function now_active($slug)
{
	global $page_slugs;
	return @in_array($slug, @$page_slugs) ? 'active':'';
}
