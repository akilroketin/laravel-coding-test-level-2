<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\UserContract;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository extends BaseRepository implements UserContract
{
    protected $user;

    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->user = $user;
    }

    public function createUser($attributes)
    {
        return DB::transaction(function () use ($attributes) {
            $attributes['password'] = bcrypt($attributes['password']);

            $data = $this->store($attributes);

            return $data;
		});
    }

    public function updateUser($attributes, $id)
    {
        return DB::transaction(function () use ($attributes, $id) {
            if (isset($attributes['password'])) {
                $attributes['password'] = bcrypt($attributes['password']);
            }

            $this->update($attributes, $id);

            $data = $this->user->find($id);

            return $data;
        });
    }

    public function createOrUpdateUser($attributes, $id)
    {
        $data = $this->user->find($id);
        if ($data !== null) {
            return $this->updateUser($attributes, $id);
        } else {
            return $this->createUser($attributes);
        }
    }

    public function showUser($id)
    {
        return $this->user->find($id);
    }

    public function deleteUser($id)
    {
        $result = $this->delete($id);
        if (!$result) {
            return response([
                'message' => 'Not Found'
            ])
                ->setStatusCode(404);
        }

        return response()->json([
            'message' => "Delete Success"
        ], 200);
    }
}

