<?php

namespace TypiCMS\Modules\Insurancepages\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('insurancepages::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.insurancepages.sidebar.icon');
                $item->weight = config('typicms.insurancepages.sidebar.weight');
                $item->route('admin.insurancepages.index');
                $item->append('admin.insurancepages.create');
                $item->authorize(
                    $this->auth->hasAccess('insurancepages.index')
                );
            });
        });
    }
}
