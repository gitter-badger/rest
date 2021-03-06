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

/*
 * rest
 * @author daniel
 * Date: 14.09.13
 * Time: 18:58
 */



namespace Cundd\Rest\Authentication\UserProvider;


use Cundd\Rest\Authentication\UserProviderInterface;

class FeUserProvider implements UserProviderInterface {
	/**
	 * Returns if the user with the given credentials is valid
	 *
	 * @param string $username
	 * @param string $password
	 * @return boolean
	 */
	public function checkCredentials($username, $password) {
		/** @var \t3lib_DB $databaseAdapter */
		$databaseAdapter = $this->getDatabaseAdapter();

		$whereClause = $this->buildWhereStatement(array(
			'username' => $username,
			'password' => $password
		));
		$result = $databaseAdapter->exec_SELECTquery('COUNT(*)', 'fe_users', $whereClause);
		$row = $databaseAdapter->sql_fetch_row($result);
		return (bool) $row[0];
	}

	/**
	 * Builds the where statement from the given properties
	 * @param array $properties
	 * @return string
	 */
	protected function buildWhereStatement($properties) {
		$whereParts = array();
		$databaseAdapter = $this->getDatabaseAdapter();
		foreach($properties as $key => $value) {
			if ($key === 'password') {
				list($value, $key) = $this->preparePassword($value);
			}
			$whereParts[] = '`' . $key . '`=' . $databaseAdapter->fullQuoteStr($value, 'fe_users');
		}
		return implode(' AND ', $whereParts);
	}

	/**
	 * Returns an array containing the prepared password and table column
	 * @param string $password
	 * @return array
	 */
	protected function preparePassword($password) {
		return array($password, 'tx_rest_apikey');
	}

	/**
	 * Returns the database adapter
	 * @return \TYPO3\CMS\Core\Database\DatabaseConnection
	 */
	protected function getDatabaseAdapter() {
		return $GLOBALS['TYPO3_DB'];
	}
}
