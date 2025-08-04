<?php

namespace App\Services;

use SendGrid;
use SendGrid\Mail\Mail;
use Exception;
use Illuminate\Support\Facades\Log;

class SendGridService
{
    private $sendgrid;
    private $isDevelopment;

    public function __construct()
    {
        $this->sendgrid = new SendGrid(config('services.sendgrid.api_key'));
        $this->isDevelopment = config('app.env') !== 'production';
    }

    /**
     * Send email using SendGrid
     *
     * @param string $replyTo Reply-to email address
     * @param string $replyToName Reply-to name
     * @param string $subject Email subject
     * @param string $body Email body (HTML)
     * @return array|false SendGrid response or false on failure
     */
    public function sendEmail($replyTo, $replyToName, $subject, $body)
    {
        $email = new Mail();

        // Set from address (verified sender in SendGrid)
        $email->setFrom('faan-website@castoware.com', 'FAAN Website');

        // Set reply-to (user who submitted the form)
        $email->setReplyTo($replyTo, $replyToName);

        // Set recipient (development vs production)
        $to = $this->isDevelopment ? 'castoware@gmail.com' : 'info@FAANecuador.org';
        $email->addTo($to, 'FAAN Info');

        // Set subject and content
        $email->setSubject($subject);
        $email->addContent('text/html', $body);

        try {
            $response = $this->sendgrid->send($email);

            $sendStatus = [
                'statusCode' => $response->statusCode(),
                'headers' => $response->headers(),
                'body' => $response->body(),
                'timestamp' => now()->toISOString(),
                'to' => $to,
                'from' => $replyTo,
                'subject' => $subject
            ];

            Log::info('Email sent successfully via SendGrid', [
                'status_code' => $response->statusCode(),
                'to' => $to,
                'from' => $replyTo,
                'subject' => $subject
            ]);

            return $sendStatus;
        } catch (Exception $e) {
            Log::error('SendGrid email failed', [
                'error' => $e->getMessage(),
                'to' => $to,
                'from' => $replyTo,
                'subject' => $subject
            ]);

            return false;
        }
    }

    /**
     * Format contact form email
     */
    public function sendContactEmail($name, $email, $subject, $message)
    {
        $body = "
            <h3>Contact Form Submission</h3>
            <p><strong>From:</strong> {$name} ({$email})</p>
            <p><strong>Subject:</strong> {$subject}</p>
            <p><strong>Message:</strong></p>
            <div style='border-left: 3px solid #ccc; padding-left: 15px; margin: 15px 0;'>
                " . nl2br(htmlspecialchars($message)) . "
            </div>
            <hr>
            <p style='color: #666; font-size: 12px;'>
                Sent from FAAN Foundation website contact form<br>
                IP: " . request()->ip() . "<br>
                User Agent: " . request()->userAgent() . "<br>
                Timestamp: " . now()->format('Y-m-d H:i:s T')  . "
            </p>
        ";

        return $this->sendEmail($email, $name, "Contact: {$subject}", $body);
    }

    /**
     * Format donation form email
     */
    public function sendDonationEmail($data, $type = 'donation')
    {
        $subject = $type === 'legacy_giving' ? 'Legacy Giving Information' : 'Donation Information';

        if ($type === 'legacy_giving') {
            $body = "
                <h3>Legacy Giving Form Submission</h3>
                <p><strong>From:</strong> {$data['name']} ({$data['email']})</p>
                <p><strong>Phone:</strong> {$data['phone']}</p>
                <p><strong>Document Number (Cédula or Passport):</strong> {$data['doc_num']}</p>
                <p><strong>Address:</strong></p>
                <div style='margin: 10px 0; padding: 10px; background: #f5f5f5;'>
                    " . nl2br(htmlspecialchars($data['address'])) . "
                </div>
                <p><strong>Donation Type:</strong> " . ucfirst(str_replace('_', ' ', $data['donation_type'])) . "</p>
                <p><strong>Donation Info:</strong> {$data['donation_info']}</p>
                <p><strong>Recognize as member of Legal Society:</strong> " . (($data['recognized'] ?? false) ? 'Yes' : 'No') . "</p>
            ";

            if (!empty($data['special_instructions'])) {
                $body .= "
                    <p><strong>Special Instructions:</strong></p>
                    <div style='margin: 10px 0; padding: 10px; background: #f5f5f5;'>
                        " . nl2br(htmlspecialchars($data['special_instructions'])) . "
                    </div>
                ";
            }
        } else {
            $body = "
                <h3>Donation Form Submission</h3>
                <p><strong>From:</strong> {$data['name']} ({$data['email']})</p>
                <p><strong>Donation Type:</strong> " . ucfirst(str_replace('_', ' ', $data['donation_type'])) . "</p>
                <p><strong>Donation Amount:</strong> $" . number_format($data['donation_amount'], 2) . "</p>
            ";
        }

        $body .= "
            <p><strong>Tracking ID:</strong> {$data['_id']}</p>
            <hr>
            <p style='color: #666; font-size: 12px;'>
                Sent from FAAN Foundation website " . ($type === 'legacy_giving' ? 'legacy giving' : 'donation') . " form<br>
                IP: " . $data['ip_address'] . "<br>
                User Agent: " . $data['user_agent'] . "<br>
                Timestamp: " . $data['date_received'] . "
            </p>
        ";

        return $this->sendEmail($data['email'], $data['name'], $subject, $body);
    }
}
