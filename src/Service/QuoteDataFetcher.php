<?php

namespace App\Service;

use App\Interfaces\FetchQuotesInterface;
use App\Traits\FilterDataTrait;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class QuoteDataFetcher implements FetchQuotesInterface
{

    use FilterDataTrait;

    protected $clientPath;
    protected $cacheClient;

    public function __construct(string $clientDataPath, CacheInterface $cache)
    {
        $this->clientPath = __DIR__ . $clientDataPath;
        $this->cacheClient = $cache;
    }

    public function fetchPersonalityQuotesList(int $count, string $personality): array
    {
        $rawData = file_get_contents($this->clientPath);
        $quoteList = json_decode($rawData, true)['quotes'];

        $personseQuotes = $this->filterQuoteListByPersonality($quoteList, $personality);

        $cacheKey = 'Quote-Data-'.$personality.'-'.$count;
        return (is_null($personseQuotes)) ? [] : $this->cacheClient->get($cacheKey, function (ItemInterface $item) use ($quoteList, $personality) {
            $item->expiresAfter(3600);
            return $this->filterQuoteListByPersonality($quoteList, $personality);
        });
        
    }
}
