<?php

	/* core */
	$server = 'http://localhost:3000/api/';

	/* general conf */
	# cache
	$conf['cache'] = [
		'cache_dir' => 'cache/',
		'caching' => true,
		'cacheTime' => '6 hours',
	];

	# endpoints
	$conf['endpoints'] = [
		'server' => $server,
		'backtest' => $server . 'backtest',
		'strategies' => $server . 'strategies',
		'datasets' => $server . 'scansets', // get all datasets and meta (eg. from <> to dates)
		'kill' => $server . 'killGekko', // kill Gekko (POST)
		'start' => $server . 'startGekko', // start Gekko (POST)
		'script_files' => __DIR__,
	];



	/* dirs */
	$domain = $_SERVER['HTTP_HOST'];
	$docRoot = $_SERVER['DOCUMENT_ROOT'];
	$dirRoot = dirname(__FILE__);
	$protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
	$base_url = $protocol . $domain . substr(__DIR__, strlen($_SERVER[ 'DOCUMENT_ROOT' ])) . '/';
	$base_url = str_replace('system/', '', $base_url);

	$base_path = $docRoot . "/gab/";


	# system dirs
	$conf['dirs'] = [
		'base' => $base_path,
		'system' => $base_path . 'system/',
		'results' => $base_path . 'results/',
		'views' => $base_path . 'views/',
		'cache' => $base_path . $conf['cache']['cache_dir'],
	];

	$dirs = (object) $conf['dirs'];

	$conf['urls'] = [
		'system' => $base_url . 'system/',
		'results' => $base_url . 'results/',
		'assets' => $base_url . 'assets/',
	];

	# db fields
	$conf['db_fields'] = [

		'blobs' => [
			'id' => 'TEXT PRIMARY KEY UNIQUE',
			'report' => 'BLOB',
			'roundtrips' => 'BLOB',
		],

		'results' => [
			'id' => 'TEXT PRIMARY KEY UNIQUE',
			'candle_size' => 'INTEGER',
			'strategy_profit' => 'INTEGER',
			'market_profit' => 'INTEGER',
			'sharpe' => 'REAL',
			'alpha' => 'REAL',
			'trades' => 'INTEGER',
			'trades_win' => 'INTEGER',
			'trades_lose' => 'INTEGER',
			'trades_win_percent' => 'REAL',
			'trades_win_avg' => 'REAL',
			'trades_lose_avg' => 'REAL',
			'trades_best' => 'REAL',
			'trades_worst' => 'REAL',
			'trades_per_day' => 'REAL',
			'strat' => 'BLOB',
		],
	];

	// turn to object
	$conf = json_decode(json_encode($conf));




	/* set large defaults for PHP */
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	ini_set('memory_limit','512M');
	set_time_limit(900);
