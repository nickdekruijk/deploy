<?php

namespace NickDeKruijk\Deploy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\Process\Process;

class DeployController extends Controller
{
    public function deploy(Request $request)
    {
        $githubPayload = $request->getContent();
        $githubHash = $request->header('X-Hub-Signature');
        $localToken = config('deploy.secret');
        $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);
        if (hash_equals($githubHash, $localHash)) {
            $root_path = base_path();
            $process = new Process('cd ' . $root_path . '; ' . config('deploy.script'));
            $process->run(function ($type, $buffer) {
                echo $buffer;
            });
        }
    }
}
