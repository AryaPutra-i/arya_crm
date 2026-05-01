<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Leads;
use Illuminate\Auth\Access\Response;

class LeadsPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Leads $leads): bool
    {
        // Manager can view all leads
        if ($user->role === 'manager') {
            return true;
        }

        // Sales person can only view their own leads
        return $user->id === $leads->sales_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === 'sales' || $user->role === 'manager';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Leads $leads): bool
    {
        // Manager can update all leads
        if ($user->role === 'manager') {
            return true;
        }

        // Sales person can only update their own leads
        return $user->id === $leads->sales_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Leads $leads): bool
    {
        // Manager can delete all leads
        if ($user->role === 'manager') {
            return true;
        }

        // Sales person can only delete their own leads
        return $user->id === $leads->sales_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Leads $leads): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Leads $leads): bool
    {
        return $user->role === 'manager';
    }
}
