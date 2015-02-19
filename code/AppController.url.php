<!-- 
	This is a standalone Url Controller, the main controler of the app 
	It was triggered by: \QApp::Run(new AppController());
	You may attach a controller to any object, including Web Pages and Web Controls because it's defined as an interface
	qNamespace specifies the namespace the generated class/trait will be using (optional)
	All Url Controllers have a root xml element <urls>
    You can also create the file for the class, define the class and add functionality to it that can be used here
-->
<urls qNamespace="MyCompany\Ecomm">
	<!-- 
		you may define a prefix for all URLs 
		for now it is disabled (commented)
		<prefix><?= "en" ?></prefix>
	-->
	<?php
	
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
	
	?>
	<!-- This XML block is processed when QUrl/$url->isIndex() returns true 
		 The <index> and <notfound> only have a <load> statement -->
	<index>
		<load><?php
		
			// you may decide to load the page or the control for the home part
			// we just load what we have here 
			$this->ctrl = $ctrl = new View\OrderCtrl();
			$ctrl->loadFromUrl($url, $this);

			// If we don't return a value, the processing will continue within the controller,
			// similar to a switch's break
			return true;

		?></load>
	</index>
	<!-- Here we have a redundant pice of URL just to prove the nesting concept
		 A general url definition is made with a <url> block
		 Each <url> must have a tag that has to be unique within this file
		 You may nest URLs within each other
		 Each <url> definition has 3 parts <get>, <test>, <load>
		 The <test> may be missing if there is a one to one match via the "translate" attribute
		 This part will never be processed unless you manually write the url in the browser: "orders/...."
	-->
	<!-- You can have includes in <urls>, this entire example is powered by <index> and this <include> -->
	<include class="View\OrderCtrl" var="$this->ctrl" />
	<url tag="orders">
		<!-- It is possible to include a controller inside another one 
			 You must specify the class of the controller relative to the controller's namespace
			 The "noload" attribute means that the "loadFromUrl" will not be called for the included controller
             This is useful in case you want to manually control when that happens
			 If you wish to include a controller that is already instantiated please see the second include in this file
		-->
		<include class="View\OrderCtrl" noload />
		<!-- The <get> is the pice that defines how the URL is build 
			 In this example it is defined static via the "translate" directive
			 A dynamic <get> would look like this: <get param.0='section' param.1='order_id'><?= "/{$section}/order/{$order_id}" ?></get>
		-->
		<get translate="orders" />
		<!-- in case the <test> of the URL is positive the code inside <load> is executed -->
		<load><?php
		
			$ctrl = new View\OrderCtrl();
			$this->page->addControl($ctrl);
			$this->page->init();
			
			$url->next();
			$ctrl->loadFromUrl($url, $this);
			
		?></load>
		<!-- Just to prove the concept of nesting 
			 This will handle urls like: "orders/misc" -->
		<url tag="misc">
			<!-- we define a dummy URL -->
			<get param.1="extra"><?= "misc".($extra ? "/".$extra : "") ?></get>
			<!-- A positive test return will trigger <load> 
				 In this case if the current url part is "misc" we return the next part if exists or true
			     A NOT result (null, false, "", []) will not trigger load -->
			<test><?= ($url->current() === "misc") ? ($url->next() ?: true) : false ?></test>
			<!-- After a positive test result the variable $testResult will be passed to <load> -->
			<load><?php
				
				var_dump("loading: misc: ".$testResult);
				return true;
				
			?></load>
		</url>
		<!-- Unload <unload> will be called after the children and includes of this URL have been processed -->
		<unload><?php
		
			$this->page->render();
			return true;
			
		?></unload>
	</url>
	<!-- When all tests fail we get to <notfound> -->
	<notfound>
		<load><?php
	
			header("HTTP/1.0 404 Not Found");
			
			$this->ctrl = $ctrl = new View\OrderCtrl();
			$ctrl->loadFromUrl($url, $this);
			// we need to return true here also, otherwise the default 404 handler will be used
			return true;

		?></load>
	</notfound>
	<?php
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
	?>
</urls>