<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 03.04.2018
 * Time: 14:46
 */

namespace core\engines;


interface ITemplateEngine
{
    public function __construct();
    public function getValidFile(string $viewFilePath);
    public function render(string $viewFile, array $viewVars);
}