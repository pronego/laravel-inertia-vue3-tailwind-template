<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
	/**
	 * Perform pre-authorization checks.
	 *
	 * @param User   $user The user to be checked.
	 * @param string $ability Not used here.
	 *
	 * @return bool|null TRUE to grant, FALSE to deny or NULL to fall through to the individual policy method.
	 */
	public function before(User $user, string $ability): bool|null
	{
		if ($user->isAdministrator()) {
			return true;
		}

		return null;
	}

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdministrator();
    }

    /**
     * Determine whether the user can update the model.
	 *
	 * @param User $currentUser The authenticated user.
	 * @param User $user        The user we are editing.
	 *
	 * @return bool
	 */
    public function edit(User $currentUser, User $user): bool
    {
        return $currentUser->id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        //
    }
}
