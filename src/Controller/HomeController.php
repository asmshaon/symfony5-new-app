<?php
/**
 * Created by Abu.
 * Author: Abu
 * Email: srabon.php@gmail.com
 * Date: 4/17/20 3:41 PM
 * To make changes please contact author
 */

namespace App\Controller;

use App\Entity\News;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment as Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Class HomeController
 *
 * @package App\Controller
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/")
     *
     * @return Response
     */
    public function index(): Response
    {
        return new Response('This is my symfony page.');
    }

    /**
     * @Route("/questions/{slug}")
     *
     * @param string $slug
     * @param Twig $twig
     *
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function questions(string $slug, Twig $twig): Response
    {
        $answers = [
            'Answer no 1',
            'Answer no 2',
            'Answer no 3',
        ];

        dump($answers);

        $html = $twig->render('question/show.html.twig', [
                'question' => $slug,
                'answers' => $answers
            ]
        );

        return new Response($html);

        /*return $this->render('question/show.html.twig', [
            'question' => $slug,
            'answers' => $answers
        ]);*/
    }

    /**
     * @Route("/news")
     *
     * @param EntityManagerInterface $entityManager
     *
     * @return JsonResponse
     * @throws Exception
     */
    public function news(EntityManagerInterface $entityManager): JsonResponse
    {
       $repository = $entityManager->getRepository(News::class);

        $news = $repository->find(1);
        dd($news);

        return new JsonResponse($repository->sdd(1));
    }
}
