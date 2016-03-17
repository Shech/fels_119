<?php
namespace App\Repositories\Eloquents;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;

class CategoryRepository extends Repository implements CategoryRepositoryInterface
{
    public function createOrUpdateCategory($request, $category = null)
    {
        if (!empty($request->file('image_category'))) {
            $imageData = $request->file('image_category');
            $path = public_path('pictures/category');
            $imageName = time() . "." . $imageData->getClientOriginalExtension();
            $upload = $imageData->move($path, $imageName);
        } else {
            $imageName = null;
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imageName,
        ];

        if (!empty($category)) {
            $category->update($data);
        } else {
            Category::create($data);
        }
    }
}
