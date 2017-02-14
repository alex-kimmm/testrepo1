<?php

namespace TypiCMS\Modules\Headerblocks\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('headerblocks::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.headerblocks.sidebar.icon');
                $item->weight = config('typicms.headerblocks.sidebar.weight');
                $item->route('admin.headerblocks.index');
                $item->append('admin.headerblocks.create');
                $item->authorize(
                    $this->auth->hasAccess('headerblocks.index')
                );
            });
        });
    }
}
