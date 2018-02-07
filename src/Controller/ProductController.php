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
    /**
     * Finds and displays a Page entity.
     * @var $page BasePage
     *
     */
    public function showAction($slug)
    {
        $page = $this->getPageRepository()->findOneActiveBySlug($slug);
        if (!$page) {
            throw $this->createNotFoundException('The page does not exist');
        }
        $view = $this->getSinglePageTemplate($page);
        return $this->render($view, array(
            'page' => $page,
        ));
    }

    protected function getSinglePageTemplate($page):string {
        if (null === $page->getPageTemplate() || '' === $page->getPageTemplate()) {
            $view = '@easypage_templates/show.html.twig';
        } else {
            $view = $page->getPageTemplate();
        }
        return $view;
    }

    /**
     * @return BasePageRepository
     */
    protected function getPageRepository()
    {
        $em = $this->getDoctrine()->getManager();
        $pageEntity = $this->getParameter('mtt_easy_page.page_entity');
        return $em->getRepository($pageEntity);
    }

}
