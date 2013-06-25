<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_content.php']['stdWrap'][] = 'tx_CobjCache_Hook_StdWrap';

// Register cache 'tx_cobjcache'
if (!is_array($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['tx_cobjcache'])) {
	$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['tx_cobjcache'] = array();
}
// Define string frontend as default frontend, this must be set with TYPO3 4.5 and below
// and overrides the default variable frontend of 4.6
if (!isset($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['tx_cobjcache']['frontend'])) {
	$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['tx_cobjcache']['frontend'] = 't3lib_cache_frontend_StringFrontend';
}
if (t3lib_utility_VersionNumber::convertVersionNumberToInteger(TYPO3_version) < '4006000') {
	// Define database backend as backend for 4.5 and below (default in 4.6)
	if (!isset($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['tx_cobjcache']['backend'])) {
		$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['tx_cobjcache']['backend'] = 't3lib_cache_backend_DbBackend';
	}
	// Define data and tags table for 4.5 and below (obsolete in 4.6)
	if (!isset($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['tx_cobjcache']['options'])) {
		$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['tx_cobjcache']['options'] = array();
	}
	if (!isset($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['tx_cobjcache']['options']['cacheTable'])) {
		$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['tx_cobjcache']['options']['cacheTable'] = 'tx_cobjcache';
	}
	if (!isset($TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['tx_cobjcache']['options']['tagsTable'])) {
		$TYPO3_CONF_VARS['SYS']['caching']['cacheConfigurations']['tx_cobjcache']['options']['tagsTable'] = 'tx_cobjcache_tags';
	}
}

$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearCachePostProc'][] = 'tx_CobjCache_Hook_Cache->clearCachePostProcess';