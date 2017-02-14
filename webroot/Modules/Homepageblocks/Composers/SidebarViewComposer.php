<?php

namespace TypiCMS\Modules\Homepageblocks\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('homepageblocks::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.homepageblocks.sidebar.icon');
                $item->weight = config('typicms.homepageblocks.sidebar.weight');
                $item->route('admin.homepageblocks.index');
                $item->append('admin.homepageblocks.create');
                $item->authorize(
                    $this->auth->hasAccess('homepageblocks.index')
                );
            });
        });
    }
}
