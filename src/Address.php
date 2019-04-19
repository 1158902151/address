<?php
/**
 * User: xieqiyong666@gmail.com
 * Time: 2019/4/19 11:44
 */
namespace Xieqiyong\Address;

use GuzzleHttp\Client;

class Address
{
	/**
	 * @var string
	 */
	protected $key;
	/**
	 * @var array
	 */
	protected $guzzleOptions = [];
	/**
	 * @var string
	 */
	protected $url = "http://restapi.amap.com/v3/ip";

	public function __construct(string $key)
	{
		$this->key = $key;
	}

	public function getHttpClient()
	{
		return new Client($this->guzzleOptions);
	}

	public function setGuzzleOptions(array $options)
	{
		$this->guzzleOptions = $options;
	}

	/**
	 * @return array
	 */
	public function getAddress($ip,string $format = "json")
	{
		$query_param = array_filter([
				"key" => $this->key,
				"ip"  => $ip,
				"output"=>$format
			]
		);
		$response = $this->getHttpClient()->get($this->url,['query'=>$query_param])->getBody()->getContents();

		return 'json' === $format ? \json_decode($response, true) : $response;
	}

}