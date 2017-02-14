<?php

namespace TypiCMS\Modules\Usertitles\Facades;

use Illuminate\Support\Facades\Facade as MainFacade;

class Facade extends MainFacade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'TypiCMS\Modules\Usertitles\Repositories\UsertitleInterface';
    }
}
