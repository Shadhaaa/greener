<?php
namespace App\Service;

use App\Entity\Post;

class NotificationService
{
    public function sendNewPostNotification(Post $post)
    {
        
        error_log('New post added: ' . $post->getTitre());
    }
}