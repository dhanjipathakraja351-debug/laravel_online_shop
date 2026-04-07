<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;

class PageController extends Controller
{
    // LIST
    public function index()
    {
        $pages = Page::latest()->get();
        return view('admin.pages.list', compact('pages'));
    }

    // CREATE
    public function create()
    {
        return view('admin.pages.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Page::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name), // ✅ AUTO SLUG
            'content' => $request->content,
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page created successfully');
    }

    // EDIT
    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $page->name = $request->name;
        $page->slug = Str::slug($request->name); // ✅ AUTO UPDATE SLUG
        $page->content = $request->content;

        $page->save();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page updated successfully');
    }

    // DELETE
    public function delete($id)
    {
        Page::findOrFail($id)->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page deleted successfully');
    }
}