<?php

namespace TypiCMS\Modules\Musiccards\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('musiccards::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.musiccards.sidebar.icon');
                $item->weight = config('typicms.musiccards.sidebar.weight');
                $item->route('admin.musiccards.index');
                $item->append('admin.musiccards.create');
                $item->authorize(
                    $this->auth->hasAccess('musiccards.index')
                );
            });
        });
    }
}
