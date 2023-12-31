<?php

namespace App\Modules\BlogManagement\BlogCategory;

use App\Modules\BlogManagement\BlogCategory\Actions\All;
use App\Modules\BlogManagement\BlogCategory\Actions\Delete;
use App\Modules\BlogManagement\BlogCategory\Actions\Show;
use App\Modules\BlogManagement\BlogCategory\Actions\Store;
use App\Modules\BlogManagement\BlogCategory\Actions\Update;
use App\Modules\BlogManagement\BlogCategory\Actions\Validation;
use App\Http\Controllers\Controller as ControllersController;
use App\Modules\BlogManagement\BlogCategory\Actions\BulkAction;

class Controller extends ControllersController
{

    public function index()
    {
        $data = All::execute();
        return $data;
    }

    public function store(Validation $request)
    {
        $data = Store::execute($request);
        return $data;
    }

    public function show($id)
    {
        $data = Show::execute($id);
        return $data;
    }

    public function update(Validation $request, $id)
    {
        $data = Update::execute($request, $id);
        return $data;
    }

    public function destroy($id)
    {
        $data = Delete::execute($id);
        return $data;
    }

    public function bulkAction()
    {
        $data = BulkAction::execute();
        return $data;
    }
}
