<?php

namespace App\Policies;
use App\Models\User;

class ProjectPolicy
{
   /**
   *Determine whether the user can view any models.
   */
   public function viewAny(User $user): bool
   {
      return $user->permissions['projects_view'];
   }

   /**
   *Determine whether the user can view the model.
   */
   public function view(User $user): bool
   {
      return $user->permissions['projects_view'];
   }

   /**
   *Determine whether the user can create models.
   */
   public function create(User $user): bool
   {
      return $user->permissions['projects_admin'];
   }

   /**
   *Determine whether the user can update the model.
   */
   public function update(User $user): bool
   {
      return $user->permissions['projects_edit'];
   }

   /**
   *Determine whether the user can delete the model.
   */
   public function delete(User $user): bool
   {
      return $user->permissions['projects_admin'];
   }

   /**
   *Determine whether the user can restore the model.
   */
   public function restore(User $user): bool
   {
      return $user->permissions['projects_admin'];
   }

   /**
   *Determine whether the user can permanently delete the model.
   */
   public function forceDelete(User $user): bool
   {
      return $user->permissions['projects_admin'];
   }
}