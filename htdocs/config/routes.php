<?php
	/**
	 * Пользовательские правила маршрутизации
	 */
	$routes = array(
		// Маршрут к товару
		'/product/@name/@id' => array(
			'controller' => 'card',
			'name' => '\w+',
		),
		'/product/@parent/@name/@id' => array(
			'controller' => 'card',
			'parent' => '\w+',
			'name' => '\w+',
		),
	);
