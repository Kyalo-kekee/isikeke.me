<?php

namespace App\Controller;

use App\Entity\Tags;
use App\Form\TagsType;
use App\Repository\TagsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/Admin/blog-tags')]
class BlogTagsController extends AbstractController
{
    #[Route('/', name: 'app_blog_tags_index', methods: ['GET'])]
    public function index(TagsRepository $tagsRepository): Response
    {
        return $this->render('Admin/blog_tags/index.html.twig', [
            'tags' => $tagsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_blog_tags_new', methods: ['GET', 'POST'])]
    public function new(Request $request, TagsRepository $tagsRepository): Response
    {
        $tag = new Tags();
        $form = $this->createForm(TagsType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tag->setCreatedAt(new \DateTimeImmutable());
            $tagsRepository->save($tag, true);

            return $this->redirectToRoute('app_blog_tags_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('Admin/blog_tags/new.html.twig', [
            'tag' => $tag,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_blog_tags_show', methods: ['GET'])]
    public function show(Tags $tag): Response
    {
        return $this->render('Admin/blog_tags/show.html.twig', [
            'tag' => $tag,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_blog_tags_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tags $tag, TagsRepository $tagsRepository): Response
    {
        $form = $this->createForm(TagsType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $tagsRepository->save($tag, true);

            return $this->redirectToRoute('app_blog_tags_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Admin/blog_tags/edit.html.twig', [
            'tag' => $tag,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_blog_tags_delete', methods: ['POST'])]
    public function delete(Request $request, Tags $tag, TagsRepository $tagsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tag->getId(), $request->request->get('_token'))) {
            $tagsRepository->remove($tag, true);
        }

        return $this->redirectToRoute('app_blog_tags_index', [], Response::HTTP_SEE_OTHER);
    }
}