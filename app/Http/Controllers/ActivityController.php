<?php

namespace App\Http\Controllers;

use App\Models\Activity;
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
    //    if (Auth::user()->hasRole('Admin')) {
    //        $activities = Activity::orderBy('id', 'desc')->paginate(5);
    //    } else {
            $activities = Activity::where('created_by_id', Auth::user()->id)->orderBy('startedAt', 'desc')->paginate(5);
    //    }
        $activities->each(function ($activity) {
            $startedAt = new Carbon($activity['startedAt']);
            $activity['date'] = $startedAt->format('d-M-Y');
        });

        return view('activity.index', compact('activities'));
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
            'name' => 'nullable|max:60',
            'filename' => 'ends_with:.gpx,.GPX',
            'track_file' => 'nullable|mimetypes:application/gpx+xml,text/xml,text/plain',
            'description' => 'nullable|max:800'
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
            $fileName =  str_pad(Auth::id(), 3, '0', STR_PAD_LEFT) . '-' . Auth::user()->name . '/' . now()->format('Y.m.d-H.i.s') . '.gpx';   // phpcs:ignore
            $request->track_file->storeAs('track_files/', $fileName, 'public');
            $activity->track_file = $fileName;

            $gpx = new phpGPX();
            $file = $gpx->load($request->track_file);
            $stats = $file->tracks[0]->stats->toArray();
            $statsFormatted = formatStats($stats);
            $activity->fill($statsFormatted);
        }

        $activity->name = ($request['name'] !== null) ? $request['name'] : getDefaultName($statsFormatted['startedAt']);

        if (Auth::check()) {
            $activity->created_by_id = intval(Auth::id());
        }

        $activity->save();

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
