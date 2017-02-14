<?php

namespace TypiCMS\Modules\Faceofzzlandings\Composers;

use Illuminate\Contracts\View\View;
use Maatwebsite\Sidebar\SidebarGroup;
use Maatwebsite\Sidebar\SidebarItem;
use TypiCMS\Modules\Core\Composers\BaseSidebarViewComposer;

class SidebarViewComposer extends BaseSidebarViewComposer
{
    public function compose(View $view)
    {
        $view->sidebar->group(trans('global.menus.content'), function (SidebarGroup $group) {
            $group->addItem(trans('faceofzzlandings::global.name'), function (SidebarItem $item) {
                $item->icon = config('typicms.faceofzzlandings.sidebar.icon');
                $item->weight = config('typicms.faceofzzlandings.sidebar.weight');
                $item->route('admin.faceofzzlandings.index');
                $item->append('admin.faceofzzlandings.create');
                $item->authorize(
                    $this->auth->hasAccess('faceofzzlandings.index')
                );
            });
        });
    }
}
