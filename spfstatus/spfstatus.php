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

class spfstatus extends rcube_plugin
{
    public $task = 'mail';

    function init()
    {
        $rcmail = rcmail::get_instance();
        if ($rcmail->action == 'show' || $rcmail->action == 'preview') {
            $this->add_hook('storage_init', array($this, 'storage_init'));
            $this->add_hook('message_headers_output', array($this, 'message_headers_output'));
        } else if ($rcmail->action == '') {
            $this->add_hook('storage_init', array($this, 'storage_init'));
        }
    }

    function storage_init($p)
    {
        $rcmail = rcmail::get_instance();
        $p['fetch_headers'] = trim($p['fetch_headers'] . ' RECEIVED-SPF');
        return $p;
    }

    function message_headers_output($p)
    {
        $rcmail = rcmail::get_instance();
        $spf = $p['headers']->get('Received-SPF');
        if (0 === strpos($spf, 'Pass')) {
            $img = $this->urlbase . 'images/pass.png';
            $txt = 'Pass (valid sender)';
        } else if (0 === strpos($spf, 'Fail')) {
            $img = $this->urlbase . 'images/fail.png';
            $txt = 'Fail (invalid sender)';
        } else {
            $img = $this->urlbase . 'images/unknown.png';
            $txt = 'Unknown (missing or neutral header)';
        }
        $p['output']['spf'] = array(
            'title' => 'SPF Status',
            'value' => html::img(array(
                'src' => $img,
                'style' => 'vertical-align: bottom; width: 12px;',
            )) . ' ' . htmlentities($txt),
        );
        return $p;
    }
}

?>
