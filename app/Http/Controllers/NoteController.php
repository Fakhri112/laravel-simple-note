<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function create(Request $request)
    {
        $reqData = $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $reqData['title'] = strip_tags($reqData['title']);
        $reqData['content'] = strip_tags($reqData['content']);
        $reqData['user_id'] = auth()->id();
        Note::create($reqData);
        return redirect('/');
    }

    public function update(Request $request)
    {
        $reqData = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'id' => 'required'
        ]);

        $selectedData = Note::find(strip_tags($reqData['id']));
        $selectedData->title = strip_tags($reqData['title']);
        $selectedData->content = strip_tags($reqData['content']);
        $selectedData->save();

        return redirect('/');
    }

    public function delete(Request $request)
    {
        $selectedData = Note::find(strip_tags($request->id));
        $selectedData->delete();

        return redirect('/');
    }
}
