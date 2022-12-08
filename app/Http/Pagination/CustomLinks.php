<?php

namespace App\Http\Pagination;

use Illuminate\Http\Request;

class CustomLinks
{
    public static function links(Request $request, int $totalPages = 0)
    {
        $currentPage = $request->fullUrl();

        $url_components = parse_url($currentPage);

        parse_str($url_components['query'], $params);

        $page = $params['page'] ?? 1;
        $lastPage = $page - 1;
        $followingPage = $page + 1;

        if (!str_contains($currentPage, "&page={$page}")) {
            $currentPage .= "&page={$page}";
        }

        $previousPage = $page <= 1 ? null : str_replace("&page={$page}", "&page={$lastPage}", $currentPage);

        $nextPage = $page >= $totalPages ? null : str_replace("&page={$page}", "&page={$followingPage}", $currentPage);

        return [
            'prev' => urldecode($previousPage),
            'next' => urldecode($nextPage),
            'self' => urldecode($currentPage)
        ];
    }
}
