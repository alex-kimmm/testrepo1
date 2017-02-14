<?php

namespace TypiCMS\Modules\Products\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('products::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.products.sidebar.icon');
                $item->weight = config('typicms.products.sidebar.weight');
                $item->route('admin.products.index');
                $item->append('admin.products.create');
                $item->authorize(
                    $this->auth->hasAccess('products.index')
                );
            });
        });
    }
}
