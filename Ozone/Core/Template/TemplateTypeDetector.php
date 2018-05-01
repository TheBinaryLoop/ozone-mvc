<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 15.04.2018
 * Time: 14:05
 */

namespace Ozone\Core\Template;


use Ozone\Core\Exceptions\FileNotFoundException;

/**
 * TemplateTypeDetector
 * @version 0.0.1
 * @author Lukas Eßmann
 * @package Ozone\Core\Template
 */
class TemplateTypeDetector
{

    /**
     * TemplateTypeDetector constructor.
     */
    private function __construct() { }

    /**
     * Detect the type of view from the view file path.
     * @param string $viewFilePath
     * @return int The type of the template
     * @throws FileNotFoundException
     */
    public static function detect(string $viewFilePath)
    {
        if ($viewFilePath == "")
            throw new \InvalidArgumentException('$viewFilePath can\'t be null or ""');
        // Check if file exists
        if (file_exists($viewFilePath))
        {
            // Get the file extension
            $extension = strtolower(pathinfo($viewFilePath)['extension']);
            if ($extension === 'php' || $extension === 'php3' || $extension === 'php4' || $extension === 'php5' || $extension === 'phtml') {
                return TEMPLATE_PLAIN;
            } else if ($extension === 'markdown' || $extension === 'mdown' || $extension === 'mkdn' || $extension === 'md') {
                return TEMPLATE_MARKDOWN;
            } else if ($extension === 'handlebars' || $extension === 'hbs') {
                // TODO: Switch between server- and browser-side compilation
                return TEMPLATE_HANDLEBARS_SERVER;
            } else if ($extension === 'dwoo' || $extension === 'tpl') {
                return TEMPLATE_DWOO;
            } else {
                return TEMPLATE_NONE;
            }
        } else {
            throw new FileNotFoundException("ViewFile '{$viewFilePath}' not found!");
        }

    }

}