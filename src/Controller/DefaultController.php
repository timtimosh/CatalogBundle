<?php
namespace CatalogBundle\Controller;

use CatalogBundle\Entity\MttCatalogProduct;
use CatalogBundle\Service\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    /**
     * @Route("/catalog", name="catalog_default_page")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return new Response("test me");
    }

    /**
     * @Route("/catalog/product/new", name="catalog_create_new_product")
     */
    public function newAction(Request $request)
    {

        $product_service = $this->get('catalog_product');
        $product = $product_service->create();
        $product->setSku(random_int(1,99999));
        $product->setIdErp(random_int(1,99999));
        $product->setName('newProduct'.random_int(1,99999));
        $product_service->save($product);

        // replace this example code with whatever you need
        return new Response("test save");
    }

    /**
     * @Route("/catalog/product/all", name="catalog_find_product")
     */
    public function findAction(Request $request)
    {
        $product_service = $this->container->get('catalog_product');
        $all_products = $product_service->findAll();
        dump($all_products);
        // replace this example code with whatever you need
        return new Response("test save");
    }

    /**
     * @Route("/catalog/product/{id}", name="catalog_find_one_product")
     */
    public function findOne(Request $request, $id)
    {
        $product_service = $this->container->get('catalog_product');
        $all_products = $product_service->find($id);
        dump($all_products);
        // replace this example code with whatever you need
        return new Response("test save");
    }

}
