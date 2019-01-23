<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spiritix\LadaCache\Database\LadaCacheTrait;
use Yarmat\Comment\Models\Comment as CommentModel;

class Comment extends CommentModel
{
    use LadaCacheTrait;
}
