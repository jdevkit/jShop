<?php

use Spatie\Menu\Laravel\Menu;

//Menu::macro('fullsubmenuexample', function () {
//    return Menu::new()->prepend('<a href="#"><span> Multilevel PROVA </span> <i class="fa fa-angle-left pull-right"></i></a>')
//        ->addParentClass('treeview')
//        ->add(Link::to('/link1prova', 'Link1 prova'))->addClass('treeview-menu')
//        ->add(Link::to('/link2prova', 'Link2 prova'))->addClass('treeview-menu')
//        ->url('http://www.google.com', 'Google');
//});

Menu::macro('adminlteSubmenu', function ($submenuName) {
    return Menu::new()->prepend('<a href="#"><span> ' . $submenuName . '</span> <i class="fa fa-angle-left pull-right"></i></a>')
        ->addParentClass('treeview')->addClass('treeview-menu');
});
Menu::macro('adminlteMenu', function () {
    return Menu::new()
        ->addClass('sidebar-menu');
});
Menu::macro('adminlteSeparator', function ($title) {
    return Html::raw($title)->addParentClass('header');
});

Menu::macro('adminlteDefaultMenu', function ($content) {
    return Html::raw('<i class="fa fa-link"></i><span>' . $content . '</span>')->html();
});

Menu::macro('sidebar', function () {
    return Menu::adminlteMenu()
//        ->add(Html::raw('HEADER')->addParentClass('header'))
        ->action('admin\AdminController@index', '<i class="fa fa-home"></i><span>Home</span>')
//        ->link('http://www.acacha.org', Menu::adminlteDefaultMenu('Another link'))
////        ->url('http://www.google.com', 'Google')
//        ->add(Menu::adminlteSeparator('Acacha Adminlte'))
//        #adminlte_menu
        ->add(Menu::new()->prepend('<a href="#"><i class="fa fa-address-card-o"></i><span>Users</span> <i class="fa fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::to(route('admin.users'), 'Users'))->addClass('treeview-menu')
            ->add(Link::to(route('admin.permissions'), 'Roles & Permissions'))
        )

        ->add(Link::toUrl(route('books.index'), '<i class="fa fa-book"></i><span>Books</span>'))
        ->add(Link::toUrl(route('authors.index'), '<i class="fa fa-users"></i><span>Authors</span>'))
        ->add(Link::toUrl(route('comments.index'), '<i class="fa fa-comments-o"></i><span>Comments</span>'))
        ->add(Link::toUrl(route('genres.index'), '<i class="fa fa-list-alt"></i><span>Genres</span>'))

        ->add(Menu::new()->prepend('<a href="#"><i class="fa fa-share"></i><span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>')
            ->addParentClass('treeview')
            ->add(Link::to('/link1', 'Link1'))->addClass('treeview-menu')
            ->add(Link::to('/link2', 'Link2'))
            ->url('http://www.google.com', 'Google')
            ->add(Menu::new()->prepend('<a href="#"><span>Multilevel 2</span> <i class="fa fa-angle-left pull-right"></i></a>')
                ->addParentClass('treeview')
                ->add(Link::to('/link21', 'Link21'))->addClass('treeview-menu')
                ->add(Link::to('/link22', 'Link22'))
                ->url('http://www.google.com', 'Google')
            )
        )
//        ->add(
//            Menu::fullsubmenuexample()
//        )
//        ->add(
//            Menu::adminlteSubmenu('Best menu')
//                ->add(Link::to('/acacha', 'acacha'))
//                ->add(Link::to('/profile', 'Profile'))
//                ->url('http://www.google.com', 'Google')
//        )
        ->setActiveFromRequest();
});
