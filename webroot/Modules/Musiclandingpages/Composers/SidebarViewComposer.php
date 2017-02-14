<?php

namespace TypiCMS\Modules\Musiclandingpages\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('musiclandingpages::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.musiclandingpages.sidebar.icon');
                $item->weight = config('typicms.musiclandingpages.sidebar.weight');
                $item->route('admin.musiclandingpages.index');
                $item->append('admin.musiclandingpages.create');
                $item->authorize(
                    $this->auth->hasAccess('musiclandingpages.index')
                );
            });
        });
    }
}
