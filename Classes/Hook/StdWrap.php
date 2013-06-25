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
 * Class tx_CobjCache_Hook_StdWrap
 */
class tx_CobjCache_Hook_StdWrap implements tslib_content_stdWrapHook {

	/**
	 * Hook for modifying $content before core's stdWrap does anything
	 *
	 * @param    string        input value undergoing processing in this function. Possibly substituted by other values fetched from another source.
	 * @param    array        TypoScript stdWrap properties
	 * @param    tslib_cObj    parent content object
	 * @return    string        further processed $content
	 */
	public function stdWrapPreProcess($content, array $configuration, tslib_cObj &$parentObject) {
		if (tx_CobjCache_Utility_Cache::isEnabled() && is_array($configuration['cache.'])) {
			$key = $parentObject->stdWrap($configuration['cache.']['key'], $configuration['cache.']['key.']);
			$frontend = tx_CobjCache_Utility_Cache::getFrontendInstance();

			if ($frontend !== NULL && $frontend->has($key)) {
				$content = $frontend->get($key);
				$parentObject->stopRendering[$parentObject->stdWrapRecursionLevel] = TRUE;
			}
		}

		return $content;
	}

	/**
	 * Hook for modifying $content after core's stdWrap has processed setContentToCurrent, setCurrent, lang, data, field, current, cObject, numRows, filelist and/or preUserFunc
	 *
	 * @param    string        input value undergoing processing in this function. Possibly substituted by other values fetched from another source.
	 * @param    array        TypoScript stdWrap properties
	 * @param    tslib_cObj    parent content object
	 * @return    string        further processed $content
	 */
	public function stdWrapOverride($content, array $configuration, tslib_cObj &$parentObject) {
		return $content;
	}

	/**
	 * Hook for modifying $content after core's stdWrap has processed override, preIfEmptyListNum, ifEmpty, ifBlank, listNum, trim and/or more (nested) stdWraps
	 *
	 * @param    string        input value undergoing processing in this function. Possibly substituted by other values fetched from another source.
	 * @param    array        TypoScript "stdWrap properties".
	 * @param    tslib_cObj    parent content object
	 * @return    string        further processed $content
	 */
	public function stdWrapProcess($content, array $configuration, tslib_cObj &$parentObject) {
		return $content;
	}

	/**
	 * Hook for modifying $content after core's stdWrap has processed anything but debug
	 *
	 * @param    string        input value undergoing processing in this function. Possibly substituted by other values fetched from another source.
	 * @param    array        TypoScript stdWrap properties
	 * @param    tslib_cObj    parent content object
	 * @return    string        further processed $content
	 */
	public function stdWrapPostProcess($content, array $configuration, tslib_cObj &$parentObject) {
		if (tx_CobjCache_Utility_Cache::isEnabled() && is_array($configuration['cache.'])) {
			$key = $parentObject->stdWrap($configuration['cache.']['key'], $configuration['cache.']['key.']);
			$frontend = tx_CobjCache_Utility_Cache::getFrontendInstance();

			if (!empty($key) && $frontend !== NULL) {
				$lifetime = $parentObject->stdWrap(
					$configuration['cache.']['lifetime'],
					$configuration['cache.']['lifetime.']
				);

				$tags = $parentObject->stdWrap(
					$configuration['cache.']['tags'],
					$configuration['cache.']['tags.']
				);

				$lifetime = ($lifetime > 0) ? $lifetime : NULL;
				$tags = !empty($tags) ? t3lib_div::trimExplode(',', $tags) : array();

				$frontend->set($key, $content, $tags, $lifetime);
			}
		}

		return $content;
	}
}