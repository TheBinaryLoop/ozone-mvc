<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 03.04.2018
 * Time: 15:30
 */

namespace core\engines;


class DefaultEngine extends TemplateEngine
{
    public function __construct()
    {
        $this->addSupportedFileExtension('.php');
    }

    public function render(string $viewFile, array $viewVars)
    {
        // TODO: Implement render() method.
    }
}