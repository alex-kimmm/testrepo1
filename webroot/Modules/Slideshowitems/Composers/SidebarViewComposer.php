<?php

namespace TypiCMS\Modules\Slideshowitems\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('slideshowitems::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.slideshowitems.sidebar.icon');
                $item->weight = config('typicms.slideshowitems.sidebar.weight');
                $item->route('admin.slideshowitems.index');
                $item->append('admin.slideshowitems.create');
                $item->authorize(
                    $this->auth->hasAccess('slideshowitems.index')
                );
            });
        });
    }
}
