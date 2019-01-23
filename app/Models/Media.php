<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media as MediaModel;
use Spiritix\LadaCache\Database\LadaCacheTrait;

class Media extends MediaModel
{
    use LadaCacheTrait;
}
