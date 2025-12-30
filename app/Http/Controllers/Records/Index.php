<?php

namespace App\Http\Controllers\Records;

use App\Models\Record;
use Illuminate\Contracts\View\View;

class Index
{
    public function __invoke(): View
    {
        $records = Record::with('artists')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('records.index', [
            'records' => $records,
        ]);
    }
}
