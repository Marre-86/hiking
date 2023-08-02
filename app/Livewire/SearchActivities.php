<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Activity;
use App\Models\Sport;
use App\Models\SportType;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Livewire\WithPagination;

class SearchActivities extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchActivityName = '';
    public $searchSport = '';
    public $searchSportType = '';
    public $searchTag1 = '';
    public $searchTag2 = '';

    // Without this it will show nothing after changing Sport in case Type of previous Sport was selected
    public function updating($name, $value)
    {
        if ($name === 'searchSport') {
            $this->searchSportType = '';
        }
    }

    public function render()
    {
        $activities = Activity::where('created_by_id', Auth::user()->id)
            ->whereRaw("LOWER(name) LIKE '%' || LOWER('" . $this->searchActivityName . "') || '%'")
            ->when($this->searchSport, function ($query) {
                return $query->where('sport_id', $this->searchSport);
            })
            ->when($this->searchSportType, function ($query) {
                return $query->where('sport_type_id', $this->searchSportType);
            })
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

        $activities->each(function ($activity) {
            $activity['date'] = getActivityDate($activity['startedAt']);
            $activity['avgPace'] = setAvgPaceAccordingToSport($activity['duration'], $activity['sport_id'], $activity['distance']);    // phpcs:ignore 
            $activity['duration'] = formatDuration($activity['duration']);
        });

        $tags = Auth::user()->tags;
        $sports = Sport::all();
        $sportTypes = $this->searchSport ? SportType::where('sport_id', $this->searchSport)->get() : [];

        return view('livewire.search-activities', [
            'activities' => $activities,
            'sports' => $sports,
            'sportTypes' => $sportTypes,
            'tags' => $tags
        ]);
    }
}
