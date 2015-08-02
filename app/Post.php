<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $dates = ['published_at'];


/*
 * This set function sets the title attribute of the Post
 * Note the syntax  set.... then Title  (uppercase T field name .... then Attribute
 *
 * So... set the title attribute to the incoming value
 */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        // if the row has not yet been saved to the database then we
        // convert the title to a slug value and assign the slug.
        if (! $this->exists) {
            $this->attributes['slug'] = str_slug($value);
        }
    }
}
