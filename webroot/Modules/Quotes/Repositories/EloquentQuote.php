<?php

namespace TypiCMS\Modules\Quotes\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Repositories\RepositoriesAbstract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;

class EloquentQuote extends RepositoriesAbstract implements QuoteInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get a page by its uri.
     *
     * @param string $uri
     * @param string $locale
     * @param array  $with
     *
     * @return TypiCMS\Modules\Models\Page $model
     */
    public function getFirstByUri($uri, $locale = null, array $with = [])
    {
        if(is_null($locale)){
            $locale = config('app.locale');
        }
        $model = $this->make($with)
            ->whereHas('translations', function (Builder $query) use ($uri, $locale) {
                $query->where('uri', $uri)
                    ->where('locale', $locale);
                if (!Request::input('preview')) {
                    $query->where('status', 1);
                }
            })
            ->first();

        return $model;
    }

}
