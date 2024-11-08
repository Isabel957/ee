# AddedBennefits Demo

Core with the necessary file to start a front end project.

Run 'pnpm install'

Run 'gulp' to start the server and the watcher

Run 'gulp images' to compress the images

Run 'gulp icons' to make a svg sprite

Run 'gulp svg' to make optimize svgs

Run 'gulp fonts' to copy the fonts

## Notes

By default this script is commentted in pug, otherwise you can't see the changes made because the page is forced to reload using https and the localhost of BrowserSync don't allow this.

    //script.
        if (location.protocol !== 'https:') {
        location.replace(`https:${location.href.substring(location.protocol.length)}`);
        }

After your changes are completed remove the comment, save and compile the pug files. If you want to edit again comment the script temporarily