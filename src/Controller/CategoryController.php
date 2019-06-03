<?php


namespace App\Controller;

use App\Entity\Category;
use App\Entity\Article;
use App\Form\CategoryType;
use phpDocumentor\Reflection\Location;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @param Request $request
     * @Route("/category", name="category_add", methods="GET|POST")
     * @return Response
     */
    public function add(Request $request) : Response
    {
        $newCat = new Category();
        $form = $this->createForm(CategoryType::class, $newCat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newCat);
            $em->flush();

            return $this->redirectToRoute('blog_index');

        }

        return $this->render(
            'blog/add.html.twig',
            [
                'form' => $form->createView()
            ]);

    }
}