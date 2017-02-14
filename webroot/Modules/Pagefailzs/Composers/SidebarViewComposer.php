<?php

namespace TypiCMS\Modules\Pagefailzs\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('pagefailzs::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.pagefailzs.sidebar.icon');
                $item->weight = config('typicms.pagefailzs.sidebar.weight');
                $item->route('admin.pagefailzs.index');
                $item->append('admin.pagefailzs.create');
                $item->authorize(
                    $this->auth->hasAccess('pagefailzs.index')
                );
            });
        });
    }
}
