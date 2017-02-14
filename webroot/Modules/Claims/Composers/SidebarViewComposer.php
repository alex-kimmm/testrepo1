<?php

namespace TypiCMS\Modules\Claims\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('claims::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.claims.sidebar.icon');
                $item->weight = config('typicms.claims.sidebar.weight');
                $item->route('admin.claims.index');
                $item->append('admin.claims.create');
                $item->authorize(
                    $this->auth->hasAccess('claims.index')
                );
            });
        });
    }
}
