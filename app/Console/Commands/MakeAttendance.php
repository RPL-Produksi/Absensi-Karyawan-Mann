<?php

namespace App\Console\Commands;

use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MakeAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-attendance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membuat Presensi baru setiap hari';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Tanggal hari ini
        $today = Carbon::today();

        // Menggunakan chunk untuk memproses user dalam batch kecil
        User::chunk(100, function ($users) use ($today) {
            foreach ($users as $user) {
                // Hanya proses user yang memiliki role "user"
                if ($user->role === 'user') {
                    // Periksa apakah sudah ada attendance untuk hari ini
                    $existingAttendance = Attendance::where('user_id', $user->id)
                                                    ->whereDate('created_at', $today)
                                                    ->first();

                    // Jika belum ada, buat attendance baru
                    if (!$existingAttendance) {
                        Attendance::create([
                            'user_id' => $user->id,
                            'date' => $today,
                            // Kamu bisa tambahkan field lainnya di sini
                        ]);
                    }
                }
            }
        });
    }
}
