<?php

namespace TypiCMS\Modules\Slideshows\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('slideshows::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.slideshows.sidebar.icon');
                $item->weight = config('typicms.slideshows.sidebar.weight');
                $item->route('admin.slideshows.index');
                $item->append('admin.slideshows.create');
                $item->authorize(
                    $this->auth->hasAccess('slideshows.index')
                );
            });
        });
    }
}
