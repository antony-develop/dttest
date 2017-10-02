<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class OldCategoryLink extends Model
{
    protected $fillable = ['category_id', 'link'];

    //
    public static function getCategoryByLink($link)
    {
        $oldLink = OldCategoryLink::where('link', $link)->first();
        return Category::find($oldLink->category_id);
    }
}
