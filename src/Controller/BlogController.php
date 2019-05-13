<?php
// src/Controller/BlogController.php
namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



/**
 * @Route("/blog", name="blog_")
 */

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_index")
     */
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'owner' => 'Nono',
        ]);
    }

    /**
     * @Route("/list/{page}", requirements={"page"="\d+"}, defaults={"page"=1}, name="blog_list")
     */
    public function list($page)
    {
        return $this->render('blog/list.html.twig', ['page' => $page]);
    }

    /**
     * @Route("/show/{slug}", requirements={"slug"="[-a-z0-9]*"}, defaults={"slug"="Article Sans Titre"}, name="show_item")
     */
    public function show($slug)
    {
        return $this->render('blog/show.html.twig', ['slug' => ucwords(implode(" ", explode("-", $slug)))]);
    }
}