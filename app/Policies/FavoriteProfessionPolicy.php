<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\FavoriteProfession;
use Illuminate\Auth\Access\HandlesAuthorization;

class FavoriteProfessionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($user)
    {
        return $user->hasPermissionTo('Read-FavoriteProfessions')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\FavoriteProfession  $favoriteProfession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, FavoriteProfession $favoriteProfession)
    {
        return $user->hasPermissionTo('Read-FavoriteProfessions')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        return $user->hasPermissionTo('Create-FavoriteProfession')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\FavoriteProfession  $favoriteProfession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, FavoriteProfession $favoriteProfession)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\FavoriteProfession  $favoriteProfession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, FavoriteProfession $favoriteProfession)
    {
        return $user->hasPermissionTo('Delete-FavoriteProfession')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\FavoriteProfession  $favoriteProfession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, FavoriteProfession $favoriteProfession)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\FavoriteProfession  $favoriteProfession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, FavoriteProfession $favoriteProfession)
    {
        //
    }
}
