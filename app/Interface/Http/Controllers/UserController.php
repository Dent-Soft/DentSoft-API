<?php

namespace App\Interface\Http\Controllers;

use App\Application\Commands\CreateUserCommand;
use App\Application\DTOs\User\CreateUserDTO;
use App\Interface\Http\Requests\CreateUserRequest;
use App\Shared\Utils\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Bus\Dispatcher;
use Illuminate\Validation\ValidationException;

class UserController
{
    public function __construct(private readonly Dispatcher $bus)
    {
    }


    public function store(CreateUserRequest $request)
    {
        try {
            $userDTO = CreateUserDTO::fromValidatedRequest($request->validated());
            $command = new CreateUserCommand($userDTO);
            $user = $this->bus->dispatchSync($command);

            return ApiResponse::success($user);
        } catch (ValidationException $th) {
            return ApiResponse::validationError($th);
        } catch (\Exception $th) {
            return ApiResponse::error($th);
        }
    }
}
