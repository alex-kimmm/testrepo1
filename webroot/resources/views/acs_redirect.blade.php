<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01//EN'>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>Processing payment</title>
<style type="text/css">h3,h3,h4 { font-family: verdana, arial, sans-serif;  font-weight: normal;} #logo {float: left;}</style>
</head>

<body OnLoad="document.form.submit();" >
    <form name="form" id="form" action="{{$acsurl}}" method="POST">
        <div>
            <input type="hidden" name="PaReq" value="{{$pareq}}" />
            <input type="hidden" name="TermUrl" value="{{$termurl}}" />
            <input type="hidden" name="MD" value="{{$md}}" />
        </div>
        <noscript>
            <div>
                <h3>JavaScript is currently disabled or is not supported by your browser.</h3>
                <h4>Please click Submit to continue processing your 3-D Secure transaction.</h4>
                <input type="submit" value="Submit">
            </div>
        </noscript>
    </form>
</body>
</html>
