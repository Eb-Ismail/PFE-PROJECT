<?php

namespace App\Policies;

use App\Models\User;
use App\Models\publication;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\GenericUser;

class PublicationPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // viewAny :page display tous element:list publication
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, publication $publication): bool
    {
        // view : page profiles/1
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $profile, publication $publication): bool
    {
        return $profile->id === $publication->profile_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, publication $publication): bool
    {
        return $user->id === $publication->profile_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, publication $publication): bool
    {
        // restore softDelete : restore delete_at
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, publication $publication): bool
    {
        // forceDelete : delete all  data in table and not only set delete_at
    }

    // this function before @can and les action  : test  if user is admin or not 
    // public function before(User $user,string $ability){
    //     return $user->isAdministrator();
    // }
}
