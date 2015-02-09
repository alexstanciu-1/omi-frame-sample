<?php

namespace MyCompany\Ecomm\View;
use MyCompany\Ecomm\Model\Order;

/**
 * The main control we will be using in our Demo
 */
class OrderCtrl extends \QWebControl implements \QIUrlController
{
	/**
	 * We include the generated trait
	 */
	use OrderCtrl_GenTrait;
	
	/**
	 * We default the render to renderList
	 *
	 * @var string
	 */
	public $renderMethod = "renderList";
	
	/**
	 * Init should always be called after the object is created it's properties are set
	 * @param init $recursive
	 */
	public function init($recursive = true)
	{
		parent::init($recursive);
		
		$this->showBackButton = !\QWebRequest::IsAjaxRequest();
		$this->sessionId = \QApp::GetController()->sessionId;
	}
	
	/**
	 * @api.enable
	 * 
	 * @param integer $order_id
	 * @return Order
	 */
	public function loadOrderById($order_id)
	{
		return $this->order = Order::QueryOrderDetails($order_id);
	}
	
	/**
	 * Shortcut for Order::saveForCurrentUser
	 * @api.enable
	 * 
	 * @param \MyCompany\Ecomm\Model\Order $order
	 */
	public function saveForm(Order $order)
	{
		return $order->saveForCurrentUser();
	}
	
	/**
	 * Deletes an order
	 * @api.enable
	 * 
	 * @param int $order_id
	 */
	public function deleteOrder($order_id)
	{
		$order = $this->loadOrderById($order_id);
		if ($order)
			$order->deleteOrder();
	}
}