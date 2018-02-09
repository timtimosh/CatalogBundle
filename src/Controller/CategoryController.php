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

        $pagination = $paginator->paginate(
            $this->getProductRepository()->findAllActive(), /* query NOT result */
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
        return self::PRODUCTS_PER_PAGE;
    }

    protected function getSinglePageTemplate(CategoryInterface $category): string
    {
        if (null === $category->getTemplate() || '' === $category->getTemplate()) {
            $view = '@easypage_templates/show.html.twig';
        } else {
            $view = $category->getTemplate();
        }
        return $view;
    }

}
