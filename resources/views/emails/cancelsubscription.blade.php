<!DOCTYPE html>
<html>

	<head>
		<title>DormDoctors</title>

		 <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">


	</head>
	<body style="font-family: 'Lato', sans-serif;">
		<div style="width: 430px;margin: auto;">
			<table style="padding: 20px 20px;background: #f29f00;width: 100%;color:#fff;text-align: c;">
			<tbody>
			<tr>
			<td style="text-align: center;line-height: 30px;text-transform: uppercase;font-size: 22px;padding: 20px 15px 0;"><img src="{{asset('images/logo.png')}}" style="width: 210px;"></td>
			</tr>

			</tbody>

			</table>
			<table style="padding: 20px 20px;background: #f29f00;width: 100%;color:#fff;">
			<tbody>
			<tr>
			<td style="padding: 0 30px;background: #4c6cb9;">
			<table style="padding: 30px 0 13px;width: 100%;color:#fff;">
			<tbody>
			<tr>
			<td style="font-size: 24px;text-align: center;text-transform: uppercase;padding: 8px 0;font-weight: 600;">
		Dear Customer
			</td>
			</tr>
			<tr>
			<td style="font-size: 16px;text-transform: none;padding: 8px 0;text-align: center;"><!-- We have received your cancel request for your order. Below are the details -->
				{{ $body }}
			</td>

			</tr>

			 </tbody>

			</table>

			<table style="padding: 20px 0px;width: 100%;color:#fff;border-top: 1px solid #324e90;border-bottom: 1px solid #324e90;">
			<tbody>

			<tr>
			<td>
			Order Number:
			</td>
			<td style="text-align: right;">
			{{ $subscription_id }}
			</td>
			</tr>
			<tr>
			<td style="padding: 0;">
			Reason:
			</td>
			<td style="padding: 10px 0;text-align: right;">
			{{ $reason }}
			</td>

			</tr>

			 </tbody>

			</table>
			<table style="padding: 10px 0px 10px;width: 100%;color:#fff;border-bottom: 1px solid #324e90;">
			<tbody>

			<tr>
            <td style="font-size: 16px;text-transform: none;padding: 8px 0;text-align: center;">
                {{ $description }}
			</td>

			</tr>

			 </tbody>

			</table>

			<table style="padding: 10px 30px 10px;width: 100%;color:#fff;">
			<tbody>

			<tr>
			<td style="font-size: 16px;text-transform: none;padding: 8px 0;text-align: center;">Thank You
			</td>

			</tr>
			<tr>
			<td style="font-size: 30px;text-transform: none;padding: 0 0 8px 0;text-align: center;">Team DormDoctors
			</td>

			</tr>

			 </tbody>

			</table>






</td></tr></tbody></table></div>


</body>
</html>
