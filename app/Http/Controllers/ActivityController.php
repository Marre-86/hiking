<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
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
        $allInput = $request->all();

        if ($request->has('track_file')) {
            $filename = $request->file('track_file')->getClientOriginalName();
            $allInput['filename'] = $filename;
        }

        $customMessages = [
            'filename.ends_with' => __('The file must have an extension: gpx.'),
            'track_file.mimetypes' => __('The content of the file doesn\'t correspond to the type : gpx.'),
        ];
        $validator = Validator::make($allInput, [
            'filename' => 'ends_with:.gpx,.GPX',
            'track_file' => 'nullable|mimetypes:application/gpx+xml,text/xml,text/plain',
        ], $customMessages);

        if ($validator->fails()) {
            return redirect(route('secondPage'))
                    ->withErrors($validator)
                    ->withInput();
        }

        $data = $validator->validated();

        $activity = new Activity();

        $activity->fill($data);

        if ($request->has('track_file')) {
            $fileName =  Auth::id() . '-' . Auth::user()->name . '/' . now()->format('Y.m.d-H.i.s') . '.gpx';
            $request->track_file->storeAs('track_files/', $fileName, 'public');
            $activity->track_file = $fileName;
        }

        $activity->save();

        flash('The acivity has been added')->success();
        //return redirect()->route('welcome');
        return redirect()->route('activities.show', ['activity' => $activity]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        $activity = Activity::findOrFail($activity->id);
        return view('activity.show', ['activity' => $activity]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
