<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SearchActivities extends Component
{
    public $searchActivityName = '';
    public $searchTag1 = '';
    public $searchTag2 = '';

    public function render()
    {
        $activities = Activity::where('created_by_id', Auth::user()->id)
            ->whereRaw("LOWER(name) LIKE '%' || LOWER('" . $this->searchActivityName . "') || '%'")
            ->when($this->searchTag1, function ($query) {
                return $query->whereHas('tags', function ($subQuery) {
                    $subQuery->whereRaw("LOWER(name) LIKE '%' || LOWER('" . $this->searchTag1 . "') || '%'");
                });
            })
            ->when($this->searchTag2, function ($query) {
                return $query->whereHas('tags', function ($subQuery) {
                    $subQuery->whereRaw("LOWER(name) LIKE '%' || LOWER('" . $this->searchTag2 . "') || '%'");
                });
            })
            ->orderBy('startedAt', 'desc')
            ->paginate(15);

     //   $activities = Activity::where('created_by_id', Auth::user()->id)->orderBy('startedAt', 'desc')->paginate(5);

        $activities->each(function ($activity) {
            $startedAt = new Carbon($activity['startedAt']);
            $activity['date'] = $startedAt->format('d-M-Y');
        });

        $tags = Auth::user()->tags;

        return view('livewire.search-activities', [
            'activities' => $activities,
            'tags' => $tags
        ]);
    }
}
