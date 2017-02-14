<?php

namespace TypiCMS\Modules\Sizes\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('sizes::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.sizes.sidebar.icon');
                $item->weight = config('typicms.sizes.sidebar.weight');
                $item->route('admin.sizes.index');
                $item->append('admin.sizes.create');
                $item->authorize(
                    $this->auth->hasAccess('sizes.index')
                );
            });
        });
    }
}
