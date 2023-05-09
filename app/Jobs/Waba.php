<?php

namespace App\Jobs;

use App\Models\Leave;
use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Waba implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $messageNotification;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        //
        $this->messageNotification = $request->all();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        Log::alert($this->messageNotification);
        if (key_exists('messages', $this->messageNotification)) {
            // inbound message
            $message = Message::create([
                'type' => $this->messageNotification['messages'][0]['type'],
                'msg_id' => $this->messageNotification['messages'][0]['id'],
                'incoming' => true
            ]);
            switch ((($this->messageNotification['messages'])[0])['type']) {
                case 'text':
                    // welcome message
                    $body = "```Hi, Welcome to Whatsapp Desk.😀```";
                    $message_id = $this->send_text([
                        "body" => $body
                    ], (($this->messageNotification['messages'])[0])['from']);

                    // interactive buttons
                    $message_id = $this->send_button(['text' => 'Please select an option to continue.',], ['text' => 'Whatsapp Desk'], [
                        [
                            'type' => 'reply',
                            'reply' => [
                                'id' => 'requests-submission',
                                'title' => 'Requests',
                            ]
                        ],
                        [
                            'type' => 'reply',
                            'reply' => [
                                'id' => 'feedback&issue',
                                'title' => 'Feedback & Issue',
                            ]
                        ],
                        [
                            'type' => 'reply',
                            'reply' => [
                                'id' => 'iso&policies',
                                'title' => 'ISO & Policies',
                            ]
                        ],
                    ], (($this->messageNotification['messages'])[0])['from']);
                    break;
                case 'interactive':
                    switch (((($this->messageNotification['messages'])[0])['interactive'])['type']) {
                        case 'list_reply':
                            // Test if is a leave
                            $leave_query = Leave::where('id', $this->messageNotification['messages'][0]['interactive']['list_reply']['id']);
                            if ($leave_query->exists()) {
                                // leave row selected from a list
                                $leave = $leave_query->first();
                                // Outline details of selected leave & prompt accept
                                $body = "*" . Str::upper($leave->name) . "* \n ```" . Str::ucfirst($leave->description) . "``` \n\n Leave is with pay: " . (!$leave->is_without_pay ? "✅" : "❎") . " \n\n Leave includes holidays: " . ($leave->includes_holidays ? "✅" : "❎");
                                $message_id = $this->send_text([
                                    "body" => $body
                                ], (($this->messageNotification['messages'])[0])['from']);


                                // interactive buttons
                                $message_id = $this->send_button(['text' => 'Please *confirm* Leave Application.',], ['text' => 'Whatsapp Desk'], [
                                    [
                                        'type' => 'reply',
                                        'reply' => [
                                            'id' => 'accept-' . $leave->id . '-leave',
                                            'title' => 'Confirm?',
                                        ]
                                    ],
                                ], (($this->messageNotification['messages'])[0])['from']);
                                break;
                            }
                            // leave option selected
                            if ($this->messageNotification['messages'][0]['interactive']['list_reply']['id'] === 'leave') {
                                $leaves = [];
                                foreach (Leave::where('available', 1)->get() as $leave) {
                                    $leaves = Arr::prepend($leaves, [
                                        'id' => $leave->id,
                                        'title' => $leave->name,
                                        'description' => Str::length($leave->description) > 72 ? Str::substrReplace($leave->description, '..', 70) : $leave->description,
                                    ]);
                                }
                                Log::alert($leaves);
                                $message_id = $this->send_list(
                                    [
                                        'text' => 'Select a type of leave..',
                                    ],
                                    [
                                        'text' => 'Whatsapp Desk'
                                    ],
                                    [
                                        [
                                            'title' => 'SELECT LEAVE TYPE',
                                            'rows' => $leaves
                                        ]
                                    ],
                                    'LEAVE TYPES',
                                    (($this->messageNotification['messages'])[0])['from']
                                );
                            }
                            break;
                        case 'button_reply':
                            if ($this->messageNotification['messages'][0]['interactive']['button_reply']['id'] === 'requests-submission') {
                                $message_id = $this->send_list(
                                    [
                                        'text' => 'Click *Apply* button to proceed.',
                                    ],
                                    [
                                        'text' => 'Whatsapp Desk'
                                    ],
                                    [
                                        [
                                            'title' => 'APPLY FOR',
                                            'rows' => [
                                                [
                                                    'id' => 'leave',
                                                    'title' => '🪲Leave Request',
                                                    'description' => 'Description goes here.'
                                                ],
                                                [
                                                    'id' => 'travel',
                                                    'title' => '🐼Travel Request',
                                                    'description' => 'Description goes here.'
                                                ],
                                                [
                                                    'id' => 'claim',
                                                    'title' => '🐢Claim',
                                                    'description' => 'Description goes here.'
                                                ],
                                                [
                                                    'id' => 'advance',
                                                    'title' => '🐑Advance',
                                                    'description' => 'Description goes here.'
                                                ],
                                                [
                                                    'id' => 'appointment',
                                                    'title' => '🐧Appointment',
                                                    'description' => 'Description goes here.'
                                                ],
                                            ]
                                        ]
                                    ],
                                    'APPLY',
                                    (($this->messageNotification['messages'])[0])['from']
                                );
                            }
                            break;
                    }
                    break;
                default;
            }
        }
    }

    function send_list($body, $footer, $sections, $button, $to)
    {
        $response = Http::withHeaders([
            'D360-API-KEY' => ENV('D360_API_KEY')
        ])->acceptJson()->post(env('D360_BASE_URL') . 'messages', [
            "preview_url" => false,
            "recipient_type" => "individual",
            "to" => $to,
            "type" => "interactive",
            "interactive" => [
                'type' => 'list',
                'body' => $body,
                'footer' => $footer,
                'action' => [
                    'button' => $button,
                    'sections' => $sections,
                ]
            ]
        ]);
        // Log::alert($response);
        if (array_key_exists('messages', $response->json())) {
            return ($response->json())['messages'][0]['id'];
        }
        return null;
    }

    function send_button($body, $footer, $buttons, $to)
    {
        $interactive = [
            'type' => 'button',
            'body' => $body,
            'footer' => $footer,
            'action' => [
                'buttons' => $buttons,
            ]
        ];
        $response = Http::withHeaders([
            'D360-API-KEY' => ENV('D360_API_KEY')
        ])->acceptJson()->post(env('D360_BASE_URL') . 'messages', [
            "preview_url" => false,
            "recipient_type" => "individual",
            "to" => $to,
            "type" => "interactive",
            "interactive" => $interactive
        ]);
        // Log::alert($response);
        if (array_key_exists('messages', $response->json())) {
            return ($response->json())['messages'][0]['id'];
        }
        return null;
        // Log::alert($response);
    }

    function send_text($text, $to)
    {
        $response = Http::withHeaders([
            'D360-API-KEY' => ENV('D360_API_KEY')
        ])->acceptJson()->post(env('D360_BASE_URL') . 'messages', [
            "preview_url" => false,
            "recipient_type" => "individual",
            "to" => $to,
            "type" => "text",
            "text" => $text
        ]);
        if (array_key_exists('messages', $response->json())) {
            return ($response->json())['messages'][0]['id'];
        }
        return null;
    }
}
