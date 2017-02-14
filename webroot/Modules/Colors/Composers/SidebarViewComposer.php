<?php

namespace TypiCMS\Modules\Colors\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('colors::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.colors.sidebar.icon');
                $item->weight = config('typicms.colors.sidebar.weight');
                $item->route('admin.colors.index');
                $item->append('admin.colors.create');
                $item->authorize(
                    $this->auth->hasAccess('colors.index')
                );
            });
        });
    }
}
