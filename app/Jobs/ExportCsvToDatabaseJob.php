<?php

namespace App\Jobs;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;

class ExportCsvToDatabaseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public string $file)
    {
        //
    }

    public function handle(): void
    {
        DB::disableQueryLog();

        LazyCollection::make(function () {
            $handle = fopen(public_path('storage/uploads/' . $this->file), 'r');

            while (($line = fgetcsv($handle, 4096)) !== false) {
                yield $line;
            }

            fclose($handle);
        })
        ->skip(1)
        ->chunk(1000)
        ->each(function (LazyCollection $chunk) {
            $now = now();
            $records = $chunk->map(function ($row) use ($now) {
                return [
                    'unique_id'       => $row[0],
                    'name_prefix'     => $row[1],
                    'first_name'      => $row[2],
                    'middle_initial'  => $row[3],
                    'last_name'       => $row[4],
                    'gender'          => $row[5],
                    'email'           => $row[6],
                    'date_of_birth'   => strtotime($row[7]) ? Carbon::parse($row[7])->format('Y-m-d') : null,
                    'time_of_birth'   => $row[8],
                    'age'             => $row[9],
                    'date_of_joining' => Carbon::parse($row[10])->format('Y-m-d'),
                    'age_in_company'  => floatval($row[11]),
                    'phone'           => $row[12],
                    'place_name'      => $row[13],
                    'county'          => $row[14],
                    'city'            => $row[15],
                    'zip'             => $row[16],
                    'region'          => $row[17],
                    'username'        => $row[18],
                    'created_at'      => $now,
                    'updated_at'      => $now
                ];
            })
            ->toArray();

            DB::table('employees')->insert($records);
        });
    }
}
