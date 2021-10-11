<?php

namespace App\Traits;

trait FilterDataTrait 
{
    public function filterQuoteListByPersonality(array $quoteList, string $personality) :array
    {
        $capitalizePersonality = ucwords(str_replace('-',' ', $personality));

        $filteredQuotes = array_filter($quoteList, function($data) use ($capitalizePersonality) {
            return preg_match('/'.$capitalizePersonality.'/', $data['author']);
        });

        if(!empty($filteredQuotes)) $filteredQuotes = array_map(fn($data) => rtrim(strtoupper($data['quote']), ' \.\!') .'!', $filteredQuotes);

        return array_values($filteredQuotes);
    }
}