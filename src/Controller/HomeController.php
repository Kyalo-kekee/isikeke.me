<?php

namespace App\Controller;

use App\Entity\ContactDto;
use App\ErrorHandler\ApplicationExceptions;
use App\Form\ContactMeType;
use App\Repository\ContactDtoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request,ContactDtoRepository $contactDtoRepository,ApplicationExceptions $exceptions): Response
    {
        $contact_me = new ContactDto();
        $contact_me_form = $this->createForm(ContactMeType::class,$contact_me);
        $contact_me_form ->handleRequest($request);

        if($contact_me_form ->isSubmitted() && $contact_me_form ->isValid()){
            try {

                $contact_me->setCreatedAt(new \DateTimeImmutable());
                $contactDtoRepository ->save($contact_me,true);
                return $this->json('success');
            }catch (\Exception $ex){
               return $exceptions->showError($ex->getMessage(),$ex->getCode() );
            }
        }
        return $this->render('base.html.twig', [
            'controller_name' => 'HomeController',
            'contact_form' => $contact_me_form ->createView()
        ]);
    }
}