<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2011 René Nitzsche (nitzsche@das-medienkombinat.de)
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 ***************************************************************/

require_once(t3lib_extMgm::extPath('rn_base') . 'class.tx_rnbase.php');

/**
 * Show status of search cores
 */
class tx_mksearch_mod1_util_IndexStatusHandler {
	/**
	 * Returns an instance
	 * @return tx_mksearch_mod1_util_IndexStatusHandler
	 */
	public static function getInstance() {
		return tx_rnbase::makeInstance('tx_mksearch_mod1_util_IndexStatusHandler');
	}

	/**
	 * Handle request
	 */
	public function handleRequest() {
		$states = array();
		$srv = tx_mksearch_util_ServiceRegistry::getIntIndexService();
		$indices = $srv->findAll();

		// Loop through all active indices, collecting all configurations
		foreach ($indices as $index) {
			$title = $index->getTitle();
			$credentials = $index->getCredentialString();
			try {
				$searchEngine = tx_mksearch_util_ServiceRegistry::getSearchEngine($index);
				$status = $searchEngine->getStatus();
				$msg = $status->getMessage();
				$color = $status->getStatus() > 0 ? 'green' : ($status->getStatus() < 0 ? 'red' : 'yellow');
			}
			catch(Exception $e) {
				$color = 'red';
				$msg = 'Exception occured: '.$e->getMessage();
			}
			$states[] = '
			<a href="#hint" class="tooltip">
			<span style="width:20px; background-color:'.$color.'">&nbsp;&nbsp;&nbsp;</span>&nbsp;<strong>'. $title . '</strong> - '. $credentials.'<br />
			<span class="info">'.$msg.'</span>
			</a>';
		}
		$ret = implode('<br />', $states);
		return $ret;
	}
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/mksearch/mod1/util/class.tx_mksearch_mod1_util_IndexStatusHandler.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/mksearch/mod1/util/class.tx_mksearch_mod1_util_IndexStatusHandler.php']);
}

?>