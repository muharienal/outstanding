<?php

namespace Modules\UserManagement\app\Repositories;

use Illuminate\Http\Request;
use Modules\UserManagement\app\Models\Validation;

class ValidationRepository
{
    public function hasValidate(): bool
    {
        return auth()->user()->isValidated() || Validation::firstWhere('user_id', auth()->id()) ? true : false;
    }

    public function getAll(int $paginate = 10)
    {
        return Validation::query()
            ->with('user')
            ->latest()
            ->paginate($paginate);
    }

    public function store(Request $request)
    {
        $request->validated();

        // selfie store
        $user_selfie = $request->file('user_selfie');
        $user_selfie_name = str()->uuid()->toString().'.'.$user_selfie->extension();
        $user_selfie->move(
            public_path('assets/files'),
            $user_selfie_name
        );

        // card id store
        $user_card_id = $request->file('user_card_id');
        $user_card_id_name = str()->uuid()->toString().'.'.$user_card_id->extension();
        $user_card_id->move(
            public_path('assets/files'),
            $user_card_id_name
        );

        return Validation::create([
            'img_self' => $user_selfie_name,
            'img_card' => $user_card_id_name,
            'user_id' => auth()->id(),
        ]) ?? false;
    }
}
