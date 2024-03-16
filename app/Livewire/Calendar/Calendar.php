<?php

namespace App\Livewire\Calendar;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Calendar extends Component
{
    public $year;
    public $month;
    public $monthName;

    public $prevMonth;
    public $prevMonthName;
    public $endOfPrevMonth;

    public $nextMonth;
    public $nextMonthName;

    public $firstDay;
    public $lastDate;
    public $selectedDate;

    public function mount()
    {
        $carbon = new Carbon();
        $this->year = $carbon->now()->year;
        $this->month = $carbon->now()->month;
        $this->monthName = $carbon->create($this->year, $this->month)->monthName;

        $this->prevMonth = $carbon->create($this->year, $this->month - 1, 1)->month;
        $this->prevMonthName = $carbon->create($this->year, $this->prevMonth)->monthName;
        $this->endOfPrevMonth = $carbon->create($this->year, $this->prevMonth)->lastOfMonth()->day;

        $this->nextMonth = $carbon->create($this->year, $this->month + 1, 1)->month;
        $this->nextMonthName = $carbon->create($this->year, $this->nextMonth)->monthName;

        $this->firstDay = $carbon->create($this->year, $this->month)->dayOfWeek;
        $this->lastDate = $carbon->create($this->year, $this->month)->lastOfMonth()->day;
        $this->selectedDate = date_format($carbon->now(), 'F j, Y');
    }

    public function navigateMonth($month, $year)
    {
        $carbon = new Carbon();
        $this->year = $year;
        $this->month = $month;
        $this->monthName = $carbon->create($this->year, $this->month)->monthName;

        $this->prevMonth = $carbon->create($this->year, $this->month - 1, 1)->month;
        $this->prevMonthName = $carbon->create($this->year, $this->prevMonth)->monthName;
        $this->endOfPrevMonth = $carbon->create($this->year, $this->prevMonth)->lastOfMonth()->day;

        $this->nextMonth = $carbon->create($this->year, $this->month + 1, 1)->month;
        $this->nextMonthName = $carbon->create($this->year, $this->nextMonth)->monthName;

        $this->firstDay = $carbon->create($this->year, $this->month)->dayOfWeek;
        $this->lastDate = $carbon->create($this->year, $this->month)->lastOfMonth()->day;
    }

    public function today()
    {
        $carbon = new Carbon();
        $this->year = $carbon->now()->year;
        $this->month = $carbon->now()->month;
        $this->monthName = $carbon->create($this->year, $this->month)->monthName;

        $this->prevMonth = $carbon->create($this->year, $this->month - 1, 1)->month;
        $this->prevMonthName = $carbon->create($this->year, $this->prevMonth)->monthName;
        $this->endOfPrevMonth = $carbon->create($this->year, $this->prevMonth)->lastOfMonth()->day;

        $this->nextMonth = $carbon->create($this->year, $this->month + 1, 1)->month;
        $this->nextMonthName = $carbon->create($this->year, $this->nextMonth)->monthName;

        $this->firstDay = $carbon->create($this->year, $this->month)->dayOfWeek;
        $this->lastDate = $carbon->create($this->year, $this->month)->lastOfMonth()->day;
    }

    public function showDate($date)
    {
        $this->selectedDate = date('F j, Y', strtotime($date));
    }

    public function render()
    {
        $records = DB::table('records')
            ->join('patients', 'records.patient_id', '=', 'patients.id')
            ->select('*', 'records.id AS rid')
            ->where('status', 'scheduled')
            ->where('records.deleted_at', null)
            ->orderBy('schedule_time')
            ->get();

        $days = [];

        /* 
            Fill the leading gaps at the start of the calendar
        */
        if ($this->firstDay !== 7) {
            for ($day = $this->firstDay; $day >= 1; $day--) {
                $date = Carbon::createFromDate($this->year, $this->prevMonth, $this->endOfPrevMonth - $day + 1);

                $days[] = [
                    'id' => count($days) + 1,
                    'day' => $date->format('j'),
                    'date' => $date->format('Y-m-j'),
                ];
            }
        }

        /* 
            Populate the regular days of the current month
        */

        for ($day = 1; $day <= $this->lastDate; $day++) {
            $date = Carbon::createFromDate($this->year, $this->month, $day);

            $days[] = [
                'id' => count($days) + 1,
                'day' => $date->format('j'),
                'date' => $date->format('Y-m-j'),
            ];
        }

        /* 
            Fill the trailing gaps at the end of the calendar
        */
        if (count($days) < 42) {
            for ($day = 1; count($days) < 42; $day++) {
                $date = Carbon::createFromDate($this->year, $this->nextMonth, $day);

                $days[] = [
                    'id' => count($days) + 1,
                    'day' => $date->format('j'),
                    'date' => $date->format('Y-m-j'),
                ];
            }
        }

        return view('livewire.calendar.calendar', [
            'days' => $days,
            'records' => $records,
        ]);
    }
}
