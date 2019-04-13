<?php

if (! function_exists('str_replace_first')) {
	/**
	 * Replaces only the first occurence of needle in a haystack.
	 *
	 * @param string $search
	 * @param string $replace
	 * @param string $subject
	 *
	 * @return null|string|string[]
	 */
	function str_replace_first(string $search, string $replace, string $subject)
	{
		$search = '/' . preg_quote($search, '/') . '/';

		return preg_replace($search, $replace, $subject, 1);
	}
}

if (! function_exists('normalized_path')) {
	/**
	 * Normalizes filepaths to uniform, predictable format.
	 *
	 * @param string $path
	 *
	 * @return string
	 */
	function normalized_path(string $path): string
	{
		$path = str_replace('/', '\\', $path);
		$path = str_replace('\\\\', '\\', $path);
		$path = str_replace('\\.\\', '\\', $path);

		return $path;
	}
}