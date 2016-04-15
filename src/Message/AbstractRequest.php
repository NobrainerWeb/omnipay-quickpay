<?php

namespace Omnipay\Quickpay\Message;

/**
 * Quickpay Abstract Request
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{

	/**
	 * @var string
	 */
	protected $endpoint = 'https://api.quickpay.net/';

	/**
	 * @var string
	 */
	private $apimethod = 'capture';

	/**
	 * @return array
	 */
	public function getData()
	{
		$data = array(
			'id' => $this->getTransactionReference(),
			'amount' => $this->getAmountInteger()
		);
		return $data;
	}

	/**
	 * @return string
	 */
	public function getHttpMethod()
	{
		return 'POST';
	}

	/**
	 * @param $data
	 * @return mixed
	 */
	public function sendData($data)
	{
		// prevent throwing exceptions for 4xx errors
		$this->httpClient->getEventDispatcher()->addListener(
			'request.error',
			function ($event) {
				if ($event['response']->isClientError()) {
					$event->stopPropagation();
				}
			}
		);
		
		$httpRequest = $this->httpClient->createRequest(
			$this->getHttpMethod(),
			$this->getEndPoint() . 'payments/' . $this->getTransactionReference() . '/' . $this->getApiMethod() . '?synchronized',
			null,
			$data
		)->setHeader('Authorization', ' Basic '. base64_encode(":" . $this->getApikey()))
			->setHeader('Accept-Version', ' v10')
			->setHeader('QuickPay-Callback-Url', $this->getNotifyUrl());


		$httpResponse = $httpRequest->send();
		return $this->response = new Response($this, $httpResponse->getBody());
	}

	/**
	 * @return mixed
	 */
	public function send()
	{
		return $this->sendData($this->getData());
	}

	/**
	 * @param $value
	 * @return mixed
	 */
	public function setApiMethod($value){
		return $this->apimethod = $value;
	}

	/**
	 * @return string
	 */
	public function getApiMethod(){
		return $this->apimethod;
	}

	/**
	 * @return string
	 */
	public function getEndPoint(){
		return $this->endpoint;
	}

	/**
	 * @return mixed
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
	 * @param $value
	 * @return mixed
	 */
	public function setPrivatekey($value)
	{
		return $this->setParameter('privatekey', $value);
	}

	/**
	 * @return mixed
	 */
	public function getPrivatekey()
	{
		return $this->getParameter('privatekey');
	}

	/**
	 * @return mixed
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
	 * @return mixed
	 */
	public function getApikey()
	{
		return $this->getParameter('apikey');
	}

	/**
	 * @return mixed
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
	 * @return mixed
	 */
	public function getPaymentMethods(){
		return $this->getParameter('payment_methods');
	}

	/**
	 * @param array $value
	 * @return mixed
	 */
	public function setPaymentMethods($value = array()){
		return $this->setParameter('payment_methods', $value);
	}
}
