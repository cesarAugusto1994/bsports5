<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->isUser();
    }

    public function adminPanel(User $user)
    {
        return $user->isAdmin();
    }

    public function mensalidades(User $user)
    {
        return $user->isAdmin();
    }

    public function perfil(User $user)
    {
        return $user->isUser();
    }

    public function players(User $user)
    {
        return $user->isAdmin();
    }

    public function categorias(User $user)
    {
        return $user->isAdmin();
    }

    public function torneios(User $user)
    {
        return $user->isAdmin();
    }

    public function configs(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        //
    }
}
