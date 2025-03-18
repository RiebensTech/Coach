<?php

declare (strict_types=1);
namespace Amiut\ProductSpecs\Template;

class PhpTemplateRenderer implements \Amiut\ProductSpecs\Template\TemplateRenderer
{
    private \Amiut\ProductSpecs\Template\Context $context;
    public function __construct(\Amiut\ProductSpecs\Template\Context $context)
    {
        $this->context = $context;
    }
    public function render(string $name, array $data = []): string
    {
        $template = new \Amiut\ProductSpecs\Template\Template($this->context, $name);
        $data = array_merge($data, ['renderer' => $this]);
        return $template->render($data);
    }
}
