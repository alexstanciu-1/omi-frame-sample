<?php
/**
  * This file was generated and it will be overwritten when it's dependencies are changed or removed.
  */

namespace MyCompany\Ecomm;

class AppController implements \QIUrlController
{


	public static function GetUrl_($_this, $tag, &$url = null, $_arg0 = null, $_arg1 = null, $_arg2 = null, $_arg3 = null, $_arg4 = null, $_arg5 = null, $_arg6 = null, $_arg7 = null, $_arg8 = null, $_arg9 = null, $_arg10 = null, $_arg11 = null, $_arg12 = null, $_arg13 = null, $_arg14 = null, $_arg15 = null)
	{
		$_tag_parts = null;
		$tag = is_string($tag) ? reset($_tag_parts = explode("/", $tag)) : reset($_tag_parts = $tag);
		$_shift = false;
		switch ($tag)
		{
			case "misc":
			{
				$_called = ($url === null);
				$url = ($url !== null) ? $url : array();
				if ($_this && ($_this->parentPrefixUrl !== null))
					$url[] = $_this->parentPrefixUrl;
				self::GetUrl_($_this, "orders", $url);
				$extra = $_arg0;
				$url[] = $url_part =  "misc".($extra ? "/".$extra : "");
				if (!next($_tag_parts))
					return $_called ? implode("/", $url) : $url;
				break;

			}
		
			case "orders":
			{
				$_called = ($url === null);
				$url = ($url !== null) ? $url : array();
				if ($_this && ($_this->parentPrefixUrl !== null))
					$url[] = $_this->parentPrefixUrl;
				$url[] = $url_part = qTranslate("orders");
				if (!next($_tag_parts))
					return $_called ? implode("/", $url) : $url;
				if ((!$_shift) && ($_shift = true))
					array_shift($_tag_parts);
				if (($return = View\OrderCtrl::GetUrl_(null, $_tag_parts, $url, $_arg0, $_arg1, $_arg2, $_arg3, $_arg4, $_arg5, $_arg6, $_arg7, $_arg8, $_arg9, $_arg10, $_arg11, $_arg12, $_arg13, $_arg14, $_arg15)))
					return $_called ? implode("/", $url) : $url;
				break;

			}
		
			default:
			{
				$_called = ($url === null);
				$url = ($url !== null) ? $url : array();
				if ($_this && $_this->parentPrefixUrl)
					$url[] = $_this->parentPrefixUrl;
				// we put includes that are in <urls> here
				if (($return = View\OrderCtrl::GetUrl_(null, $_tag_parts, $url, $_arg0, $_arg1, $_arg2, $_arg3, $_arg4, $_arg5, $_arg6, $_arg7, $_arg8, $_arg9, $_arg10, $_arg11, $_arg12, $_arg13, $_arg14, $_arg15)))
					return $_called ? implode("/", $url) : $url;
				break;
			}
		}
	}

	public static function GetUrl($tag, &$url = null, $_arg0 = null, $_arg1 = null, $_arg2 = null, $_arg3 = null, $_arg4 = null, $_arg5 = null, $_arg6 = null, $_arg7 = null, $_arg8 = null, $_arg9 = null, $_arg10 = null, $_arg11 = null, $_arg12 = null, $_arg13 = null, $_arg14 = null, $_arg15 = null)
	{
		return self::GetUrl_(null, $tag, $url, $_arg0, $_arg1, $_arg2, $_arg3, $_arg4, $_arg5, $_arg6, $_arg7, $_arg8, $_arg9, $_arg10, $_arg11, $_arg12, $_arg13, $_arg14, $_arg15);
	}

	public function getUrlForTag_($tag, &$url = null, $_arg0 = null, $_arg1 = null, $_arg2 = null, $_arg3 = null, $_arg4 = null, $_arg5 = null, $_arg6 = null, $_arg7 = null, $_arg8 = null, $_arg9 = null, $_arg10 = null, $_arg11 = null, $_arg12 = null, $_arg13 = null, $_arg14 = null, $_arg15 = null)
	{
		return self::GetUrl_($this, $tag, $url, $_arg0, $_arg1, $_arg2, $_arg3, $_arg4, $_arg5, $_arg6, $_arg7, $_arg8, $_arg9, $_arg10, $_arg11, $_arg12, $_arg13, $_arg14, $_arg15);
	}

	public function getUrlForTag($tag, $_arg0 = null, $_arg1 = null, $_arg2 = null, $_arg3 = null, $_arg4 = null, $_arg5 = null, $_arg6 = null, $_arg7 = null, $_arg8 = null, $_arg9 = null, $_arg10 = null, $_arg11 = null, $_arg12 = null, $_arg13 = null, $_arg14 = null, $_arg15 = null)
	{
		$url = null;
		return self::GetUrl_($this, $tag, $url, $_arg0, $_arg1, $_arg2, $_arg3, $_arg4, $_arg5, $_arg6, $_arg7, $_arg8, $_arg9, $_arg10, $_arg11, $_arg12, $_arg13, $_arg14, $_arg15);
	}

	public function getUrlSelf($tag, $_arg0 = null, $_arg1 = null, $_arg2 = null, $_arg3 = null, $_arg4 = null, $_arg5 = null, $_arg6 = null, $_arg7 = null, $_arg8 = null, $_arg9 = null, $_arg10 = null, $_arg11 = null, $_arg12 = null, $_arg13 = null, $_arg14 = null, $_arg15 = null)
	{
		$url = null;
		$saved = $this->parentPrefixUrl;
		$this->parentPrefixUrl = null;
		$return = self::GetUrl_($this, $tag, $url, $_arg0, $_arg1, $_arg2, $_arg3, $_arg4, $_arg5, $_arg6, $_arg7, $_arg8, $_arg9, $_arg10, $_arg11, $_arg12, $_arg13, $_arg14, $_arg15);
		$this->parentPrefixUrl = $saved;
		return $return;
	}

	public function loadFromUrl(\QUrl $url, $parent = null)
	{
		$this->parentPrefixUrl = $url->getConsumedAsString() ?: null;
		// we should change this in the future, needed by admin module atm
		$init_return = $this->initController($url, $parent);
		if ($init_return !== null)
			$_rv = $init_return;
		else if (\QWebRequest::IsFastAjax())
			$_rv = true;
		else if ((!$_rv) && ($testResult = ($url->isIndex())))
			$_rv = $this->loadUrlIndex($url, $testResult);
		if ((!$_rv) && ($_rv_tmp = $this->ctrl || ($this->ctrl = new View\OrderCtrl()) ? $this->ctrl->loadFromUrl($url, $this) : null))
				$_rv = $_rv_tmp;

		else if ((!$_rv) && ($testResult = ($url->current() == qTranslate("orders"))))
			$_rv = $this->loadUrlOrders($url, $testResult);
		else if ((!$_rv) && ($testResult = (true)))
			$_rv = $this->loadUrlNotfound($url, $testResult);
		/**
		 * This PHP CODE BLOCK will be executed at all times, EXCEPT for AJAX and FAST AJAX requests.
		 * The code is executed last. Even after <notfound>
		 */
		if ($this->ctrl)
		{
			$this->page->addControl($this->ctrl);
			$this->page->init();
			$this->page->render();
		}
	
		return $_rv;
	}

	public function initController(\QUrl $url = null, $parent = null)
	{
				/**
		 * This PHP CODE BLOCK will be executed at all times, including for AJAX and FAST AJAX requests.
		 * The code will be placed in the generated $this->initController() method.
		 */
	
		session_start();
		$this->sessionId = session_id();
		
		// if the prefix would have been defined
		// we need to skip prefix here
		if ($url && ($url->current() === "en"))
		{
			// jump one position in the URL
			$url->next();
			// we set the current url position as the index if we want it to match <index>
			$url->setIsIndex(true);
		}
	
		if (!\QWebRequest::IsFastAjax())
		{
			/**
			 * In a bigger project we would have had a controller linked to one ore more
			 * custom defined QWebPage.
			 * For this example we will use QWebPage as an instance.
			 */
			$this->page = new \QWebPage();
			$this->page->addCss("code/res/normalize.css");
			$this->page->addCss("code/res/skeleton.css");
			$this->page->addCss("code/res/misc.css");
			$this->page->addCss("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
			$this->page->addJs("code/res/misc.js");

			// the central control that we will put on the page
			$this->ctrl = null;
		}
	
	
	}

	/**
	 * Generated.loadUrl method
	 * loadUrlIndex
	 */
	public function loadUrlIndex(\QUrl $url, $testResult)
	{
		
			// you may decide to load the page or the control for the home part
			// we just load what we have here 
			$this->ctrl = $ctrl = new View\OrderCtrl();
			$ctrl->loadFromUrl($url, $this);

			// If we don't return a value, the processing will continue within the controller,
			// similar to a switch's break
			return true;
	}

	/**
	 * Generated.loadUrl method
	 * loadUrlMisc
	 */
	public function loadUrlMisc(\QUrl $url, $testResult)
	{
				
				var_dump("loading: misc: ".$testResult);
				return true;
	}

	/**
	 * Generated.loadUrl method
	 * loadUrlOrders
	 */
	public function loadUrlOrders(\QUrl $url, $testResult)
	{
		
			$ctrl = new View\OrderCtrl();
			$this->page->addControl($ctrl);
			$this->page->init();
			
			$url->next();
			$ctrl->loadFromUrl($url, $this);
			
			if ((!$_rv) && ($testResult = ( ($url->current() === "misc") ? ($url->next() ?: true) : false )))
			$_rv = $this->loadUrlMisc($url, $testResult);
		if ((!$_rv) && ($_rv_tmp = (new View\OrderCtrl())->loadFromUrl($url, $this)))
				$_rv = $_rv_tmp;
		
			$this->page->render();
			return true;
	}

	/**
	 * Generated.loadUrl method
	 * loadUrlNotfound
	 */
	public function loadUrlNotfound(\QUrl $url, $testResult)
	{
	
			header("HTTP/1.0 404 Not Found");
			
			$this->ctrl = $ctrl = new View\OrderCtrl();
			$ctrl->loadFromUrl($url, $this);
			// we need to return true here also, otherwise the default 404 handler will be used
			return true;
	}
}

