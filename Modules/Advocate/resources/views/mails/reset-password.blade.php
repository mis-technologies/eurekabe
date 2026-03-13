<!DOCTYPE html>
<html>
<head>
	<title>Password Reset </title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
		}

		h1 {
			color: #000000;
			text-align: center;
		}

		.container {
			max-width: 600px;
			margin: 0 auto;
			padding: 20px;
			background-color: #ffffff;
			border: 1px solid #d3d3d3;
			box-shadow: 0px 2px 5px rgba(0,0,0,0.1);
		}

		.otp-code {
			color: #ff0000;
			font-weight: bold;
			font-size: 24px;
			text-align: center;
			margin-top: 30px;
			margin-bottom: 30px;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>Password Reset </h1>
		<p>Dear {{$details ['user']}},</p>
		<p>Please use the following link to reset your password :</p>
		<a  href="{{ route('advocate.reset.password.view', $details['token'])  }}">Reset Password</a>
		<p>If you did not request this Reset Link, please ignore this email.</p>
	</div>
</body>
</html>
