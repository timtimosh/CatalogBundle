<?php

namespace Mtt\CatalogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrap3View;

use LittleHouse\CatalogBundle\Entity\Product;

/**
 * Product controller.
 *
 */
class ProductController extends Controller
{
    use RepositoriesTrait;

    /**
     * Finds and displays a Product entity.
     * @var $page BasePage
     *
     */
    public function showAction($slug)
    {
        $product = $this->getProductRepository()->findOneActiveBySlug($slug);
        if (!$product) {
            throw $this->createNotFoundException('The product does not exist');
        }
        $view = $this->getProductTemplate($product);
        return $this->render($view, array(
            'product' => $product,
        ));
    }

    protected function getProductTemplate($product){
        return '@catalog_templates/product/show.html.twig';
    }

}
