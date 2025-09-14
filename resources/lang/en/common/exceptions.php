<?php

return [
    'category' => [
        'CannotDeleteCategoryWithPostsException' => 'Cannot delete a category until you have no messages.',
        'CannotDeleteLastCategoryException' => 'Deleting the last category is prohibited.',
    ],
    'role' => [
        'CannotDeleteProtectedRoleException' => 'Deleting system roles is prohibited.',
        'CannotUpdateProtectedRoleException' => 'Editing system roles is prohibited.',
    ],
    'user' => [
        'CannotDeactivateLastActiveUserException' => 'It is not possible to deactivate the last active user.',
        'CannotDeleteAdminUserException' => 'Deleting a user from this account is prohibited.',
        'CannotDeleteSelfException' => 'Deleting yourself is prohibited.',
        'EmailNotVerifiedException' => 'Email address is not verified.',
    ],

];
