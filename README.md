## Roundcube SPF Status Plugin

This tiny plugin causes an additional header to be displayed when viewing messages, indicating the status of the SPF header:

![Screenshot](https://i.stack.imgur.com/6VFLu.png)

### Installation

Copy the `spfstatus` directory to Roundcube's `plugins/` directory. Then add the plugin to your configuration:

    $config['plugins'] = array(
        'spfstatus',
        ...
    );
