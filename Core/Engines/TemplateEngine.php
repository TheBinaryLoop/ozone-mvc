<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 03.04.2018
 * Time: 14:45
 */

namespace core\engines;


use Ozone\Core\Config;

abstract class TemplateEngine implements ITemplateEngine
{
    /* Variables */
    protected $supportedFileExtensions = array();

    /* Functions */
    /**
     * Checks `$viewFilePath` to see if it is a valid file
     *
     * @param string $viewFilePath
     * @return mixed|null|string
     */
    public function getValidFile(string $viewFilePath)
    {
        // Replace `::` with `/`
        $viewFilePath = str_replace("::", "/", $viewFilePath);
        // Replace `>` with `/`
        $viewFilePath = str_replace(">", "/", $viewFilePath);
        $viewFilePath = Config::getInstance()->get('path.app')."views/{$viewFilePath}";

        // Check supported file extensions
        foreach ($this->supportedFileExtensions as $extension) {
            if (file_exists($viewFilePath . $extension)) {
                $validViewFilePath = $viewFilePath . $extension;
                break;
            }
        }

        // If `$validViewFilePath` is not a file, throw an exception
        if (!isset($validViewFilePath) || !file_exists($validViewFilePath)) {
            //TODO: Throw new Exception
            return null;
        }
        return $validViewFilePath;
    }

    /**
     * @param $fileExtension
     */
    protected final function addSupportedFileExtension($fileExtension)
    {
        array_push($this->supportedFileExtensions, $fileExtension);
    }

    /**
     * @return array
     */
    public final function getSupportedFileExtensions(): array
    {
        return $this->supportedFileExtensions;
    }
}