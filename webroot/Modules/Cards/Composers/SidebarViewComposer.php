<?php

namespace TypiCMS\Modules\Cards\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('cards::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.cards.sidebar.icon');
                $item->weight = config('typicms.cards.sidebar.weight');
                $item->route('admin.cards.index');
                $item->append('admin.cards.create');
                $item->authorize(
                    $this->auth->hasAccess('cards.index')
                );
            });
        });
    }
}
