<?php

/**
 * Roundcube plugin displaying SPF status
 *
 * Plugin checks messages for the Received-SPF header and displays a status
 * icon with the other message headers indicating the result.
 *
 * @version $Revision
 * @author Nathan Osman
 * @url https://github.com/nathan-osman/roundcube-spf-status
 */

class roundcube_spf_status extends rcube_plugin
{
    public $task = 'mail';

    function init()
    {
        if ($rcmail->action == 'show' || $rcmail->action == 'preview') {
            $this->add_hook('storage_init', array($this, 'fetch_spf_header'));
            $this->add_hook('message_headers_output', array($this, 'display_spf_header'));
        }
    }

    function fetch_spf_header($p)
    {
        //...

        return $p;
    }

    function display_spf_header($p)
    {
        //...

        return $p;
    }
}

?>
