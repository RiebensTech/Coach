<?php

declare (strict_types=1);
namespace Amiut\ProductSpecs\ImportExport;

use Amiut\ProductSpecs\Template\TemplateRenderer;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ExecutableModule;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ModuleClassNameIdTrait;
use ProductSpecifications\Vendor\Inpsyde\Modularity\Module\ServiceModule;
use Psr\Container\ContainerInterface;
final class Module implements ServiceModule, ExecutableModule
{
    use ModuleClassNameIdTrait;
    public function services(): array
    {
        return [\Amiut\ProductSpecs\ImportExport\ImportDataAjaxHandler::class => static fn() => new \Amiut\ProductSpecs\ImportExport\ImportDataAjaxHandler(), \Amiut\ProductSpecs\ImportExport\ExportDataAjaxHandler::class => static fn() => new \Amiut\ProductSpecs\ImportExport\ExportDataAjaxHandler(), \Amiut\ProductSpecs\ImportExport\ImportExportPage::class => static fn(ContainerInterface $container) => new \Amiut\ProductSpecs\ImportExport\ImportExportPage($container->get(TemplateRenderer::class))];
    }
    public function run(ContainerInterface $container): bool
    {
        add_action('admin_menu', function () use ($container) {
            $this->registerAdminMenuPage($container);
        });
        add_action('wp_ajax_dwspecs_export_data', $container->get(\Amiut\ProductSpecs\ImportExport\ExportDataAjaxHandler::class));
        add_action('wp_ajax_dwspecs_import_data', $container->get(\Amiut\ProductSpecs\ImportExport\ImportDataAjaxHandler::class));
        return \true;
    }
    public function registerAdminMenuPage(ContainerInterface $container): void
    {
        add_submenu_page('dw-specs', esc_html__('Product specifications Import/Export', 'product-specifications'), esc_html__('Import/export', 'product-specifications'), 'edit_pages', 'dw-specs-export', [$container->get(\Amiut\ProductSpecs\ImportExport\ImportExportPage::class), 'render']);
    }
}
