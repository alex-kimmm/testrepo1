<?php

namespace TypiCMS\Modules\Landingpages\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('landingpages::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.landingpages.sidebar.icon');
                $item->weight = config('typicms.landingpages.sidebar.weight');
                $item->route('admin.landingpages.index');
                $item->append('admin.landingpages.create');
                $item->authorize(
                    $this->auth->hasAccess('landingpages.index')
                );
            });
        });
    }
}
