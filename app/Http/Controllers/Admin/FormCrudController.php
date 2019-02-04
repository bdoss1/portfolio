<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\FormRequest as StoreRequest;
use App\Http\Requests\FormRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;

/**
 * Class FormCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class FormCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Form');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/form');
        $this->crud->setEntityNameStrings('form', 'forms');

        $this->crud->denyAccess('create');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
//        $this->crud->setFromDb();
        $this->crud->setColumns([
            'title', 'url', 'name', 'email', 'message', 'custom',
            [
                'name' => 'user_id',
                'label' => 'User',
                'entity' => 'user',
                'attribute' => 'name',
                'type' => 'select'
            ],
            [
                'name' => 'status',
                'label' => 'Status',
                'type' => 'select_from_array',
                'options' => [
                    0 => 'No processed',
                    1 => 'Processed'
                ],
                'default' => 0
            ],
            'created_at'
        ]);

        $this->crud->addFields([
            'title',
            'message',
            [
                'name' => 'status',
                'label' => 'Status',
                'type' => 'select_from_array',
                'options' => [
                    0 => 'No processed',
                    1 => 'Processed'
                ],
                'default' => 0
            ]
        ]);

        // add asterisk for fields that are required in FormRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
