<?php

namespace App\Observers;

use App;

class ModelObserver
{
    public function saving($model)
    {
        $model->lastChangedBy = auth()->user()->id ?? 3;
    }
}