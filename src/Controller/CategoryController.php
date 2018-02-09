<?php

namespace Mtt\CatalogBundle\Controller;

use Mtt\CatalogBundle\Service\ProductService;
use Mtt\Core\Interfaces\Catalog\Entity\CategoryInterface;
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
class CategoryController extends Controller
{
    const PRODUCTS_PER_PAGE = 10;

    use RepositoriesTrait;


    public function indexAction(Request $request)
    {
        return $this->productList($request);
    }

    public function categoryAction($slug, Request $request)
    {
        $category = $this->loadCategory($slug);
        if (null === $category) {
            throw $this->createNotFoundException('This category does not exist');
        }

        return $this->productList($request);
    }

    protected function productList(Request $request){
        // parameters to template
        $paginator = $this->get('knp_paginator');

        $filter = $this->get('mtt_catalog.product.filter_service');
        $productCollection = $filter->loadProductCollectionFromRequest($this->getDoctrine()->getManager());

        $pagination = $paginator->paginate(
            $productCollection, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $this->getLimit()/*limit per page*/
        );

        return $this->render('@catalog_templates/product/list.html.twig',
            array('pagination' => $pagination)
        );
    }

    protected function loadCategory(string $slug){
        return $this->getCategoryRepository()->findOneActiveBySlug($slug);
    }


    protected function getLimit(): int
    {
        return $this->getParameter('mtt_catalog.products_per_page');
    }

}
