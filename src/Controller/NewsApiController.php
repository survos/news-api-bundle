<?php

namespace Survos\NewsApiBundle\Controller;

use Survos\NewsApiBundle\Service\NewsApiService;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use Symfony\Component\Routing\Attribute\Route;

class NewsApiController extends AbstractController
{
    public function __construct(
        private NewsApiService $newsApiService,
        private $simpleDatatablesInstalled = false
    )
    {
        $this->checkSimpleDatatablesInstalled();
    }

    private function checkSimpleDatatablesInstalled()
    {
        if (! $this->simpleDatatablesInstalled) {
            throw new \LogicException("This page requires SimpleDatatables\n composer req survos/simple-datatables-bundle");
        }
    }
    #[Route('/languages', name: 'survos_news_api_languages', methods: ['GET'])]
    #[Template('@SurvosNewsApi/languages.html.twig')]
    public function languages(
    ): Response|array
    {
        $languages = $this->newsApiService->getLanguages();
        return [
            'languages' => $languages,
        ];
    }

    #[Route('/search/{language}', name: 'survos_news_api_search', methods: ['GET'])]
    #[Template('@SurvosNewsApi/search.html.twig')]
    public function search(
        string $language,
        #[MapQueryParameter] ?string $q=null
    ): Response|array
    {
        if ($q) {
            $response = $this->newsApiService->search($language, $q);
            $articles = $response->articles;
            $total = $response->totalResults;
            return [
                'total' => $total,
                'articles' => $articles,
            ];
        } else {
            return [];
            // a nice search form
        }


    }

    #[Route('/sources/{language}', name: 'survos_news_api_sources', methods: ['GET'])]
    #[Template('@SurvosNewsApi/sources.html.twig')]
    public function sources(string $language=null): Response|array
    {
        $this->checkSimpleDatatablesInstalled();
        $sources  = $this->newsApiService->getSources($language);
        return [
            'sources' => $sources,
        ];
    }


}
