<?php

namespace App\Application\DTOs;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserDTO
{
    public string $name;
    public string $email;
    public string $password;

    private function __construct(string $name, string $email, string $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = bcrypt($password);
    }

    public static function fromRequest(array $data): self
    {
        $validator = Validator::make($data, [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return new self(
            $data['name'],
            $data['email'],
            $data['password']
        );
    }
}
