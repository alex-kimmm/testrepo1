<?php

namespace TypiCMS\Modules\Orders\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('orders::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.orders.sidebar.icon');
                $item->weight = config('typicms.orders.sidebar.weight');
                $item->route('admin.orders.index');
                $item->append('admin.orders.create');
                $item->authorize(
                    $this->auth->hasAccess('orders.index')
                );
            });
        });
    }
}
