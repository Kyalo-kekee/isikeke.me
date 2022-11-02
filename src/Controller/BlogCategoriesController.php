<?php

namespace App\Controller;

use App\Entity\BlogCategories;
use App\Form\BlogCategoriesType;
use App\Repository\BlogCategoriesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/Admin/blog-categories')]
class BlogCategoriesController extends AbstractController
{
    #[Route('/', name: 'app_blog_categories_index', methods: ['GET'])]
    public function index(BlogCategoriesRepository $blogCategoriesRepository): Response
    {
        return $this->render('Admin/blog_categories/index.html.twig', [
            'blog_categories' => $blogCategoriesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_blog_categories_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BlogCategoriesRepository $blogCategoriesRepository): Response
    {
        $blogCategory = new BlogCategories();
        $form = $this->createForm(BlogCategoriesType::class, $blogCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blogCategory->setCreatedAt(new \DateTimeImmutable());
            $blogCategoriesRepository->save($blogCategory, true);

            return $this->redirectToRoute('app_blog_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Admin/blog_categories/new.html.twig', [
            'blog_category' => $blogCategory,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_blog_categories_show', methods: ['GET'])]
    public function show(BlogCategories $blogCategory): Response
    {
        return $this->render('Admin/blog_categories/show.html.twig', [
            'blog_category' => $blogCategory,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_blog_categories_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BlogCategories $blogCategory, BlogCategoriesRepository $blogCategoriesRepository): Response
    {
        $form = $this->createForm(BlogCategoriesType::class, $blogCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $blogCategory ->setUpdatedAt(new \DateTimeImmutable());
            $blogCategoriesRepository->save($blogCategory, true);

            return $this->redirectToRoute('app_blog_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Admin/blog_categories/edit.html.twig', [
            'blog_category' => $blogCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_blog_categories_delete', methods: ['POST'])]
    public function delete(Request $request, BlogCategories $blogCategory, BlogCategoriesRepository $blogCategoriesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blogCategory->getId(), $request->request->get('_token'))) {
            $blogCategoriesRepository->remove($blogCategory, true);
        }

        return $this->redirectToRoute('app_blog_categories_index', [], Response::HTTP_SEE_OTHER);
    }
}