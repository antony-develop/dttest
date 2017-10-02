<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use function PHPSTORM_META\elementType;

use App\OldCategoryName;

class Category extends Model
{
    protected $fillable = ['id', 'parent_id', 'title', 'link', 'position'];

    public $incrementing = false;

    public static function getByLink($link)
    {
        return Category::where('link', $link)->first();
    }

    public function getTree()
    {
        $tree = array();
        $tree[] = $this;
        $category = $this;
        while ($parent = Category::find($category->parent_id)) {
            $tree[] = $parent;
            $category = $parent;
        }

        rsort($tree);
        return $tree;
    }

    public static function getCategories($parent = '')
    {
        $parentId = ($parent) ? $parent->id : '';
        $categories = array();
        $rows = Category::where('parent_id', $parentId)->orderBy('position')->get();

        if(count($rows)){
            foreach ($rows as $row) {
                $categories[$row->id]['category'] = $row;
                $categories[$row->id]['children'] = Category::getCategories($row);
            }
            return $categories;
        } else {
            return $categories;
        }
    }

    public static function parse($file)
    {
        $json = file_get_contents($file);
        $categries = json_decode($json);
        if ( is_array($categries) ) {
            foreach ($categries as $category) {
                Category::traverseCategories($category);
            }
        }
    }

    protected static function traverseCategories($category, $parentCategory = '', $parentLink = '')
    {
        if (Category::isValidId($category->id)) {
            if (isset($category->children) && count($category->children)) {
                $categoryLink = $parentLink.'/'.\Slug::make($category->title);
                foreach ($category->children as $subCatogory) {
                    Category::traverseCategories($subCatogory, $category, $categoryLink);
                }
            }
            Category::popolateCategory($category, $parentCategory, $parentLink);
		}
    }

    protected static function isValidId($id)
    {
        if (strlen($id) == 9 && preg_match("/^[A-Z]+$/", $id[0]) && is_numeric( substr($id, 1))) {
            return true;
        } else {
            return false;
        }
    }

    protected static function popolateCategory($category, $parentCategory, $parentLink)
    {
        $record = Category::find($category->id);
        $parentId = ($parentCategory) ? $parentCategory->id : '';
        $newLink = $parentLink.'/'.\Slug::make($category->title);

        if ($record) {
            if ($record->link != $newLink) {
                OldCategoryLink::create([
                    'link' => $record->link,
                    'category_id' => $record->id,
                ]);

                $record->title = $category->title;
                $record->link = $newLink;

                $record->save();
            }
        } else {
            Category::create([
                'id' => $category->id,
                'parent_id' => $parentId,
                'title' => $category->title,
                'link' => $newLink,
                'position' => substr($category->id, 1)
            ]);
        }
    }
}
