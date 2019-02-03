<?php

// Home
Breadcrumbs::for('index', function ($trail) {
    $trail->push(__('custom.home'), route('index'));
});

// Home > About
Breadcrumbs::for('page', function ($trail, $page) {
    $trail->parent('index');
    $trail->push($page->title, route('page', $page->slug));
});


// Home > Portfolio
Breadcrumbs::for('portfolio.index', function ($trail) {
    $trail->parent('index');
    $trail->push(__('custom.portfolio'), route('portfolio.index'));
});

// Home > Portfolio > [Item]
Breadcrumbs::for('portfolio.show', function ($trail, $item) {
    $trail->parent('portfolio.index');
    $trail->push($item->title, route('portfolio.show', $item->slug));
});

// Home > Portfolio > [Category]
Breadcrumbs::for('portfolio.category.show', function ($trail, $category) {
    $trail->parent('portfolio.index');
    $trail->push($category->title, route('portfolio.category.show', $category->slug));
});

// Home > Blog
Breadcrumbs::for('blog.index', function ($trail) {
    $trail->parent('index');
    $trail->push(__('custom.blog'), route('blog.index'));
});

// Home > Blog > [Item]
Breadcrumbs::for('blog.show', function ($trail, $item) {
    $trail->parent('blog.index');
    $trail->push($item->title, route('blog.show', $item->slug));
});

// Home > Blog > [Category]
Breadcrumbs::for('blog.category.show', function ($trail, $category) {
    $trail->parent('blog.index');
    $trail->push($category->title, route('blog.category.show', $category->slug));
});
