<!DOCTYPE html>
<html>
	
	<head>
		<title>Emails</title>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet"> 
		
		<!--style>
		
		font-family: 'Exo 2', sans-serif;
		font-family: 'Pacifico', cursive;
		</style-->
	</head>
	
<body style="font-family: 'Roboto', sans-serif; margin:0;">
		<div style="width: 500px;margin: auto;box-shadow: 0px 0px 8px #ddd;">
			<table style="width: 100%;text-align: center; background:url(images/bg1.png) no-repeat left top / cover;">
			<tbody><tr>
			<td style="padding: 0px 10px 0px;">
			
			<table style="width: 100%;text-align: center; ">
			<tbody><tr>
			<td style="padding: 0px 0;">
			<table style="width: 100%;text-align: center;">
				<tbody><tr style="background: #f0e2df;">
					<td style="padding: 4px;"><img src="logo.png" style="width: 200px;"></td>
				</tr>
				</tbody>
			</table>
			<table style="width: 100%;text-align: center;margin-top: 25px;">
				<tbody>
				
				
				<tr>
				<td style="font-size: 23px;color: #242329;font-weight: 400;padding: 0 0 0px;font-size: 29px;text-transform: capitalize;font-weight: bold;"><b style="color: #ff5721;"> Hii</b> {{ $name }}</td>
				</tr>
				<tr>
				@if($type == '1')
				<td style="font-size: 17px;color: #796c6c;font-weight: 400;padding: 18px 26px 15px;">Your subscription for <b>({{ $planTitle }}) </b>has been successfully {{ $status }}. 
				</td>
				@else
					<td style="font-size: 17px;color: #796c6c;font-weight: 400;padding: 18px 26px 15px;">Your subscription for <b>($planTitle) </b>has been successfully canceled. 
					</td>

				@endif
				</tr>
				<tr>
				<td style="font-size: 17px;color: #796c6c;font-weight: 400;padding: 18px 26px 15px;"><!-- We’re sorry to see you go! To help us improve our service we would appreciate it if you took a moment
  To fill out this quick survey: <a href="" style="color: #ff5721;font-weight: bold;">  (insert link)  </a>
We value your feedback.  -->
	{{ $body }}
</td>
				</tr>
				
				<tr>
				<td style="font-size: 30px;color: #fff;font-weight: bold;padding: 0px 0 10px;text-align: center;">
				
				
				<p><a href="" style="color: #000;text-decoration: none;font-size: 14px;text-transform: uppercase;padding: 10px 40px;display: inline;border-radius: 3px;width: 100%;box-sizing: border-box;text-align: center;display: inline-block;">Stay fresh,  <br>Dorm Doctors

</a> </p>
				</td>
				</tr>
			</tbody>
			</table>
			
			
			</td>
			</tr>
			</tbody></table>
			
			</td>
			</tr>
			</tbody></table>
		</div>
	

</body>
</html>