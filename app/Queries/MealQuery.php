<?php

namespace App\Queries;

use App\Http\Pagination\CustomLinks;
use App\Http\Resources\MealCollection;
use App\Models\Meal;
use Illuminate\Http\Request;

class MealQuery
{
    protected $parameters = [
        'category',
        'tags',
        'with',
        'lang',
        'diff_time'
    ];

    protected $with = [
        'category',
        'tags',
        'ingredients'
    ];

    public function transform(Request $request)
    {
        $validData = $request->validate([
            'per_page' => 'integer',
            'page' => 'integer',
            'category' => 'string',
            'tags' => 'string',
            'with' => 'string',
            'lang' => 'required',
            'diff_time' => 'integer|min:1',
        ]);

        app()->setLocale($validData['lang']);

        $withTrashed = !empty($validData['diff_time']);

        $meals = $withTrashed ? Meal::withTrashed() : Meal::withoutTrashed();

        foreach ($validData as $parameter => $data) {

            switch ($parameter) {
                case 'category':
                    if (strtoupper($data) == '!NULL') {
                        $meals = $meals->whereNotNull('category_id');
                    }

                    if (strtoupper($data) == 'NULL') {
                        $meals = $meals->whereNull('category_id');
                    }

                    if (is_numeric($data)) {
                        $meals = $meals->where('category_id', $data);
                    }
                    break;

                case 'tags':
                    $this->tags = explode(',', $data);

                    $meals = $meals->whereHas('tags', function ($query) {
                        $query->whereIn('id', $this->tags);
                    });
                    break;

                case 'with':
                    $with = explode(',', $data);
                    $validWith = array_intersect($this->with, $with);
                    $meals = $meals->with($validWith);
                    break;

                case 'diff_time':
                    $date = date('Y-m-d H:i:s', $data);

                    $meals = $meals->whereDate('created_at', '>', $date, 'OR')
                        ->whereDate('updated_at', '>', $date)
                        ->whereDate('deleted_at', '>', $date);
                    break;
            }
        }

        $page = $validData['page'] ?? 1;
        $perPage = $validData['per_page'] ?? 10;
        $total = $meals->count();
        $totalPages = ceil($total / $perPage);

        $meals = $meals->offset(($page - 1) * $perPage)->limit($perPage)->get();

        return [
            'meta' => [
                "currentPage" => (int)$page,
                "totalItems" => (int)$total,
                "itemsPerPage" => (int)$perPage,
                "totalPages" => (int)$totalPages
            ],
            'data' => new MealCollection($meals),
            'links' => CustomLinks::links($request, $totalPages)
        ];
    }
}
