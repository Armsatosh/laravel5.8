<?php


namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BlogPostRepository extends CoreRepository
{
    protected function getModelClass ()
    {
        return Model::class;
    }
    /**
     *
     *@return LengthAwarePaginator
     */

    public function getAllWithPaginate()
    {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id',
        ];
        $resoult = $this
            ->startConditions()
            ->select($columns)
            ->orderBy('id','DESC')
            ->with(['category' => function ($query){
                $query->select(['id','title']);
            },
              'user:id,name'
            ])
            ->paginate(25);
        return $resoult;
    }
}