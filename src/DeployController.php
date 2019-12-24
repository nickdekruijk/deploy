<?php

namespace NickDeKruijk\Deploy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Process\Process;
use Mail;

class DeployController extends Controller
{
    private function notify($message)
    {
        if (config('deploy.notify_mail')) {
            Mail::raw($message, function ($message) {
                $message->subject('Deployment failed!');
                $message->from(config('mail.from.address'), config('mail.from.name'));
                $message->to(config('deploy.notify_mail'));
            });
        }
    }

    public function deploy(Request $request)
    {
        $githubPayload = $request->getContent();
        $githubHash = $request->header('X-Hub-Signature');
        $localToken = config('deploy.secret');
        $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);
        if (hash_equals($githubHash, $localHash)) {
            $root_path = base_path();
            $process = new Process('cd ' . $root_path . '; ' . config('deploy.script'));
            $process->run();
            if (!$process->isSuccessful()) {
                $this->notify('Error output:' . chr(10) . chr(10) . $process->getErrorOutput() . chr(10) . chr(10) . 'Full output:' . chr(10) . chr(10) . $process->getOutput());
            } elseif (config('deploy.notify_success')) {
                $this->notify($process->getOutput());
            }
        }
    }
}
