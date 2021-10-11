<?php

namespace App\Tests\Unit\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class QuoteApiControllerTest extends WebTestCase
{

    public function testGetQuoteAction()
    {
        $client = static::createClient();

        $client->request('GET', '/api/quote/steve-jobs', ['limit' => 2]);

        $response = $client->getResponse();

        $this->assertResponseIsSuccessful();
        $this->assertJson($response->getContent());
    }

    public function testLimitOutOfRange()
    {
        $client = static::createClient();

        $client->request('GET', '/api/quote/steve-jobs', ['limit' => 11]);
        $response = $client->getResponse();

        $this->assertResponseStatusCodeSame(400,  'Not valid number of quotes on query');
        $this->assertJson($response->getContent());

    }
}