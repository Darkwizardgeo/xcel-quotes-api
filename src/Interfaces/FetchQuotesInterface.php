<?php

namespace App\Interfaces;

interface FetchQuotesInterface
{
    public function fetchPersonalityQuotesList(int $count, string $personality): array;

}