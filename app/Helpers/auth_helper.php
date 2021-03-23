<?php

use Config\Services;
use eftec\bladeone\BladeOne;

if (! function_exists('send_activation_email'))
{
    /**
     * Builds an account activation HTML email from views and sends it.
     */
    function send_activation_email($to, $activateHash)
    {
        $views = __DIR__ . '/../Views';
        $cache = __DIR__ . '/cache';
        $blade = new BladeOne($views, $cache, BladeOne::MODE_AUTO);

        $htmlMessage = $blade ->run('auth.emails.activation',['hash' => $activateHash]);
//        $htmlMessage .= view('auth\emails\activation.blade', );
//        $htmlMessage .= view('auth\emails\footer.blade');

        $email = \Config\Services::email();
        $email->initialize([
            'mailType' => 'html'
        ]);

        $email->setTo($to);
        $email->setSubject(lang('Auth.registration'));
        $email->setMessage($htmlMessage);

        return $email->send();
    }
}

if (! function_exists('send_confirmation_email'))
{
    /**
     * Builds an email confirmation HTML email from views and sends it.
     */
    function send_confirmation_email($to, $activateHash)
    {
        $htmlMessage = view('auth\emails\header.blade');
        $htmlMessage .= view('auth\emails\confirmation.blade', ['hash' => $activateHash]);
        $htmlMessage .= view('auth\emails\footer.blade');

        $email = \Config\Services::email();
        $email->initialize([
            'mailType' => 'html'
        ]);

        $email->setTo($to);
        $email->setSubject(lang('Auth.confirmEmail'));
        $email->setMessage($htmlMessage);

        return $email->send();
    }
}


if (! function_exists('send_notification_email'))
{
    /**
     * Builds a notification HTML email about email address change from views and sends it.
     */
    function send_notification_email($to)
    {
        $htmlMessage = view('auth\emails\header.blade');
        $htmlMessage .= view('auth\emails\notification.blade');
        $htmlMessage .= view('auth\emails\footer.blade');

        $email = \Config\Services::email();
        $email->initialize([
            'mailType' => 'html'
        ]);

        $email->setTo($to);
        $email->setSubject(lang('Auth.emailUpdateRequest'));
        $email->setMessage($htmlMessage);

        return $email->send();
    }
}


if (! function_exists('send_password_reset_email'))
{
    /**
     * Builds a password reset HTML email from views and sends it.
     */
    function send_password_reset_email($to, $resetHash)
    {
        $htmlMessage = view('auth\emails\header.blade');
        $htmlMessage .= view('auth\emails\reset.blade', ['hash' => $resetHash]);
        $htmlMessage .= view('auth\emails\footer.blade');

        $email = \Config\Services::email();
        $email->initialize([
            'mailType' => 'html'
        ]);

        $email->setTo($to);
        $email->setSubject(lang('Auth.passwordResetRequest'));
        $email->setMessage($htmlMessage);

        return $email->send();
    }
}