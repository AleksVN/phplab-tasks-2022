<?php

function getUniqueFirstLetters(array $airports)
{
    $letters = array_map(function ($item) {
        return ucfirst(substr($item['name'], 0, 1));
    }, $airports);

    sort($letters);

    return array_unique($letters);

}

function filterByLetter(array $airports, $letter)
{
    $resAirports = [];
    foreach ($airports as $airport) {
        if ($airport['name'][0] === $letter) {
            $resAirports[] = $airport;
        }
    }

    return $resAirports;
}

function filterByState(array $airports, $state)
{
    $resAirports = [];
    foreach ($airports as $airport) {
        if ($airport['state'] === $state) {
            $resAirports[] = $airport;
        }
    }

    return $resAirports;
}

function sortByField(array &$airports, $field)
{
    usort($airports, function ($a, $b) use ($field) {
        if ($a[$field] == $b[$field]) {
            return 0;
        }

        return ($a[$field] < $b[$field]) ? -1 : 1;
    }
    );
}

function addParams(...$params)
{
    $params = '?' . http_build_query(array_merge($_GET, ...$params));

    return $params;
}
