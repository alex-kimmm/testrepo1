<?php

namespace TypiCMS\Modules\Usertitles\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('usertitles::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.usertitles.sidebar.icon');
                $item->weight = config('typicms.usertitles.sidebar.weight');
                $item->route('admin.usertitles.index');
                $item->append('admin.usertitles.create');
                $item->authorize(
                    $this->auth->hasAccess('usertitles.index')
                );
            });
        });
    }
}
