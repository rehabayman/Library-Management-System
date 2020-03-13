<?php

namespace App\Policies;

use App\User;
use App\UserCommentedonBooks;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any user commentedon books.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the user commentedon books.
     *
     * @param  \App\User  $user
     * @param  \App\UserCommentedonBooks  $userCommentedonBooks
     * @return mixed
     */
    public function view(User $user, UserCommentedonBooks $userCommentedonBooks)
    {
        //
    }

    /**
     * Determine whether the user can create user commentedon books.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // return Auth::id() == $user->id;
    }

    /**
     * Determine whether the user can update the user commentedon books.
     *
     * @param  \App\User  $user
     * @param  \App\UserCommentedonBooks  $userCommentedonBooks
     * @return mixed
     */
    public function update(User $user, UserCommentedonBooks $userCommentedonBooks)
    {
        //
    }

    /**
     * Determine whether the user can delete the user commentedon books.
     *
     * @param  \App\User  $user
     * @param  \App\UserCommentedonBooks  $userCommentedonBooks
     * @return mixed
     */
    public function delete(User $user, UserCommentedonBooks $userCommentedonBooks)
    {
        return $user->id == $userCommentedonBooks->user_id;

    }

    /**
     * Determine whether the user can restore the user commentedon books.
     *
     * @param  \App\User  $user
     * @param  \App\UserCommentedonBooks  $userCommentedonBooks
     * @return mixed
     */
    public function restore(User $user, UserCommentedonBooks $userCommentedonBooks)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the user commentedon books.
     *
     * @param  \App\User  $user
     * @param  \App\UserCommentedonBooks  $userCommentedonBooks
     * @return mixed
     */
    public function forceDelete(User $user, UserCommentedonBooks $userCommentedonBooks)
    {
        //
    }
}
