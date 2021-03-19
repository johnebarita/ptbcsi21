<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return $this->blade->run('welcome_message');
	}
}
