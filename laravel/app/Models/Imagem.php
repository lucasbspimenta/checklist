<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Auth;

class Imagem extends Model
{
    use HasFactory;

    protected $table = 'imagem';

    protected $fillable = [
		'name'
        , 'imagem'
        , 'width'
        , 'height'
        , 'size'
	];

  public function imageable()
  {
      return $this->morphTo(__FUNCTION__, 'imageable_type', 'imageable_id');
  }
}
