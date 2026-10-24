@extends('layout.app')
@section('content')


<section class="container py-16 dark:text-white">
    <div class="max-w-4xl mx-auto px-2">
      <h1 class="text-4xl font-bold mb-8 font-lato text-center">Privacy Policy</h1>
      
      <div class="flex flex-col gap-6 text-justify">
          <!-- About -->
        <div >
        <p>MISTech company built the Eureka app as a Free app. This SERVICE is provided by MISTech company at no cost and is intended for use as is.</p>

        <p>This page is used to inform visitors regarding our policies with the collection, use, and disclosure of Personal Information if anyone decided to use our Service.</p>

        <p>If you choose to use our Service, then you agree to the collection and use of information in relation to this policy. The Personal Information that we collect is used for providing and improving the Service. We will not use or share your information with anyone except as described in this Privacy Policy.</p>
        </div>

        <!-- Information Collection and Use -->
        <div class="flex flex-col gap-2">
        <h2 class="text-2xl font-bold">Information We Collect and How We Use It</h2>
        <p>We collect the following information when you create an account and use Eureka. We use it only to provide and improve the Service.</p>
        <ul class="list-disc pl-6 space-y-2">
          <li><strong>Account details</strong> — your name, email address, username, school and password (stored securely hashed). Used to create and secure your account.</li>
          <li><strong>Exam activity</strong> — exams you take, answers, scores, ranks, achievements and credit usage. Used to show your progress and results.</li>
          <li><strong>Photos and PDFs</strong> — a profile photo, or a photo or PDF you choose to attach to a chat message. Used only to show your profile photo and to deliver attachments to the person you send them to.</li>
          <li><strong>Messages</strong> — messages you send to other students through in-app chat, stored on our servers so they can be delivered to the recipient.</li>
          <li><strong>Device information</strong> — a push notification token, and basic device and log data used for notifications, crash reporting and security.</li>
        </ul>
        <p>We do not sell your personal information.</p>
        </div>

        <!-- AI -->
        <div class="flex flex-col gap-2">
        <h2 class="text-2xl font-bold">AI Features and OpenAI</h2>
        <p>Eureka AI features (the AI tutor, hints, explanations and study summaries) are powered by OpenAI, a third-party AI service. When you use these features, the text you type (your questions and chat messages) and the related exam question or study material you ask about are sent to OpenAI so it can generate a response. We ask for your permission before this happens, the first time you use an AI feature. Your name, email and other account details are not included in these requests.</p>
        <p>OpenAI processes this data to provide the response and is required to protect it to the same standard we apply. Please avoid entering personal information you do not want shared. If you do not agree, you can decline and continue to use the rest of Eureka.</p>
        </div>

        <!-- Leaderboard -->
        <div class="flex flex-col gap-2">
        <h2 class="text-2xl font-bold">Leaderboards</h2>
        <p>If you choose to appear on the leaderboard, your name, profile photo, school and exam scores are shown publicly to other Eureka users. This is optional. We ask for your permission and you can turn it on or off at any time under Profile &gt; Show me on the leaderboard. If you opt out, your scores are not shown on leaderboards.</p>
        </div>

        <!-- Safety -->
        <div class="flex flex-col gap-2">
        <h2 class="text-2xl font-bold">User Safety, Reporting and Blocking</h2>
        <p>You can report or block another user from within a chat. Reports are reviewed by our team, and we may remove content or suspend accounts that violate our Terms.</p>
        </div>

        <!-- Retention -->
        <div class="flex flex-col gap-2">
        <h2 class="text-2xl font-bold">Data Retention and Account Deletion</h2>
        <p>We keep your data while your account is active. You can delete your account at any time from Profile &gt; Delete account. This permanently removes your profile and anonymizes your exam history. You can also request deletion by contacting us through our contact page.</p>
        </div>

        <!-- Third Party Services -->
          <div class="flex flex-col gap-2">
        <h3 class="text-xl font-bold">Third Party Services</h3>
        <ul class="list-disc pl-6 space-y-2">
          <li>Firebase</li>
          <li>Google Play Services</li>
          <li>Google Analytics</li>
          <li>Google Crashlytics</li>
          <li>One Signal</li>
          <li>OpenAI (AI tutor, hints and study summaries)</li>
          <li>Paystack (payments, where available)</li>
        </ul>
        </div>
        
      <!-- Log Data -->
      <div class="flex flex-col gap-2">
        <h2 class="text-2xl font-bold">Log Data</h2>
        <p>We want to inform you that whenever you use our Service, in a case of an error in the app we collect data and information (through third party products) on your phone called Log Data. This Log Data may include information such as your device Internet Protocol ("IP") address, device name, operating system version, the configuration of the app when utilizing our Service, the time and date of your use of the Service, and other statistics.</p>
      
      </div>  

      <!-- Cookies -->
      <div class="flex flex-col gap-2">
        <h2 class="text-2xl font-bold">Cookies</h2>
        <p>Cookies are files with a small amount of data that are commonly used as anonymous unique identifiers. This Service does not use these "cookies" explicitly. However, the app may use third party code and libraries that use "cookies" to collect information and improve their services.</p>
      </div>

      <!-- Security -->
      <div class="flex flex-col gap-2">
        <h2 class="text-2xl font-bold">Security</h2>
        <p>We value your trust in providing us your Personal Information, thus we are striving to use commercially acceptable means of protecting it. But remember that no method of transmission over the internet, or method of electronic storage is 100% secure and reliable, and we cannot guarantee its absolute security.</p>
        </div>

      <!-- Children's Privacy -->
      <div class="flex flex-col gap-2">
        <h2 class="text-2xl font-bold">Children's Privacy</h2>
        <p>These Services do not address anyone under the age of 13. We do not knowingly collect personally identifiable information from children under 13.</p>
      </div>

      <!-- Changes to This Privacy Policy -->
      <div class="flex flex-col gap-2">
        <h2 class="text-2xl font-bold">Changes to This Privacy Policy</h2>
        <p>We may update our Privacy Policy from time to time. Thus, you are advised to review this page periodically for any changes. This policy is effective as of 18-12-2024.</p>
      </div>

      <!-- Contact Us -->
      <div class="flex flex-col gap-2">
        <h2 class="text-2xl font-bold">Contact Us</h2>
        <p>If you have any questions or suggestions about our Privacy Policy, do not hesitate to contact us at <a href="mailto:info@eurekaedu.academy" class="underline text-primary italic">info@eurekaedu.academy</a></p>
        </div>
      </div>
      
    </div>
  </section>
@endsection