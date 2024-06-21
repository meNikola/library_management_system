<?php

namespace App\Permissions\V1;

use App\Models\User;

final class Abilities {
    public const CreateBook = 'book:create';
    public const UpdateBook = 'book:update';
    public const DeleteBook = 'book:delete';

    public const AllMembers   = 'member:index';
    public const ShowMember   = 'member:show';
    public const CreateMember = 'member:create';
    public const UpdateMember = 'member:update';
    public const DeleteMember = 'member:delete';

    public const CreateReservation = 'reservation:create';
    public const AllReservation = 'reservation:index';
    public const ShowReservation = 'reservation:show';

    public const CreateUser = 'user:create';
    public const RegisterUser = 'user:register';
    public const UpdateUser = 'user:update';
    public const DeleteUser = 'user:delete';

    public const ShowAuthor = 'author:show';
    public const CreateAuthor = 'author:create';
    public const UpdateAuthor = 'author:update';
    public const DeleteAuthor = 'author:delete';

    public static function getAbilities(User $user) {
        if ($user->hasRole('admin')) {
            return [
                self::CreateUser,
                self::UpdateUser,
                self::DeleteUser,

                self::ShowAuthor,
                self::CreateAuthor,
                self::UpdateAuthor,
                self::DeleteAuthor,

                self::CreateBook,
                self::UpdateBook,
                self::DeleteBook,

                self::AllMembers,
                self::ShowMember,

                self::AllReservation,
                self::ShowReservation,
            ];
        } else {
            return [
                self::RegisterUser,
                self::CreateReservation,
                self::CreateMember,
            ];
        }
    }
}
