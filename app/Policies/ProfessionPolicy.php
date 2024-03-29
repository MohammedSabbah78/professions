<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Profession;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfessionPolicy
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
        return $user->hasPermissionTo('Read-Professions')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Profession $profession)
    {
        return $user->hasPermissionTo('Read-Professions')
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
        return $user->hasPermissionTo('Create-Profession')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Profession $profession)
    {
        return $user->hasPermissionTo('Update-Profession')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Profession $profession)
    {
        return $user->hasPermissionTo('Delete-Profession')
            ? $this->allow()
            : $this->deny('Don\'t have Permission ', 403);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Profession $profession)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Profession $profession)
    {
        //
    }
}
