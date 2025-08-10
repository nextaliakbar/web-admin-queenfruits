<?php

namespace App\Livewire\Admin\BusinessSetting;

use App\Models\TimeSchedule;
use Livewire\Component;

class StoreTimeScheduleLivewire extends Component
{
    public $day, $openingTime, $closingTime;
    public function render()
    {
        $schedules = [
            ['id' => 1, 'day' => 'Minggu', 'data' => TimeSchedule::where('day', '=', 1)->first()],
            ['id' => 2, 'day' => 'Senin', 'data' => TimeSchedule::where('day', '=', 2)->first()],
            ['id' => 3, 'day' => 'Selasa', 'data' => TimeSchedule::where('day', '=', 3)->first()],
            ['id' => 4, 'day' => 'Rabu', 'data' => TimeSchedule::where('day', '=', 4)->first()],
            ['id' => 5, 'day' => 'Kamis', 'data' => TimeSchedule::where('day', '=', 5)->first()],
            ['id' => 6, 'day' => 'Jumat', 'data' => TimeSchedule::where('day', '=', 6)->first()],
            ['id' => 7, 'day' => 'Sabtu', 'data' => TimeSchedule::where('day', '=', 7)->first()],
        ];

        return view('livewire.admin.business-setting.store-time-schedule', compact('schedules'));
    }

    public function edit($day)
    {
        $this->day = $day;
        $this->reset(['openingTime', 'closingTime']);
    }

    public function update()
    {
        $day = null;

        switch($this->day) {
            case 'Minggu' : $day = 1; break;
            case 'Senin' : $day = 2; break;
            case 'Selasa' : $day = 3; break;
            case 'Rabu' : $day = 4; break;
            case 'Kamis' : $day = 5; break;
            case 'Jumat' : $day = 6; break;
            case 'Sabtu' : $day = 7; break;
        }

        $update = TimeSchedule::updateOrCreate([
            'day' => $day
        ], [
            'day' => $day,
            'opening_time' => $this->openingTime,
            'closing_time' => $this->closingTime
        ]);

        if($update) {
            $this->dispatch('toastUpdate', success: true, message: 'Waktu operasional berhasil diperbarui');
        } else {
            $this->dispatch('toastUpdate', success: false, message: 'Waktu operasional gagal diperbarui');
        }
    }

    public function destroy($day)
    {
        $delete = TimeSchedule::where('day', '=', $day)->delete();

        if($delete) {
            $this->dispatch('toastUpdate', success: true, message: 'Waktu operasional berhasil diperbarui');
        } else {
            $this->dispatch('toastUpdate', success: false, message: 'Waktu operasional gagal diperbarui');
        }
    }
}
