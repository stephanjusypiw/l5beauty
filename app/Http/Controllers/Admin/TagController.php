<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagCreateRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagController extends Controller
{

    protected $fields = [
        'tag' => '',
        'title' => '',
        'subtitle' => '',
        'meta_description' => '',
        'page_image' => '',
        'layout' => 'blog.layouts.index',
        'reverse_direction' => 0,
    ];


    /**
     * Display a listing of the tags.
     */
    public function index()
    {
        // get all the tags
        $tags = Tag::all();

        return view('admin.tag.index')
            ->withTags($tags);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    /**
     * Show form for creating new tag
     */
    public function create()
    {
        $data = [];
        foreach ($this->fields as $field => $default) {

            /*
             * If there is an error we want to pass any data that was previously
             * input back to the form.
             * Otherwise, any default value for a field will be assigned.
             * This is accomplished with the old() function.
             */
            $data[$field] = old($field, $default);
        }

        return view('admin.tag.create', $data);
    }

    /**
     * Store the newly created tag in the database.
     *
     * @param TagCreateRequest $request
     * @return Response
     */
    public function store(TagCreateRequest $request)
    {
        $tag = new Tag();
        foreach (array_keys($this->fields) as $field) {
            $tag->$field = $request->get($field);
        }
        $tag->save();

        return redirect('/admin/tag')
            ->withSuccess("The tag '$tag->tag' was created.");
    }


    /**
     * Show the form for editing a tag
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        $data = ['id' => $id];
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $tag->$field);
        }

        return view('admin.tag.edit', $data);
    }

    /**
     * Update the tag in storage
     *
     * @param TagUpdateRequest $request
     * @param int  $id
     * @return Response
     */
    public function update(TagUpdateRequest $request, $id)
    {
        $tag = Tag::findOrFail($id);

        foreach (array_keys(array_except($this->fields, ['tag'])) as $field) {
            $tag->$field = $request->get($field);
        }
        $tag->save();

        return redirect("/admin/tag/$id/edit")
            ->withSuccess("Changes saved.");
    }

    /**
     * Delete the tag
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect('/admin/tag')
            ->withSuccess("The '$tag->tag' tag has been deleted.");
    }
}
