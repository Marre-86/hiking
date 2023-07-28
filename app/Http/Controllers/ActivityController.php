<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use phpGPX\phpGPX;
use Carbon\Carbon;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user() === null) {
            abort(403);
        }

        return view('activity.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Auth::user()->tags;
        return view('activity.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     //   dd($request->all());
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
            'name' => 'nullable|max:60',
            'sport' => 'numeric',
            'sportType' => 'numeric|nullable',
            'filename' => 'ends_with:.gpx,.GPX',
            'track_file' => 'nullable|mimetypes:application/gpx+xml,text/xml,text/plain',
            'description' => 'nullable|max:800',
            'tags.*' => 'nullable'
        ], $customMessages);

        if ($validator->fails()) {
            return redirect(route('activities.create'))
                    ->withErrors($validator)
                    ->withInput();
        }

        $validatedData = $validator->validated();

        $activity = new Activity();

        $activity->fill($validatedData);

        if ($request->has('track_file')) {
            $fileName =  str_pad(Auth::id(), 3, '0', STR_PAD_LEFT) . '-' . Auth::user()->name . '/' . now()->format('Y.m.d-H.i.s') . '.gpx';   // phpcs:ignore
            $request->track_file->storeAs('track_files/', $fileName, 'public');
            $activity->track_file = $fileName;

            $gpx = new phpGPX();
            $file = $gpx->load($request->track_file);
            if ($file->tracks) {
                $stats = $file->tracks[0]->stats->toArray();
                $statsFormatted = formatStats($stats);
                $activity->fill($statsFormatted);
            }
        }

        $activity->name = ($validatedData['name'] !== null) ? $validatedData['name'] : getDefaultName($statsFormatted['startedAt']);   // phpcs:ignore
        $activity->sport_id = $validatedData['sport'];
        if (array_key_exists('sportType', $validatedData)) {
            $activity->sport_type_id = $validatedData['sportType'];
        }

        $activity->created_by_id = intval(Auth::id());

        $activity->save();

        if (array_key_exists('tags', $validatedData)) {
            $tagIds = [];
            foreach ($validatedData['tags'] as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
            $activity->tags()->attach($tagIds);

            $existingTagIds = Auth::user()->tags()->pluck('id')->toArray();
            $tagsToAttach = Tag::whereIn('id', $tagIds)->whereNotIn('id', $existingTagIds)->get();
            Auth::user()->tags()->attach($tagsToAttach);
        }

        flash('The acivity has been added')->success();

        return redirect()->route('activities.show', ['activity' => $activity]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        $activity = Activity::findOrFail($activity->id);
        $startedAt = new Carbon($activity['startedAt']);
        $date = $startedAt->format('d-M-Y');
        $startTime = $startedAt->format('H:i');

        return view('activity.show', ['activity' => $activity, 'date' => $date, 'startTime' => $startTime]);
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
