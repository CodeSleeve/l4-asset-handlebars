<?php namespace Codesleeve\L4AssetHandlebars\Filters;

use Assetic\Asset\AssetInterface;
use Assetic\Filter\FilterInterface;

class HandlebarsFilter implements FilterInterface
{
    use \Codesleeve\AssetPipeline\Filters\FilterHelper;

    public function __construct($basePath = '/app/assets/javascripts/')
    {
        $this->basePath = $basePath;
    }

    public function filterLoad(AssetInterface $asset)
    {
        // do nothing when asset is loaded
    }
 
    public function filterDump(AssetInterface $asset)
    {
        $relativePath = $this->getRelativePath($this->basePath, $asset->getSourceRoot() . '/');
        $filename =  pathinfo($asset->getSourcePath(), PATHINFO_FILENAME);
        $filename = pathinfo($filename, PATHINFO_FILENAME);

        $content = str_replace('"', '\\"', $asset->getContent());
        $content = str_replace(PHP_EOL, "", $content);

        $jst = 'JST = (typeof JST === "undefined") ? JST = {} : JST;' . PHP_EOL;
        $jst .= 'JST["' . $relativePath . $filename . '"] = Handlebars.compile("';
        $jst .= $content;
        $jst .= '");' . PHP_EOL;

        $asset->setContent($jst);
    }
}