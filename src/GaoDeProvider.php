<?php
/**
 * User: xieqiyong
 * Time: 2019/4/19 14:10
 */

namespace Xieqiyong\Address;


class GaoDeProvider extends \Illuminate\Support\ServiceProvider
{
	protected $defer = true;

	public function register()
	{
		$this->app->singleton(Address::class, function(){
			return new Address(config('gaode.gaode.key'));
		});

		$this->app->alias(Address::class, 'address');
	}

	public function provides()
	{
		return [Address::class, 'address'];
	}
}