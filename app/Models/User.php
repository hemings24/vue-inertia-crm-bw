<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
   use HasFactory,Notifiable;

   /**
   *The attributes that are mass assignable.
   *
   *@var array<int, string>
   */
   protected $fillable=[
      'name',
      'email',
      'password',
      'account_type'
   ];

   /**
   *The attributes that should be hidden for serialization.
   *
   *@var array<int, string>
   */
   protected $hidden=[
      'password',
      'remember_token'
   ];

   /**
   *Get the attributes that should be cast.
   *
   *@return array<string,string>
   */
   protected function casts(): array
   {
      return [
         'email_verified_at' => 'datetime',
         'password' => 'hashed'
      ];
   }

   protected function permissions(): Attribute
   {
      return Attribute::make(
         get: function(){
            return[
               'customers_view'     => in_array($this->account_type,["admin","editor","user"]),
               'customers_edit'     => in_array($this->account_type,["admin","editor"]),
               'customers_admin'    => $this->account_type==="admin",
               'projects_view'      => in_array($this->account_type,["admin","editor","user"]),
               'projects_edit'      => in_array($this->account_type,["admin","editor"]),
               'projects_admin'     => $this->account_type==="admin",
               'emails_view'        => in_array($this->account_type,["admin","editor","user"]),
               'emails_edit'        => in_array($this->account_type,["admin","editor"]),
               'emails_admin'       => $this->account_type==="admin",
               'status_items_view'  => in_array($this->account_type,["admin","editor","user"]),
               'status_items_edit'  => in_array($this->account_type,["admin","editor"]),
               'status_items_admin' => $this->account_type==="admin"
            ];
         }
      );
   }
}