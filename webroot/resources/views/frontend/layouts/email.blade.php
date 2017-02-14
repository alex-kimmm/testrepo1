<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
	<script src="https://use.typekit.net/lhg8zxz.js"></script>
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <style type="text/css">
    body {margin: 0; padding: 0;}
    a {color: #f70a4d;}
    td {padding: 5px;}
    </style>
</head>
<body>
<table height="100%" width="100%" cellspacing="0" cellpadding="0" bgcolor="#ededed" align="center" style="background-color: #ededed!important;">
	<tbody>
		<tr><td>
			<table width="600" bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" valign="top" style="overflow:hidden!important; margin: 40px auto; background-color: #ffffff; -webkit-box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.1); -moz-box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.1); box-shadow: 5px 5px 5px 0px rgba(0,0,0,0.1);">
		        <tbody>
		        <tr style="height: 287px; background-image: url({{ url('/img/email-header.jpg') }}); background-repeat: no-repeat; background-size: 600px 287px; position: relative;">
		        	<td>
		        		<table>
		                	<tbody>
		                		<tr>
		                			<td style="width: 75%">
		                				<h2 style="margin:0!important; font-family: 'museo-sans',sans-serif!important; font-size:25px!important;line-height:38px!important;font-weight:900!important;color:#ffffff!important;  text-transform:uppercase;">
                                            <span style="background-color: #313131; padding: 10px 15px; -webkit-box-decoration-break: clone; -o-box-decoration-break: clone; box-decoration-break: clone;">@yield('subject')</span>
                                        </h2>
		                			</td>
		                			<td style="width: 25%">
		                				<img src="{{ url('/img/logo.png') }}" style="display: block; margin-top: -125px;" width="157" height="80">
		                			</td>
		                		</tr>

		            		</tbody>
		            	</table>
		        	</td>
		        </tr>
		        <tr height="30"><td>&nbsp;</td></tr>
		        <tr>
			        <td align="center">
			            <table width="85%">
			                <tbody>
			                	<tr>
			                		<td align="center">
			                			<h2 style="margin:0!important;font-family: 'museo-sans',sans-serif!important;font-size:30px!important;line-height:40px!important;font-weight:900!important;color:#313131!important">@yield('title')</h2>
			                		</td>
			                	</tr>
			            	</tbody>
			            </table>
			        </td>
		        </tr>
		        <tr height="20"><td>&nbsp;</td></tr>
		        <tr><td align="center">
		            <table border="0" cellpadding="0" cellspacing="0" width="500">
		                <tbody><tr><td style="font-family:'museo-sans',sans-serif!important;font-size:20px!important;line-height:30px!important;font-weight:500!important;color:#313131!important">
		                    @yield('main')
		                </td></tr>
		            </tbody></table>
		        </td></tr>
		        <tr height="40"><td>&nbsp;</td></tr>
		        @yield('button')
		        <tr height="50"><td>&nbsp;</td></tr>
		        <tr><td align="center">
		            <table border="0" cellpadding="0" cellspacing="0" width="500">
		                <tbody><tr><td style="font-family:'museo-sans',sans-serif!important;font-size:20px!important;line-height:30px!important;font-weight:500!important;color:#313131!important">
								<strong>Team Zugar Znap</strong>
							</td></tr>
		            </tbody></table>
		        </td></tr>
		        <tr height="80"><td align="center">
		            <table border="0" cellpadding="0" cellspacing="0" width="500">
		            	<tbody>
		        			<tr><td width="500"><hr style="border-color: #cccccc;"></td></tr>
		        		</tbody>
		        	</table>
		        </td></tr>


		        <tr><td align="center" valign="top">
		            <table border="0" cellpadding="0" cellspacing="0" width="500">
		                <tbody>
		                	<tr>
			                	<td style="font-family:'museo-sans',sans-serif!important;font-size:18px!important;line-height:24px!important;font-weight:500!important;color:#7c7c7c!important">
				                	Zugar Znap<br>
				                	57 - 69 Charterhouse Street<br>
				                	London<br>
				                	EC1M 6HA<br>
				                	United Kingdom<br>
								</td>
								<td align="right" valign="top">
									<table border="0" cellpadding="0" cellspacing="0">
						                <tbody>
											<tr><td><a target="_blank" href="https://www.instagram.com/zugarznap/"><img src="{{ url('/img/email-insta.png') }}" width="30" height="30" style="margin-bottom: 5px;"></a></td></tr>
											<tr><td><a target="_blank" href="https://www.facebook.com/zugarznap"><img src="{{ url('/img/email-fb.png') }}" width="30" height="30" style="margin-bottom: 5px;"></a></td></tr>
						            </tbody></table>
								</td>
							</tr>
		            </tbody></table>
		        </td></tr>

		        <tr height="100"><td align="center">
		            <table border="0" cellpadding="0" cellspacing="0" width="500">
		            	<tbody>
		        			<tr>
		        			<td width="500" align="center" style="color: #7c7c7c; font-family:'museo-sans',sans-serif!important;font-size:18px!important;line-height:20px!important;font-weight:500!important;">
		        			</td></tr>
		        		</tbody>
		        	</table>
		        </td></tr>

		    	</tbody>
		    </table>
		</td></tr>
	</tbody>
</table>
</body>
</html>