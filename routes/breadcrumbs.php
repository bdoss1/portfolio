<?php

// Home
Breadcrumbs::for('index', function ($trail) {
    $trail->push(__('custom.home'), route('index'));
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