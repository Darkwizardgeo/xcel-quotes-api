<?php

namespace App\Controller\Api;

use App\Service\QuoteDataFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;

class QuotesApiController extends AbstractController
{

    protected $quoteClient;

    public function __construct(QuoteDataFetcher $dataFetcher)
    {
        $this->quoteClient = $dataFetcher;
        
    }
    /**
     * @Route("/quote/{personality}", name="quote_get")
     */
    public function getQuotesAction(Request $request, string $personality, CacheInterface $cache) : Response
    {
        $limit =  $request->query->get('limit');
        if(is_null($limit) || !($limit > 0 && $limit <= 10) ) {
            return new JsonResponse(['message' => 'Not valid number of quotes on query'], 400);
        }
        
        $quotes = $this->quoteClient->fetchPersonalityQuotesList($limit, $personality);

        return new JsonResponse($quotes);
    }
}
