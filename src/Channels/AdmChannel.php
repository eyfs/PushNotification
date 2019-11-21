<?php

namespace eyfs\PushNotification\Channels;

class AdmChannel extends GcmChannel
{
    /**
     * {@inheritdoc}
     */
    protected function pushServiceName()
    {
        return 'adm';
    }
}
