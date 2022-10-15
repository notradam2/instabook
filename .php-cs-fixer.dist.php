<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude([
        'vendor',
        'bootstrap',
        'storage'
    ])
    ->in(__DIR__);

$config = new PhpCsFixer\Config();
return $config->setRules([
    'no_unused_imports' => true,
    '@PSR12' => true,
    'strict_param' => false,
    'array_syntax' => ['syntax' => 'short'],
    'single_quote' => true
])->setFinder($finder);
