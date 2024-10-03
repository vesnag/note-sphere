<?php

/**
 * @file
 */

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('note-sphere-broadcasting.{noteId}', function ($user, $noteId) {
    // @todo Add any authorization logic here.
    // Replace with logic that checks if the user is authorized to view this note.
    return TRUE;
});

Broadcast::channel('note-sphere-broadcasting', function () {
    // @todo Add any authorization logic here.
    // Replace with logic that checks if the user is authorized to view this note.
    return TRUE;
});
