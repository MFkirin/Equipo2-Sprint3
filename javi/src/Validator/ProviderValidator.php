<?php
declare(strict_types=1);

namespace App\Validator;
use App\Core\ValidatorInterface;
use App\Core\EntityInterface;

class ProviderValidator implements ValidatorInterface
{

    public function validate(EntityInterface $entity): array
    {
        // Realizar las validaciones de campos
        $emailPattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
        $phonePattern = "/^\d{9}$/";
        $dniPattern = "/^[0-9]{8}[A-Z]{1}$/";
        $cifPattern = "/^[A-Z]{1}[0-9]{8}/";
        $addressPattern = "";
        $bankTitlePattern = "";
        $managerNIFPattern = "/^[0-9]{8}[A-Z]{1}$/";
        $LOPDdocPattern = "";
        $constitutionArticlePattern = "";

        $email = $entity->getEmail();
        $phone = $entity->getPhone();
        $dni = $entity->getDni();
        $cif = $entity->getCif();
        $address = $entity->getAddress();
        $bankTitle = $entity->getBankTitle();
        $managerNIF = $entity->getManagerNIF();
        $LOPDdoc = $entity->getLOPDdoc();
        $constitutionArticle = $entity->getConstitutionArticle();

        $errores = [];
        if (!preg_match($emailPattern, $email)) {
            $errores[] = 'Correu Electrònic incorrecte';
        }

        if (!preg_match($phonePattern, $phone)) {
            $errores[] = 'Telèfon incorrecte';
        }

        if (!preg_match($dniPattern, $dni)) {
            $errores[] = 'DNI incorrecte';
        }

        if (!preg_match($cifPattern, $cif)) {
            $errores[] = 'CIF incorrecte';
        }

        /**
        if (!preg_match($addressPattern, $address)) {
        $errores[] = 'Adreça incorrecta';
        }
         */

        /**
        if (!preg_match($bankTitlePattern, $bankTitle)) {
        $errores[] = 'Títol del banc incorrecte';
        }
         */
        if (!preg_match($managerNIFPattern, $managerNIF)) {
            $errores[] = 'NIF del gerent incorrecte';
        }

        /**
        if (!preg_match($LOPDdocPattern, $LOPDdoc)) {
        $errores[] = 'Document LOPD incorrecte';
        }
         */
        /**
        if (!preg_match($constitutionArticlePattern, $constitutionArticle)) {
        $errores[] = 'Article de la constitució incorrecte';
        }
         */

        return $errores;
    }
}