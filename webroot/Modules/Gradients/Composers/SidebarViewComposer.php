<?php

namespace TypiCMS\Modules\Gradients\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('gradients::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.gradients.sidebar.icon');
                $item->weight = config('typicms.gradients.sidebar.weight');
                $item->route('admin.gradients.index');
                $item->append('admin.gradients.create');
                $item->authorize(
                    $this->auth->hasAccess('gradients.index')
                );
            });
        });
    }
}
