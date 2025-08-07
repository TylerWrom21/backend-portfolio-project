<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
  use HasFactory;
  
  public function setDescriptionAttribute($value)
  {
      $cleaned = str_replace('&nbsp;', ' ', $value);
      $cleaned = preg_replace('/^<p>(.*?)<\/p>$/', '$1', $cleaned);

      $this->attributes['description'] = $cleaned;
  }
  public function getDescriptionParagraphsAttribute()
  {
      return collect(explode('</p>', $this->description))
          ->map(function ($paragraph) {
              return trim(strip_tags($paragraph));
          })
          ->filter();
  }
  protected $fillable = [
  'title',
  'slug',
  'content',
  'description',
  'thumbnail',
];
}
