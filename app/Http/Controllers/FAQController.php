<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function adminIndex(){
        return view('admin.pages.faq');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create-faq');
    }

    public function get(Request $request){
        $columns = ['id', 'question'];

        $query = FAQ::query();

        if ($request->has('search') && $request->search['value']) {
            $search = $request->search['value'];
            $query->where('question', 'like', "%{$search}%");
        }

        $totalRecords = $query->count();
        $filteredRecords = $query->count();

        if ($request->has('order')) {
            $orderColumn = $columns[$request->order[0]['column']];
            $orderDirection = $request->order[0]['dir'];
            $query->orderBy($orderColumn, $orderDirection);
        }

        $data = $query->skip($request->start)->take($request->length)->get();

        return response()->json([
            "draw" => intval($request->draw),
            "recordsTotal" => $totalRecords,
            "recordsFiltered" => $filteredRecords,
            "data" => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255|unique:faqs',
            'answer' => 'required|string'
        ]);

        FAQ::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'active' => $request->active ?? 0,
        ]);

        return redirect()->route('admin.faq')->with('success', 'FAQ added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(FAQ $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FAQ $faq)
    {
        return view('admin.pages.edit-faq', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FAQ $faq)
    {
        $request->validate([
            'question' => [
                'required',
                'string',
                'max:100',
                Rule::unique('faqs')->ignore($faq->id),
            ],
            'answer' => 'required|string'
        ]);

        $faq->update([
            'question' => $request->question,
            'answer' => $request->answer,
            'active' => $request->active ?? 0,
        ]);

        return redirect()->route('admin.faq')->with('success', 'FAQ updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FAQ $faq)
    {
        $faq->delete();

        return response()->json([
            'success' => true,
            'message' => 'FAQ deleted successfully.'
        ]);
    }
}
