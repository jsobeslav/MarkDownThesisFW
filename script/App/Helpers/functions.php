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

if (! function_exists('md_method_regex')) {
	/**
	 * Shorthand for constructing a regex that identifies a custom method in MarkDown files.
	 *
	 * @return string
	 */
	function md_method_regex(): string
	{
		$methodName = '\?\[([\w-]+)\]';           // ?[method-name] - mandatory
		$parameter  = '(?:\(([\w:_\.\\\\]+)\))?'; // (whatever/parameter:you_want) - optional

		return '/' . $methodName . $parameter . $parameter . $parameter . '/';
	}
}