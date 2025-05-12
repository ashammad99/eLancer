<?php

namespace App\Notifications;
use App\Channels\Log;
use App\Channels\Nepras;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\AnonymousNotifiable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\VonageMessage;
use Illuminate\Notifications\Notification;


class NewProposalNotification extends Notification
{
    use Queueable;

    protected $proposal;

    protected $freelancer;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Proposal $proposal, User $freelancer)
    {
        $this->proposal = $proposal;
        $this->freelancer = $freelancer;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
//        $via = ['database', 'broadcast', 'nexmo']; //predefined or use class name
        $via = [Log::class];
        if (!$notifiable instanceof AnonymousNotifiable) {

            if ($notifiable->notify_mail) {
                $via[] = 'mail';
            }
            if ($notifiable->notify_sms) {
                $via[] = 'nexmo';
            }
        }

        return $via;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    public function toMail($notifiable)
    {
        $body = sprintf(
            '%s applied for a job %s',
            $this->freelancer->name,
            $this->proposal->project->title,
        );

        $msg = new MailMessage();
        $msg->subject('New Proposal')
            //->from()//defined in .env
            ->greeting("Hello " . $notifiable->name)
            ->line('The introduction to the notification.')
            ->action('View Proposal', route('projects.show', $this->proposal->project_id))
            ->line('Thank you for using our application!')
            ->view('mails.proposal', [
                'proposal' => $this->proposal,
                'notifiable' => $notifiable,
                'freelancer' => $this->freelancer
            ])//return view file for Email Message format
        ;
        return $msg;
    }

    public function toDatabase($notifiable)
    {
        $body = sprintf(
            '%s applied for a job %s',
            $this->freelancer->name,
            $this->proposal->project->title,
        );

        return [
            'title' => 'New Proposal',
            'body' => $body,
            'icon' => 'icon-material-outline-group',
            'url' => route('projects.show', $this->proposal->project_id),
        ];
    }


    public function toBroadcast($notifiable)
    {
        $body = sprintf(
            '%s applied for a job %s',
            $this->freelancer->name,
            $this->proposal->project->title,
        );

        return [
            'title' => 'New Proposal',
            'body' => $body,
            'icon' => 'icon-material-outline-group',
            'url' => route('projects.show', $this->proposal->project_id),
        ];
    }

    public function toVonage($notifiable)
    {
        $body = sprintf(
            '%s applied for a job %s',
            $this->freelancer->name,
            $this->proposal->project->title,
        );
        $message = new VonageMessage();
        $message->content($body);
    }

    public function toLog($notifiable)
    {
        $body = sprintf(
            '%s applied for a job %s',
            $this->freelancer->name,
            $this->proposal->project->title,
        );

        return $body;
    }

    public function toNepras($notifiable)
    {
        $body = sprintf(
            '%s applied for a job %s',
            $this->freelancer->name,
            $this->proposal->project->title,
        );

        return $body;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
