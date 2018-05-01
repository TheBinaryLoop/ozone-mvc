<?php
/**
 * Created by PhpStorm.
 * User: TheBinaryLoop
 * Date: 03.04.2018
 * Time: 15:06
 */

namespace Ozone\Core\Engines\MarkdownEngine;

use Michelf\Markdown;
use Michelf\MarkdownExtra;

class MarkdownEngine extends core\Engines\TemplateEngine
{
    private $engine;
    public function __construct()
    {
        $this->engine = new MarkdownExtra();
        $this->addSupportedFileExtension('.markdown');
        $this->addSupportedFileExtension('.mdown');
        $this->addSupportedFileExtension('.mkdn');
        $this->addSupportedFileExtension('.md');
    }

    public function render(string $viewFile, array $viewVars = array())
    {
        // TODO: Implement render() method.
        $html = $this->engine->transform(file_get_contents($this->getValidFile($viewFile)));
        print($html);
    }
}