<?php

namespace TypiCMS\Modules\Insurancelandings\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('insurancelandings::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.insurancelandings.sidebar.icon');
                $item->weight = config('typicms.insurancelandings.sidebar.weight');
                $item->route('admin.insurancelandings.index');
                $item->append('admin.insurancelandings.create');
                $item->authorize(
                    $this->auth->hasAccess('insurancelandings.index')
                );
            });
        });
    }
}
