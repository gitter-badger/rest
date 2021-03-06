<?php
/*
 *  Copyright notice
 *
 *  (c) 2014 Daniel Corn <info@cundd.net>, cundd
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 */
 
/**
 * Created by JetBrains PhpStorm.
 * User: daniel
 * Date: 12.09.13
 * Time: 22:15
 * To change this template use File | Settings | File Templates.
 */

namespace Cundd\Rest\Access;


interface AccessControllerInterface {
	/**
	 * Access identifier to signal if the current request is allowed
	 */
	const ACCESS = 'ACCESS-CONST';

	/**
	 * Access identifier to signal allowed requests
	 */
	const ACCESS_ALLOW = 'allow';

	/**
	 * Access identifier to signal denied requests
	 */
	const ACCESS_DENY = 'deny';

	/**
	 * Access identifier to signal requests that require a valid login
	 */
	const ACCESS_REQUIRE_LOGIN = 'require';

	/**
	 * Access identifier to signal a missing login
	 */
	const ACCESS_UNAUTHORIZED = 'unauthorized';


	/**
	 * Returns if the current request has access to the requested resource
	 *
	 * @return AccessControllerInterface::ACCESS
	 */
	public function getAccess();

	/**
	 * Returns if the given request needs authentication
	 *
	 * @return bool
	 */
	public function requestNeedsAuthentication();

	/**
	 * Returns the current request
	 *
	 * @return \Bullet\Request
	 */
	public function getRequest();

	/**
	 * Sets the current request
	 *
	 * @param \Cundd\Rest\Request $request
	 */
	public function setRequest(\Cundd\Rest\Request $request);
}
