<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Group Request Your Email Address</h2>

        <div>
            To Accept the invatation of this group please click on the this link.<br>
            {{ URL::to('group/request/verfiy/' . $confirmation_code) }}<br/>

        </div>

    </body>
</html>