<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 12.05.2018
 * Time: 13:25
 */

namespace Ozone\Core\Config;

use Ozone\Core\Exceptions\FileNotFoundException;
use Ozone\Core\Exceptions\ParseException;


class Config extends OzoneConfig
{
    /**
     * Config constructor.
     * @param $path
     * @throws FileNotFoundException
     * @throws ParseException
     */
    public function __construct($path)
    {
        $this->data = array();
        if (!file_exists($path))
            throw new FileNotFoundException("Configuration file: [$path] cannot be found");
        // Try and load file
        $this->data = array_replace_recursive($this->data, (array) $this->parse($path));

        parent::__construct($this->data);
    }

    /**
     * Parses a file from `$path` and gets its contents as an arrays
     * Loads a JSON file as an array
     *
     * @param  string $path
     * @return array
     * @throws ParseException If there is an error parsing the JSON file
     */
    public function parse($path)
    {
        $data = json_decode(file_get_contents($path), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $error_message  = 'Syntax error';
            if (function_exists('json_last_error_msg')) {
                $error_message = json_last_error_msg();
            }

            $error = array(
                'message' => $error_message,
                'type'    => json_last_error(),
                'file'    => $path,
            );
            throw new ParseException($error);
        }

        return $data;
    }


    protected function getDefaults()
    {
        return array();
    }
}