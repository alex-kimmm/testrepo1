<?php

namespace TypiCMS\Modules\Quotes\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('quotes::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.quotes.sidebar.icon');
                $item->weight = config('typicms.quotes.sidebar.weight');
                $item->route('admin.quotes.index');
                $item->append('admin.quotes.create');
                $item->authorize(
                    $this->auth->hasAccess('quotes.index')
                );
            });
        });
    }
}
