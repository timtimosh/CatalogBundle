<?php

namespace Mtt\CatalogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Product controller.
 *
 */
class CategoryController extends Controller
{
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
            $this->getCurrentLimit($request)/*limit per page*/
        );

        return $this->render('@catalog_templates/product/list.html.twig',
            array(
                'pagination' => $pagination,
                'aviableLimits' => $this->getProductPerPageLimits()
            )
        );
    }

    protected function loadCategory(string $slug){
        return $this->getCategoryRepository()->findOneActiveBySlug($slug);
    }


    protected function getCurrentLimit(Request $request): int
    {
        if($request->get('limit')) {
            return $request->get('limit');
        }
        return $this->container->getParameter('mtt_catalog.default_product_limit');
    }

    public function getProductPerPageLimits(){
        return $this->container->getParameter('mtt_catalog.products_per_page');
    }
}
