<?php

namespace TypiCMS\Modules\Insuranceblocks\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('insuranceblocks::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.insuranceblocks.sidebar.icon');
                $item->weight = config('typicms.insuranceblocks.sidebar.weight');
                $item->route('admin.insuranceblocks.index');
                $item->append('admin.insuranceblocks.create');
                $item->authorize(
                    $this->auth->hasAccess('insuranceblocks.index')
                );
            });
        });
    }
}
