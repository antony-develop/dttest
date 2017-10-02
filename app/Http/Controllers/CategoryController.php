<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Category;
use App\OldCategoryLink;

class CategoryController extends Controller
{
    public function index()
    {
        $categoriesArray = Category::getCategories();
        return view('categories.index', compact('categoriesArray'));
    }

    public function show($level0, $level1 = '', $level2 = '')
    {
        $link = '/'.$level0;
        if ($level1) $link .= '/'.$level1;
        if ($level2) $link .= '/'.$level2;

        $category = Category::getByLink($link);
        if (!$category) {
            $category = OldCategoryLink::getCategoryByLink($link);
            if ($category) {
                return Redirect::to('/catalog'.$category->link, 301);
            } else {
                abort(404);
            }
        }

        $tree = $category->getTree();

        $categoriesArray = Category::getCategories($category);

        return view('categories.single', compact('categoriesArray', 'tree'));
    }

    public function parse()
    {
        $file = request('file');
        Category::parse($file);

        return view('categories.parsed');
    }

}
