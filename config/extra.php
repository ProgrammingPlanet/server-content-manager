<?php
	/*
	this file contain some extra env variable, so that we can use env variable even afre cache the config using `artisan config:cache` command.
	because after above command, .env file get not loaded every time but inside app/cpnfig dir, all files loaded every time.
	
		you can use this config by, config('extra.{var_name}')
	
	*/

	return [

		'log_sql' => env('DB_LOG_QUERY',FALSE),
	];