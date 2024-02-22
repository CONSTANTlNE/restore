<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {

//        dd($input);

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                 Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'id_number'=>'required|numeric|unique:users,ident_no',
            'legal_form'=>'required',
            'company_name'=>'required|string|max:255',
            'tel-1'=>'required|numeric',
            'terms' =>'accepted',
        ])->validate();


        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'ident_no' => $input['id_number'],
            'legal_form' => $input['legal_form'],
            'company_name' => $input['company_name'],
            'mobile1' => $input['tel-1'],
            'terms' => true,
            'password' => Hash::make($input['password']),
        ]);

        $user->save();
        $user->assignRole('customer');

        return $user;
    }
}
