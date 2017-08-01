<?php

return PhpCsFixer\Config::create()
->setFinder(PhpCsFixer\Finder::create()
	->in(__DIR__.'/src')
	->in(__DIR__.'/tests')
)
->setUsingCache(false)
->setIndent("    ")
->setRules([
    "@PSR2" => true,
]);