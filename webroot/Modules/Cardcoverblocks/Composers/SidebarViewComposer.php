<?php

namespace TypiCMS\Modules\Cardcoverblocks\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('cardcoverblocks::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.cardcoverblocks.sidebar.icon');
                $item->weight = config('typicms.cardcoverblocks.sidebar.weight');
                $item->route('admin.cardcoverblocks.index');
                $item->append('admin.cardcoverblocks.create');
                $item->authorize(
                    $this->auth->hasAccess('cardcoverblocks.index')
                );
            });
        });
    }
}
