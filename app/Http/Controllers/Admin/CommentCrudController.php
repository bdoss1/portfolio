<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\CommentRequest as StoreRequest;
use App\Http\Requests\CommentRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use Illuminate\Http\Request;

/**
 * Class CommentCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class CommentCrudController extends CrudController
{

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Comment');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/comment');
        $this->crud->setEntityNameStrings('comment', 'comments');

        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        $this->crud->denyAccess('create');

        // TODO: remove setFromDb() and manually define Fields and Columns
        // $this->crud->setFromDb();

        $this->crud->addColumn('message');

        $this->crud->addColumn([
            'name' => 'user_id',
            'label' => 'User',
            'type' => 'select',
            'entity' => 'user',
            'attribute' => 'name'
        ]);

        $this->crud->addColumns(['name', 'email', 'created_at']);

        $this->crud->addColumn([
            'name' => 'approved',
            'label' => 'Approved', // Table column heading
            'type' => 'model_function',
            'function_name' => 'isApproved'
        ]);

        $this->crud->addField([
            'name' => 'message',
            'label' => 'Comment',
            'type' => 'textarea',
        ]);

        $this->crud->addField([
            'name' => 'user_id',
            'label' => 'User',
            'type' => 'select',
            'entity' => 'user',
            'attribute' => 'name'
        ]);

        // add asterisk for fields that are required in CommentRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');

//        $this->crud->addButtonFromModelFunction('line', 'Approve', 'approve', 'beginning');
        $this->crud->addButtonFromView('line', 'Approve', 'approve_comment', 'beginning');

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

    public function approve(Request $request)
    {
        $ids = [];

        if (!is_array($request->comments)) {
            $ids[] = $request->comments;
        }

        try {
            \DB::beginTransaction();
            foreach ($ids as $id) {
                $comment = Comment::whereId($id)->firstOrFail();
                $comment->approve();
            }


            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollBack();
        }

    }
}
