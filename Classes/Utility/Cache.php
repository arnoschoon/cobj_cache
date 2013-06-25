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


/**
 * Class tx_CobjCache_Utility_Cache
 */
class tx_CobjCache_Utility_Cache {

	/**
	 * @var t3lib_cache_frontend_AbstractFrontend
	 */
	protected static $frontendInstance = NULL;

	/**
	 * @return bool
	 */
	public static function isEnabled() {
		return TYPO3_UseCachingFramework;
	}

	/**
	 * @return t3lib_cache_frontend_AbstractFrontend|null
	 */
	public static function getFrontendInstance() {
		if (self::$frontendInstance === NULL) {
			t3lib_cache::initializeCachingFramework();

			if (!$GLOBALS['typo3CacheManager']->hasCache('tx_cobjcache')) {
				$GLOBALS['typo3CacheFactory']->create(
					'tx_cobjcache',
					$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tx_cobjcache']['frontend'],
					$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tx_cobjcache']['backend'],
					$GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations']['tx_cobjcache']['options']
				);
			}

			self::$frontendInstance = $GLOBALS['typo3CacheManager']->getCache('tx_cobjcache');
		}

		return self::$frontendInstance;
	}
}