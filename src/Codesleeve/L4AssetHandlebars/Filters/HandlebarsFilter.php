<?php namespace Codesleeve\L4AssetHandlebars\Filters;

use Assetic\Asset\AssetInterface;
use Assetic\Filter\FilterInterface;
use Codesleeve\AssetPipeline\Filters\FilterHelper;

class HandlebarsFilter extends FilterHelper implements FilterInterface
{
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
        $relativePath = ltrim($this->getRelativePath($this->basePath, $asset->getSourceRoot() . '/'), '/');
        $relativePath = str_replace('templates/', '', $relativePath);
        $filename =  pathinfo($asset->getSourcePath(), PATHINFO_FILENAME);
        $filename = pathinfo($filename, PATHINFO_FILENAME);

        $content = str_replace('"', '\\"', $asset->getContent());
        $content = str_replace(PHP_EOL, "", $content);

        $jst = 'Ember.TEMPLATES = (typeof Ember.TEMPLATES === "undefined") ? Ember.TEMPLATES = {} : Ember.TEMPLATES;' . PHP_EOL;
        $jst .= 'Ember.TEMPLATES["' . $relativePath . $filename . '"] = Handlebars.compile("';
        $jst .= $content;
        $jst .= '");' . PHP_EOL;

        $asset->setContent($jst);
    }
}