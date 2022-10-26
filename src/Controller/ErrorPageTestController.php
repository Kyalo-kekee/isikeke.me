<?php

namespace App\Controller;

use App\ErrorHandler\ApplicationExceptions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorPageTestController extends AbstractController
{
    #[Route('/error-page/test', name: 'app_error_page_test')]
    public function index(ApplicationExceptions $exceptions): Response
    {
        return $exceptions ->showError("This is an error");
    }
}