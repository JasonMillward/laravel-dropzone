<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Ramsey\Uuid\Uuid;

class SignedS3UrlCreatorController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function index()
    {
        return response()->json([
            'error'     => false,
            'url'       => $this->get_amazon_url(request('name')),
            'additionalData' => [
                // Uploading many files and need a unique name? UUID it!
                'fileName' => Uuid::uuid4()->toString()
            ],
            'code'      => 200,
        ], 200);
    }

    /**
     * @param $name
     * @return string
     */
    private function get_amazon_url($name)
    {
        $s3 = Storage::disk('s3');

        $client = $s3->getDriver()->getAdapter()->getClient();

        $expiry = "+90 minutes";

        $command = $client->getCommand('PutObject', [
            'Bucket' => config('filesystems.disks.s3.bucket'),
            'Key'    => $name,
        ]);

        return (string) $client->createPresignedRequest($command, $expiry)->getUri();
    }
}
