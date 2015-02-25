<?php

namespace MyCompany\Ecomm\Model;

/**
 * Represents an Order
 * 
 * @storage.table Orders
 */
class Order extends \QModel
{
	use Order_GenTrait, ExposeCRUD;
	/**
	 * @var string|array
	 */
	public static $ModelEntity = "*,Items.*";
	/**
	 * We need to query a bit more data for an order
	 * The name of the property or the implementation are not a frame standard
	 * 
	 * @var string
	 */
	public static $QuerySelector = "*,Items.{*,Product.*}";
	/**
	 * We specify how we load things (can be any property).
	 * Notice we don't go within the product
	 * 
	 * The name of the property or the implementation are not a frame standard
	 * 
	 * @var string
	 */
	public static $SaveSelector = "*,Items.{*,Product}";
	/**
	 * What we should delete when we delete an Order
	 * 
	 * The name of the property or the implementation are not a frame standard
	 *
	 * @var string
	 */
	public static $DeleteSelector = "*,Items.{*,Product}";
	/**
	 * The Id
	 * 
	 * @validation mandatory && positive && between(1, 999999999)
	 * 
	 * @var integer
	 */
	public $Id;
	/**
	 * Date
	 * @var datetime
	 */
	public $Date;
	/**
	 * Customer
	 * 
	 * @fixValue trim
	 * @validation mandatory && min(3)
	 * 
	 * @var string
	 */
	public $Customer;
	/**
	 * We will just use the session id for this field
	 * 
	 * @fixValue trim
	 * @validation mandatory && min(7)
	 *
	 * @var string
	 */
	public $Responsible;
	/**
	 * The list of items in the order
	 * For optimization we ask for the collection to be One To Many
	 * 
	 * @storage.oneToMany
	 * 
	 * @validation mandatory
	 * 
	 * @var OrderItem[]
	 */
	public $Items;
	
	
	/**
	 * Gets the orders listing
	 * 
	 * @return Order[]
	 */
	public static function GetListingOrders()
	{
		// This demonstrates a ORM select with Aliases
		// As you can see it's very simple, standard SQL without JOINS
		$query = "SELECT *,
					COUNT(Items.Id) AS ItemsCount,
					SUM(Items.Quantity * Items.UnitPrice) AS ItemsTotal
				
				WHERE
					Responsible=?
					AND Items IS_A MyCompany\Ecomm\Model\OrderItem
										 
				ORDER BY 
					??OBY_Date?<,[Date ?@]
					??OBY_Id?<,[Id ?@]
					
				GROUP BY Id
				LIMIT 50";
	
		// load data
		$data = self::QueryAll($query, [\QApp::GetController()->sessionId, "OBY_Date" => "ASC", "OBY_Id" => "ASC"]);
		
		// if we don't have any test data for the current session Id we create it
		if ((!$data) || (!count($data)))
		{
			self::PopulateTestData();
			$data = self::QueryAll($query, [\QApp::GetController()->sessionId]);
		}
		
		return $data;
	}

	/**
	 * Gets order details
	 * 
	 * @param int $order_id
	 * @return Order
	 */
	public function QueryOrderDetails($order_id)
	{
		$responsible_id = \QApp::GetController()->sessionId;
		// in this sample we use 2 binds, multiple binds must be placed in an array
		return Order::QueryFirst("*,Items.{*,Product.*} WHERE Id=? AND Responsible=? LIMIT 1", [$order_id, $responsible_id]);
	}
	
	/**
	 * We allow anyone to create an order, or edit one that they own
	 * The api.enable directive allows remote calls to the method
	 * 
	 * @api.enable
	 * 
	 * @param \MyCompany\Ecomm\Model\Order $order
	 */
	public function saveForCurrentUser()
	{
		$responsible_id = \QApp::GetController()->sessionId;
		
		// check the data
		if ($this->getId())
		{
			// quick security check 
			$db_order = Order::QueryAll("Id,Responsible WHERE Id=? LIMIT 1", $this->getId())->first();
			if (!$db_order)
				throw new \Exception("There is no order with that id in the DB");
			else if ($db_order && ($db_order->Responsible !== $responsible_id))
				throw new \Exception("You do not have access to that order");
		}
		
		$this->Responsible = $responsible_id;
		
		$this->save(self::$SaveSelector);
	}
	
	/**
	 * Deletes the current order
	 * 
	 * @throws \Exception
	 */
	public function deleteOrder()
	{
		$responsible_id = \QApp::GetController()->sessionId;
		
		if (!$this->getId())
			throw new \Exception("Missing order ID");
		
		// check the data
		// quick security check 
		$db_order = Order::QueryAll("Id,Responsible WHERE Id=? LIMIT 1", $this->getId())->first();
		if (!$db_order)
			throw new \Exception("There is no order with that id in the DB");
		else if ($db_order && ($db_order->Responsible !== $responsible_id))
			throw new \Exception("You do not have access to that order");
		
		$this->Responsible = $responsible_id;
		
		// make sure we load all the items before delete
		$this->query(self::$DeleteSelector);
		// now delete
		$this->delete(self::$DeleteSelector);
		
	}
	
	/**
	 * This is executed inside the COMMIT, immediately after BEGIN TRANSACTION
	 * In our demo we copy prices from Product.Price to the OrderItem.UnitPrice
	 * 
	 * @param array $selector
	 * @param int|string $transform_state
	 * @throws Exception
	 */
	public function afterBeginTransaction($selector = null, $transform_state = null)
	{
		// we are only checking for UPDATE & DELETE
		if (!(($transform_state === null) || ($transform_state & \QModel::TransformCreate) || ($transform_state & \QModel::TransformUpdate)))
			return;
		
		if (!$this->Items)
			throw new \Exception("Missing items");
		
		$products = new \QModelArray();
		foreach ($this->Items as $item)
			$products[] = $item->Product;
		
		$products->query("Price");
		
		foreach ($this->Items as $item)
			$item->UnitPrice = $item->Product->Price;
		
		// now we call the parent:: to do the default work 
		return parent::afterBeginTransaction($selector, $transform_state);
	}
	
	/**
	 * We create some sample data and link it to the Session Id
	 */
	public static function PopulateTestData()
	{
		// Depending on the model's definition, it is not mandatory to link 
		// the data you are saving to the ROOT MODEL, but for this 
		// example we will do that to show that you may do multiple opertations in one transaction
		
		// we get a instance (a new one) to the ROOT MODEL
		$DATA = \QApp::NewData();
		// we prepare the Orders collection
		$DATA->Orders = new \QModelArray();
		// we prepare the Products collection
		$DATA->Products = new \QModelArray();
		
		$responsible_id = \QApp::GetController()->sessionId;
		
		// we generate 12 random orders
		for ($o = 0; $o < 12; $o++)
		{
			$order = new Order();
			$order->Date = date('Y-m-d H:i:s', time() - rand(1, 86400 * 30 /* days */));
			$order->Customer = "Customer #".rand(1, 99);
			$order->Responsible = $responsible_id;

			$order->Items = new \QModelArray();

			$no_items = rand(1, 8);
			for ($i = 0; $i < $no_items; $i++)
			{
				$oi = new OrderItem();
				
				$product_id = rand(1, 99);
				// check if the products exists in the DB, in a production APP we would also begin a transaction here
				// via QApp::GetStorage()->begin()
				$product = Product::QueryAll("Id,Name,Price WHERE Id=?", $product_id)->first();
				
				if (!$product)
				{
					// we don't have the product, we will create it
					$product = new Product();
					$product->setId($product_id);
					$product->_id = $product_id;
					$product->Name = "Product #".$product_id;
					$product->Price = rand(50, 200) / 10;
					
					$DATA->Products[] = $product;
					
					// here we save the product with merge, an id will be linked to it
					$product->merge("Id,Name,Price");
				}
					
				$oi->Product = $product;
				$oi->Quantity = rand(1, 5);
				// the OrderItem.UnitPrice is a copy from Product.Price in case Product.Price changes
				$oi->UnitPrice = $product->Price;

				$order->Items[] = $oi;
			}
			
			$DATA->Orders[] = $order;
		}
		
		// Now we save all the data in one call
		// Notice that you may control what you save
		$DATA->merge("Orders.{*,
						      Items.{*,
									 Product}},
					  Products.{
					            Id,Name,Price}");
	}
	
}