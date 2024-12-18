<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;

class EmailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projectname = ucwords(config('app.name'));
        EmailTemplate::firstOrCreate([
            'id' => 1,
        ], [
            'title' => "Reset Password",
            'subject' => "Reset Password",
            'body' => "<p>Hello {user_name},</p>
            <p>You have received this email because we received a password reset request for your account. Please click on the link below to reset your password.</p>
            <p><a href='{password_reset_link}'>Click Here</a></p>
            <p>This password reset link will expire in {expiry_time} minutes.</p>
            <p>If you did not request a password reset, please get in touch with us at info@example.com and we will investigate further.</p> <p>Warm Regards,<br />" . $projectname . " Team</p>",
        ]);

        EmailTemplate::firstOrCreate([
            'id' => 2,
        ], [
            'title' => "Activation Account",
            'subject' => "Activate Your Account",
            'body' => "<p>Dear {user_name}</p><p><a href='{activation_link}'>Click here</a> to activate your account.</p><p>Regards,<br />" . $projectname . " Team</p>",
        ]);

        EmailTemplate::firstOrCreate([
            'id' => 3,
        ], [
            'title' => "Welcome mail",
            'subject' => "Welcome to " . $projectname . "!",
            'body' => "<p>Hi {user_name}!</p><p>Welcome to " . $projectname . "! Thanks so much for joining us.</p><p>You can now login and view your tickets, purchase tickets and more!</p> <p>Have any questions? Just shoot us an email at info@example.com! We are always here to help.</p><p>Regards,<br />" . $projectname . " Team</p>",
        ]);

        EmailTemplate::firstOrCreate([
            'id' => 4,
        ], [
            'title' => "Account Activate (User)",
            'subject' => "Account Activated",
            'body' => "<p>Hello {user_name},</p><p>Your account has been activated, Now you can login</p><p>Thanks,<br />" . $projectname . " Team</p>",
        ]);

        EmailTemplate::firstOrCreate([
            'id' => 5,
        ], [
            'title' => "Account Suspended (User)",
            'subject' => "Account Suspended",
            'body' => "<p>Hello {user_name},</p><p>Your account have been suspended by " . $projectname . " Team. For more information, please contact us at info@example.com</p><p>Thanks,<br />" . $projectname . " Team</p>",
        ]);

        EmailTemplate::firstOrCreate([
            'id' => 6,
        ], [
            'title' => "Contact Enquiry",
            'subject' => "Enquiry",
            'body' => "<p>Hello!</p><p>New&nbsp;Enquiry</p><p>Name: {name}<br />Email: {email}<br />Message: {message}</p><p>Thanks,<br />" . $projectname . " Team</p>",
        ]);
    }
}
