<?php

namespace Svengerlach\VanillaJSTemplate;

class TwigExtension extends \Twig_Extension
{

    /** @var  Compiler */
    private $compiler;

    /**
     * TwigExtension constructor.
     * @param Compiler $compiler
     */
    public function __construct(Compiler $compiler) {
        $this->compiler = $compiler;
    }

    public function getFunctions() {
        return [
            new \Twig_SimpleFunction('vanillajstemplate', [$this, 'compile'], ['is_safe' => ['html']]),
        ];
    }

    public function compile($template) {
        return $this->compiler->compile($template);
    }

    public function getName() {
        return 'vanillajstemplate';
    }    
    
}