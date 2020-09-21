<?php

namespace Omnipay\Quickpay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Quickpay\Message\Notification;

/**
 * Quickpay Gateway
 * @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
 * @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
 */
class Gateway extends AbstractGateway
{
	/**
	 * @return string
	 */
	public function getName()
	{
		return 'Quickpay';
	}

	/**
	 * @return array
	 */
	public function getDefaultParameters()
	{
		return array(
			'type'                         => '',
			'merchant'                     => '',
			'agreement'                    => '',
			'apikey'                       => '',
			'privatekey'                   => '',
			'language'                     => '',
			'google_analytics_tracking_id' => '',
			'google_analytics_client_id'   => '',
			'description'                  => '',
			'order_id'                     => '',
			'synchronized'                 => false,
			'payment_methods'              => array(),
			'auto_capture'				   => false,
			'variables'					   => array(),
		);
	}

	/**
	 * @return array
	 */
	public function getPaymentMethods()
	{
		return $this->getParameter('payment_methods');
	}

	/**
	 * @param array $value
	 * @return mixed
	 */
	public function setPaymentMethods($value = array())
	{
		return $this->setParameter('payment_methods', $value);
	}

	/**
	 * @return int
	 */
	public function getMerchant()
	{
		return $this->getParameter('merchant');
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setMerchant($value)
	{
		return $this->setParameter('merchant', $value);
	}

	/**
	 * @return int
	 */
	public function getAgreement()
	{
		return $this->getParameter('agreement');
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setAgreement($value)
	{
		return $this->setParameter('agreement', $value);
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setApikey($value)
	{
		return $this->setParameter('apikey', $value);
	}

	/**
	 * @return string
	 */
	public function getApikey()
	{
		return $this->getParameter('apikey');
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setPrivatekey($value)
	{
		return $this->setParameter('privatekey', $value);
	}

	/**
	 * @return string
	 */
	public function getPrivatekey()
	{
		return $this->getParameter('privatekey');
	}

	/**
	 * @return string
	 */
	public function getLanguage()
	{
		return $this->getParameter('language');
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setLanguage($value)
	{
		return $this->setParameter('language', $value);
	}

	/**
	 * @return string
	 */
	public function getGoogleAnalyticsTrackingID()
	{
		return $this->getParameter('google_analytics_tracking_id');
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setGoogleAnalyticsTrackingID($value)
	{
		return $this->setParameter('google_analytics_tracking_id', $value);
	}

	/**
	 * @return string
	 */
	public function getGoogleAnalyticsClientID()
	{
		return $this->getParameter('google_analytics_client_id');
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setGoogleAnalyticsClientID($value)
	{
		return $this->setParameter('google_analytics_client_id', $value);
	}

	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->getParameter('type');
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setType($value)
	{
		return $this->setParameter('type', $value);
	}

	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->getParameter('description');
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setDescription($value)
	{
		return $this->setParameter('description', $value);
	}

	/**
	 * @return string
	 */
	public function getOrderID()
	{
		return $this->getParameter('order_id');
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setOrderID($value)
	{
		return $this->setParameter('order_id', $value);
	}

	/**
	 * @param $value
	 * @return self
	 */
	public function setSynchronized($value)
	{
		return $this->setParameter('synchronized', $value);
	}

	/**
	 * @return boolean
	 */
	public function getSynchronized()
	{
		return boolval($this->getParameter('synchronized'));
	}


	/**
	 * @param $value
	 * @return self
	 */
	public function setAutoCapture($value)
	{ 
		return $this->setParameter('auto_capture', $value);
	}

	/**
	 * @return boolean
	 */
	public function getAutoCapture()
	{
		return boolval($this->getParameter('auto_capture'));
	}
	
	/**
	 * Start an authorize request
	 *
	 * @param array $parameters array of options
	 * @return \Omnipay\Quickpay\Message\AuthorizeRequest
	 */
	public function authorize(array $options = array())
	{
		return $this->createRequest('\Omnipay\Quickpay\Message\AuthorizeRequest', $options);
	}

	/**
	 * Start a purchase request
	 *
	 * @param array $parameters array of options
	 * @return \Omnipay\Quickpay\Message\PurchaseRequest
	 */
	public function purchase(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\Quickpay\Message\PurchaseRequest', $parameters);
	}

	/**
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\CaptureRequest
	 */
	public function capture(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\Quickpay\Message\CaptureRequest', $parameters);
	}

	/**
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\VoidRequest
	 */
	public function void(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\Quickpay\Message\VoidRequest', $parameters);
	}

	/**
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\RefundRequest
	 */
	public function refund(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\Quickpay\Message\RefundRequest', $parameters);
	}

	/**
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\RefundRequest
	 */
	public function recurring(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\Quickpay\Message\RecurringRequest', $parameters);
	}

	/**
	 * Is used for callbacks coming in to the system
	 * notify will verify these callbacks and eventually return the body of the callback to the app
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\NotifyRequest
	 */
	public function notify(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\Quickpay\Message\NotifyRequest', $parameters);
	}

	/**
	 * Complete a purchase
	 *
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\CompleteRequest
	 */
	public function completePurchase(array $parameters = array())
	{
		return $this->completeRequest($parameters);
	}

	/**
	 * Complete an authorization
	 *
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\CompleteRequest
	 */
	public function completeAuthorize(array $parameters = array())
	{
		return $this->completeRequest($parameters);
	}

	/**
	 * A complete request
	 *
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\CompleteRequest
	 */
	public function completeRequest(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\Quickpay\Message\CompleteRequest', $parameters);
	}

	/**
	 * Complete capture
	 *
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\CompleteRequest
	 */
	public function completeCapture(array $parameters = array())
	{
		return $this->completeRequest($parameters);
	}

	/**
	 * Complete cancel
	 *
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\CompleteRequest
	 */
	public function completeVoid(array $parameters = array())
	{
		return $this->completeRequest($parameters);
	}

	/**
	 * Complete refund
	 *
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\CompleteRequest
	 */
	public function completeRefund(array $parameters = array())
	{
		return $this->completeRequest($parameters);
	}

	/**
	 * Complete recurring
	 *
	 * @param array $parameters
	 * @return \Omnipay\Quickpay\Message\CompleteRequest
	 */
	public function completeRecurring(array $parameters = array())
	{
		return $this->completeRequest($parameters);
	}

	/**
	 * @return Notification
	 */
	public function acceptNotification()
	{
		return new Notification($this->httpRequest, $this->getPrivatekey());
	}

	public function link(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\Quickpay\Message\LinkRequest', $parameters);
	}

	public function status(array $parameters = array())
	{
		return $this->createRequest('\Omnipay\Quickpay\Message\StatusRequest', $parameters);
	}

	/**
	 * @return array
	 */
	public function getVariables()
	{
		return $this->getParameter('variables');
	}

	/**
	 * @param array $value
	 * @return mixed
	 */
	public function setVariables($value = array())
	{
		return $this->setParameter('variables', $value);
	}

	function __call($name, $arguments)
	{
		// TODO: Implement @method \Omnipay\Common\Message\RequestInterface createCard(array $options = array())
		// TODO: Implement @method \Omnipay\Common\Message\RequestInterface updateCard(array $options = array())
		// TODO: Implement @method \Omnipay\Common\Message\RequestInterface deleteCard(array $options = array())
	}
}
