<?php

namespace App\Controller;

use App\Entity\Blog;
use App\Form\BlogType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", methods={"GET"})
     */
    public function create()
    {
        $form = $this->createForm(BlogType::class);

        return $this->render('blog/create.html.twig', [
            'blogForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/blog", methods={"POST"})
     */
    public function store(Request $request)
    {
        $blog = new Blog();

        $form = $this->createForm(BlogType::class, $blog);
        $form->handleRequest($request);

        if (!$form->isValid()) {
            //
            // @HELP: How can I implement redirecting to previous route
            // with all inputs and validation error messages?
            //
            // In Laravel, this happens automatically:
            // https://laravel.com/docs/8.x/validation#automatic-redirection
            // ...and I can retrieve the previous inputs
            // using `old()` global function inside template.
            //
            return $this->redirectToRoute('app_blog_create');
        }

        // @TODO: Save to database
        $this->addFlash('success', 'Blog created!');
        return $this->redirectToRoute('app_home_index');
    }
}
