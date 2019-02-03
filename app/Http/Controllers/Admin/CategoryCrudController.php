<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CategoryRequest as StoreRequest;
use App\Http\Requests\CategoryRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class CategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CategoryCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Category');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/category');
        $this->crud->setEntityNameStrings('category', 'categories');
//        $this->crud->
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
//        $this->crud->setFromDb();

        $this->crud->addColumns(['title', 'slug']);

        $this->crud->addField([
            'name' => 'title',
            'label' => 'Title',
            'tab' => 'Custom'
        ]);

        $this->crud->addField([
            'name' => 'slug',
            'label' => 'Slug',
            'tab' => 'Custom'
        ]);

        //Seo
        $this->crud->addField([
            'type' => 'seo',
            'name' => 'seo',
            'tab' => 'Seo'
        ]);

        // add asterisk for fields that are required in CategoryRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);

        $locale = $request->get('locale') ?? config('app.locale');

        foreach ($request->get('seo') as $key => $value) {
            $this->crud->entry->seo->setTranslation($key, $locale, $value);
        }
        $this->crud->entry->seo->save();

        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);

        $locale = $request->get('locale') ?? config('app.locale');

        foreach ($request->get('seo') as $key => $value) {
            $this->crud->entry->seo->setTranslation($key, $locale, $value);
        }
        $this->crud->entry->seo->save();

        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
