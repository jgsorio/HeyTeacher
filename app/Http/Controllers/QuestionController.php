<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Closure;

class QuestionController extends Controller
{
    public function store(): RedirectResponse
    {
        Question::create(request()->validate([
            'question' => [
                'required',
                'min:10',
                function (string $attribute, mixed $value, Closure $fail) {
                    if (trim($value[-1]) !== '?') {
                        $fail("Are you sure that is a question ?");
                    }
                }
            ]
        ]));
        return redirect()->route('dashboard');
    }
}
