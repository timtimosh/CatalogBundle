<?php

namespace Mtt\CatalogBundle\Controller;

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

    protected $category;

    public function indexAction($slug)
    {
        $this->loadCategory($slug);

        $this->maybe404();

        $paginator = $this->get('knp_paginator');

        $pagination = $paginator->paginate(
            $this->getCategoryRepository()->findAllActive(), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $this->getLimit()/*limit per page*/
        );

        // parameters to template
        return $this->render('@easypage_templates/list.html.twig',
            array('pagination' => $pagination)
        );



        $view = $this->getSinglePageTemplate($category);
        return $this->render($view, array(
            'page' => $page,
        ));
    }

    protected function loadCategory(string $slug){
        $this->category = $this->getCategoryRepository()->findOneActiveBySlug($slug);
    }

    protected function maybe404(string $slug){
        if (null === $this->category) {
            throw $this->createNotFoundException('This category does not exist');
        }
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
