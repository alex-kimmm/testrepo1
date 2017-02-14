<?php

namespace TypiCMS\Modules\Failzs\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('failzs::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.failzs.sidebar.icon');
                $item->weight = config('typicms.failzs.sidebar.weight');
                $item->route('admin.failzs.index');
                $item->append('admin.failzs.create');
                $item->authorize(
                    $this->auth->hasAccess('failzs.index')
                );
            });
        });
    }
}
