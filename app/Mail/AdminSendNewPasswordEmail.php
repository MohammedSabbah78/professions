<?php

namespace App\Mail;

use App\Models\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminSendNewPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;
    public Admin $admin;
    public string $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Admin $admin, $password)
    {
        //
        $this->admin = $admin;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.admin_send_password_email')
            ->from('info@medical-app.ps', 'Professions System')->cc('hr@medical.ps');
    }
}
