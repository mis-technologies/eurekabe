<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Volunteer Application Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: {{ $isApproved ? '#4CAF50' : '#6366F1' }};
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            margin: 20px 0;
            padding: 20px;
            line-height: 1.6;
            color: #333;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: bold;
            margin: 10px 0;
            {{ $isApproved ? 'background-color: #dcfce7; color: #166534;' : 'background-color: #fee2e2; color: #991b1b;' }}
        }
        .next-steps {
            background-color: #f8fafc;
            border-left: 4px solid {{ $isApproved ? '#4CAF50' : '#6366F1' }};
            padding: 15px;
            margin: 20px 0;
        }
        .next-steps h3 {
            margin-top: 0;
            color: #1e293b;
        }
        .footer {
            text-align: center;
            color: #777;
            font-size: 12px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">Eureka EdTech</div>
            <h1>Volunteer Application Update</h1>
        </div>
        
        <div class="content">
            <p>Dear {{ $application->firstname }} {{ $application->lastname }},</p>
            
            @if($isApproved)
                <p>We are thrilled to inform you that your volunteer application has been <strong>approved</strong>! 🎉</p>
                
                <p style="text-align: center;">
                    <span class="status-badge">✓ Application Approved</span>
                </p>
                
                <p>Thank you for your interest in joining the Eureka EdTech volunteer team. We were impressed by your application and are excited to have you on board!</p>
                
                <div class="next-steps">
                    <h3>📋 Next Steps</h3>
                    <p>Our team will reach out to you within the next <strong>3-5 business days</strong> to:</p>
                    <ul>
                        <li>Schedule an onboarding call</li>
                        <li>Discuss your role and responsibilities</li>
                        <li>Provide you with access to our volunteer resources</li>
                        <li>Answer any questions you may have</li>
                    </ul>
                    <p>Please keep an eye on your inbox for further communication from our team.</p>
                </div>
                
                <p>In the meantime, feel free to follow us on our social media channels to stay updated on our latest initiatives!</p>
            @else
                <p>Thank you for taking the time to apply to become a volunteer at Eureka EdTech.</p>
                
                <p style="text-align: center;">
                    <span class="status-badge">Application Not Selected</span>
                </p>
                
                <p>After careful consideration, we regret to inform you that we are unable to move forward with your application at this time.</p>
                
                <div class="next-steps">
                    <h3>📋 What's Next?</h3>
                    <p>This decision does not reflect on your abilities or potential. We encourage you to:</p>
                    <ul>
                        <li>Apply again in the future when new opportunities arise</li>
                        <li>Follow us on social media for updates on new volunteer positions</li>
                        <li>Continue developing your skills in areas that interest you</li>
                    </ul>
                    <p>Our team may reach out if a suitable opportunity becomes available that matches your skills and interests.</p>
                </div>
                
                <p>We truly appreciate your interest in supporting our mission to make education smarter and more accessible.</p>
            @endif
            
            <p>Best regards,<br>
            <strong>The Eureka EdTech Team</strong></p>
        </div>
        
        <div class="footer">
            <p>© {{ date('Y') }} Eureka EdTech. All rights reserved.</p>
            <p>This is an automated message. If you have any questions, please contact our support team.</p>
        </div>
    </div>
</body>
</html>
