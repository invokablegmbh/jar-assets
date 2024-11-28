<?php

declare(strict_types=1);

namespace Jar\Assets\ContentObjects;

/*
 * This file is part of the Jar/Assets project.
 */

use Jar\Utilities\Utilities\BackendUtility;
use Jar\Utilities\Utilities\TypoScriptUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\PathUtility;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Frontend\ContentObject\AbstractContentObject;

/**
 *
 * @author Isaac "DaPedro" Hintenjubel <ih@jcdn.de>
 * @package JAR.Assets
 * @subpackage ContentObjects
 */

class AssetsContentObject extends AbstractContentObject
{

    /**
     * Rendering the cObject, ASSETS
     * Includes all Asset Files (css, js) from a folder
     *
     * Example:
     * page.10 = ASSETS
     * page.10.path = EXT:j77_template/Resources/Public/Frontends/JavaScript/
     * page.10.standalone = 1
     */


    public function render($conf = []): void
    {
        if (!is_array($conf)) {
            return;
        }
        $variables = TypoScriptUtility::populateTypoScriptConfiguration($conf, $this->cObj);

        $this->include($variables['path'], $variables['standalone']);
    }

    protected function include($path, $standalone): void
    {

        if (empty($path)) {
            return;
        }

        $standalone = empty($standalone) ? false : !!$standalone;

        $extPath = $path;

        $path = GeneralUtility::getFileAbsFileName($path);  // get absolute path of directory
        $pathFolder = PathUtility::getRelativePathTo($path);  // get relative path of directory

        if (!file_exists($path)) {
            return;
        }

        $files = scandir($path); // scan directory

        sort($files);    //  sort files

        $file_atStart = array();  // files at first
        $file_top = array();    // next
        $file_mapping = array();    // next
        $file_custom = array();    // next
        foreach ($files as $file) {
            if (strlen($file) > 3) {    //  at less, file have 4 char lenth

                if (preg_match("/(jquery-)/i", $file)) { //jquery-|bootstrap|others  // file at first
                    $file_atStart[] = $file;
                } elseif (strpos(strtolower($file), 'custom') !== false) {    //file have 'custom' on name
                    $file_custom[] = $file;
                } elseif ($pos_mapping = strpos(strtolower($file), 'mapping') !== false) {    //file have 'mapping' on name
                    $file_mapping[] = $file;
                } else {
                    $file_top[] = $file;
                }
            }
        }

        $returnArray = array_merge($file_atStart, $file_top, $file_mapping, $file_custom);    // array include all files manes       	 

        $pageRenderer =  $this->getPageRenderer();

        if (substr($pathFolder, -1) != DIRECTORY_SEPARATOR) {
            $pathFolder = $pathFolder . DIRECTORY_SEPARATOR;    // if directory path haven't '/' at last we add it
        }


        if ($standalone) {
            $pageRenderer->disableConcatenateJavascript();
            $pageRenderer->disableConcatenateCss();
        } else if (strpos(BackendUtility::getHostname(), '.e5j.de') === false) {
            $pageRenderer->enableConcatenateJavascript();    // concatinate js files
            $pageRenderer->enableConcatenateCss();    // concatinate css files
        }


        foreach ($returnArray as $file) {
            if (strtolower(substr($file, -4)) == '.css') {    // for css files
                $pageRenderer->addCssFile($extPath . DIRECTORY_SEPARATOR . $file, 'stylesheet', 'all', '', true, false, '', false, '|');        // render css files
            }

            if (strtolower(substr($file, -3)) == '.js') {    // for js files
                $pageRenderer->addJsFooterFile($extPath . DIRECTORY_SEPARATOR . $file, 'text/javascript', true, false, '', false, '|', false, '');    // render js files
            }
        }
    }
}
