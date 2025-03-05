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
        <h2 class="text-2xl font-bold">Information Collection and Use</h2>
        <p>For a better experience, while using our Service, we may require you to provide us with certain personally identifiable information, including but not limited to Emails, Full Name, Phone number. The information that we request will be retained on your device and is not collected by us in any way.</p>
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