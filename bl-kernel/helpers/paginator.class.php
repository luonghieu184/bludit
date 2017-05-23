<?php defined('BLUDIT') or die('Bludit CMS.');

class Paginator {

	public static $pager = array(
		'itemsPerPage'=>0,
		'amountOfPages'=>1,
		'amountOfItems'=>0,
		'firstPage'=>1,
		'nextPage'=>1,
		'prevPage'=>1,
		'currentPage'=>1,
		'showPrev'=>false,
		'showNext'=>false,
		'showNextPrev'=>false
	);

	public static function set($key, $value)
	{
		self::$pager[$key] = $value;
	}

	public static function get($key)
	{
		return self::$pager[$key];
	}

	public static function amountOfPages()
	{
		return self::get('amountOfPages');
	}

	public static function nextPage()
	{
		return self::get('nextPage');
	}

	public static function prevPage()
	{
		return self::get('prevPage');
	}

	public static function showNext()
	{
		return self::get('showNext');
	}

	public static function showPrev()
	{
		return self::get('showPrev');
	}

	public static function firstPage()
	{
		return self::get('firstPage');
	}

	// Returns the absolute URL for the first page
	public static function firstPageUrl()
	{
		return self::absoluteUrl( self::firstPage() );
	}

	// Returns the absolute URL for the last page
	public static function lastPageUrl()
	{
		return self::absoluteUrl( self::amountOfPages() );
	}

	// Returns the absolute URL for the next page
	public static function nextPageUrl()
	{
		return self::absoluteUrl( self::nextPage() );
	}

	// Returns the absolute URL for the previous page
	public static function prevPageUrl()
	{
		return self::absoluteUrl( self::prevPage() );
	}

	// Return the absoulte URL with the current filter
	public static function absoluteUrl($pageNumber)
	{
		global $Url;

		$domain = trim(DOMAIN_BASE,'/');
		$filter = trim($Url->activeFilter(), '/');

		if(empty($filter)) {
			$url = $domain.'/'.$Url->slug();
		}
		else {
			$url = $domain.'/'.$filter.'/'.$Url->slug();
		}

		return $url.'?page='.$pageNumber;
	}

	public static function html($textPrevPage=false, $textNextPage=false, $showPageNumber=false)
	{
		global $Language;

		$html  = '<div id="paginator">';
		$html .= '<ul>';

		if(self::get('showNewer'))
		{
			if($textPrevPage===false) {
				$textPrevPage = '« '.$Language->g('Prev page');
			}

			$html .= '<li class="left">';
			$html .= '<a href="'.self::urlPrevPage().'">'.$textPrevPage.'</a>';
			$html .= '</li>';
		}

		if($showPageNumber) {
			$html .= '<li class="list">'.(self::get('currentPage')+1).' / '.(self::get('numberOfPages')+1).'</li>';
		}

		if(self::get('showOlder'))
		{
			if($textNextPage===false) {
				$textNextPage = $Language->g('Next page').' »';
			}

			$html .= '<li class="right">';
			$html .= '<a href="'.self::urlNextPage().'">'.$textNextPage.'</a>';
			$html .= '</li>';
		}

		$html .= '</ul>';
		$html .= '</div>';

		return $html;
	}

}