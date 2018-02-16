<?php
namespace Mtt\CatalogBundle\Service\Product;
use Mtt\Core\Interfaces\Catalog\Entity\ProductInterface;

class ImagerService
{
    protected $vichUploaderHelperService;

    public function __construct(\Vich\UploaderBundle\Templating\Helper\UploaderHelper $vichUploaderHelper)
    {
        $this->vichUploaderHelperService = $vichUploaderHelper;
    }

    public function getProductMainImgPath(ProductInterface $entity):string{
        $image = null;
        if(null !== $entity->getMainImage()) {
            $image = $this->vichUploaderHelperService->asset($entity, 'mainImageFile');
        }

        if(null === $image){
            $image = 'bundles/mttcatalog/images/placeholder.jpg';
        }
        return $image;
    }
}