<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DirectoryEntry;
use Illuminate\Http\Request;

class AdminDirectoryController extends Controller
{
    public function index()
    {   $entries = DirectoryEntry::orderBy('type')->orderBy('district')->get();
        return view('admin.directory.index', compact('entries'));
    }

    public function store(Request $r)
    {
        $data = $r->validate([
            'type'=>'required|in:ngo,police','name'=>'required','phone'=>'required',
            'district'=>'required','address'=>'required','website'=>'nullable','hours'=>'nullable'
        ]);
        DirectoryEntry::create($data);
        return back()->with('success','Entry added');
    }

    public function update(Request $r, DirectoryEntry $entry)
    {
        $data = $r->validate([
            'type'=>'required|in:ngo,police','name'=>'required','phone'=>'required',
            'district'=>'required','address'=>'required','website'=>'nullable','hours'=>'nullable'
        ]);
        $entry->update($data);
        return back()->with('success','Entry updated');
    }

    public function destroy(DirectoryEntry $entry)
    {   $entry->delete(); return back()->with('success','Entry deleted'); }
}