<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function termsAndConditions(){
        $page = Page::find(1);
        return view('frontend.page', compact('page'));
    }

    public function privacyPolicy(){
        $page = Page::find(2);
        return view('frontend.page', compact('page'));
    }

    public function returnAndRefundPolicy(){
        $page = Page::find(3);
        return view('frontend.page', compact('page'));
    }

    public function shippingAndDelivery(){
        $page = Page::find(4);
        return view('frontend.page', compact('page'));
    }

    public function aboutUs(){
        $page = Page::find(5);
        return view('frontend.page', compact('page'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $page->meta_title = $request->meta_title;
        $page->meta_description = $request->meta_description;
        $page->meta_tags = $request->meta_tags;
        $page->content = $request->content;
        $page->save();

        return redirect()->back()->with('success', 'Page updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        //
    }
}
