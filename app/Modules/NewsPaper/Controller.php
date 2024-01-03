<?php

namespace App\Modules\NewsPaper;

use App\Modules\NewsPaper\Actions\All;
use App\Modules\NewsPaper\Actions\Delete;
use App\Modules\NewsPaper\Actions\Show;
use App\Modules\NewsPaper\Actions\Store;
use App\Modules\NewsPaper\Actions\Update;
use App\Modules\NewsPaper\Actions\Validation;
use App\Modules\NewsPaper\Actions\BulkActions;
use App\Http\Controllers\Controller as ControllersController;


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
        $data = BulkActions::execute();
        return $data;
    }

}