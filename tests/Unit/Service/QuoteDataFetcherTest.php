<?php

namespace App\Tests\Unit\Service;

use App\Service\QuoteDataFetcher;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class QuoteDataFetcherTest extends WebTestCase
{

    public function testQuotesFound()
    {
        self::bootKernel();

        $container = static::getContainer();

        $quoteDataService = $container->get(QuoteDataFetcher::class);

        $response = $quoteDataService->fetchPersonalityQuotesList(5, 'steve-jobs');

        $this->assertNotEmpty($response);
        $this->assertIsArray($response);
    }

    public function testQuotesNotFound()
    {
        self::bootKernel();

        $container = static::getContainer();

        $quoteDataService = $container->get(QuoteDataFetcher::class);

        $response = $quoteDataService->fetchPersonalityQuotesList(5, 'not-listed');

        $this->assertEmpty($response);
        $this->assertIsArray($response);
    }
}