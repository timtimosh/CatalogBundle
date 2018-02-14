<?php
namespace Mtt\CatalogBundle\Listeners\Doctrine;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Exception\ValidatorException;
use Mtt\Core\Interfaces\Catalog\Entity\BasicEntityInterface;

trait ValidationTrait
{

    protected function validate(BasicEntityInterface $entity)
    {
        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $errors = $validator->validate($entity);
        if (count($errors) > 0) {
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList object. This gives us a nice string
             * for debugging.
             */
            $errorsString = (string) $errors;

            throw new ValidatorException($errorsString);
        }
    }
}