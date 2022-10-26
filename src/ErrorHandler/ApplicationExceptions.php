<?php

namespace App\ErrorHandler;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApplicationExceptions extends AbstractController
{

    public function  showError ( string $error, $error_code = null)
    {
        return $this->render('Errors/error_test.html.twig', [
            'controller_name' => 'ErrorPageTestController',
            'ex' => $error,
            'code' => $error_code
        ]);
    }
}