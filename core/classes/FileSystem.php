<?php
/**
 * Created by PhpStorm.
 * User: Lukas Eßmann
 * Date: 07.03.2018
 * Time: 14:48
 */

namespace core\classes;

class FileSystem
{
    private $files = [];
    private $folders = [];
    function getAll($path)
    {
        self::getDirectory($path);
        $output = array();
        $output['files'] = $this->files;
        $output['folders'] = $this->folders;
        return $output;
    }

    private function getDirectory($path)
    {
        foreach (array_diff(scandir($path), array('..', '.')) as $item)
        {
            if (substr($path, -1) != DIRECTORY_SEPARATOR) {
                $itemPath = trim($path) . DIRECTORY_SEPARATOR . $item;
            } else {
                $itemPath = trim($path) . $item;
            }

            if (is_file($itemPath)) {
                array_push($this->files, $itemPath);
            } else {
                //echo 'Call self::getDirectory("'.$itemPath.'")<br>';
                array_push($this->folders, $itemPath);
                self::getDirectory($itemPath);
            }
        }
    }
}