<?php
/**
 *  Copyright notice
 *
 *  (c) 2013 Arno Schoon (arno@maxserv.nl)
 *  All rights reserved
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 *
 * $Id$
 *
 * @author    Arno Schoon <arno@maxserv.nl>
 */

class tx_CobjCache_Hook_Cache {

	/**
	 * Flush the cache of our own extension if cache is cleared from the BE
	 *
	 * @param array $params
	 * @param t3lib_TCEmain $parentObject
	 */
	public function clearCachePostProcess(array $params, t3lib_TCEmain $parentObject) {
		if (tx_CobjCache_Utility_Cache::isEnabled()) {
			$frontend = tx_CobjCache_Utility_Cache::getFrontendInstance();

			if($frontend !== null) {
				$frontend->flush();
			}
		}
	}

}