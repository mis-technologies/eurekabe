@extends('layout.app')
@section('content')


<section class="container py-16 dark:text-white">
    <div class="max-w-4xl mx-auto px-2">
      <h1 class="text-4xl font-bold mb-8 font-lato text-center">Terms and Conditions</h1>
      
      <div class="flex flex-col gap-6 text-justify">
        <!-- General Terms -->
        <div class="flex flex-col gap-2">
          <p>By downloading or using the app, these terms will automatically apply to you – you should make sure therefore that you read them carefully before using the app.</p>
          
          <p>You're not allowed to copy, or modify the app, any part of the app, or our trademarks in any way. You're not allowed to attempt to extract the source code of the app, and you also shouldn't try to translate the app into other languages, or make derivative versions.</p>
          
          <p>The app itself, and all the trade marks, copyright, database rights and other intellectual property rights related to it, still belong to MISTech company.</p>
        </div>

        <!-- Company Rights -->
        <div class="flex flex-col gap-2">
          <p>MISTech company is committed to ensuring that the app is as useful and efficient as possible. For that reason, we reserve the right to make changes to the app or to charge for its services, at any time and for any reason. We will never charge you for the app or its services without making it very clear to you exactly what you're paying for.</p>
        </div>

        <!-- Data and Security -->
        <div class="flex flex-col gap-2">
          <p>The Eureka app stores and processes personal data that you have provided to us, in order to provide my Service. It's your responsibility to keep your phone and access to the app secure. We therefore recommend that you do not jailbreak or root your phone, which is the process of removing software restrictions and limitations imposed by the official operating system of your device. It could make your phone vulnerable to malware/viruses/malicious programs, compromise your phone's security features and it could mean that the miz app won't work properly or at all.</p>
        </div>

        <!-- Third Party Services -->
        <div class="flex flex-col gap-2">
          <h2 class="text-2xl font-bold">Third Party Services</h2>
          <p>The app does use third party services that declare their own Terms and Conditions. Terms and Conditions of third party service providers used by the app are bound to owners.</p>
          <ul class="list-disc pl-6 space-y-2">
            <li>Firebase</li>
            <li>Google Play Services</li>
            <li>Google Analytics</li>
            <li>Google Crashlytics</li>
            <li>One Signal</li>
          </ul>
        </div>

        <!-- Network Connectivity -->
        <div class="flex flex-col gap-2">
          <h2 class="text-2xl font-bold">Network Connectivity and Usage</h2>
          <p>Certain functions of the app will require the app to have an active internet connection. The connection can be Wi-Fi, or provided by your mobile network provider, but MISTech company cannot take responsibility for the app not working at full functionality if you don't have access to Wi-Fi, and you don't have any of your data allowance left.</p>
          
          <p>If you're using the app outside of an area with Wi-Fi, you should remember that your terms of the agreement with your mobile network provider will still apply. As a result, you may be charged by your mobile provider for the cost of data for the duration of the connection while accessing the app, or other third party charges.</p>
        </div>

        <!-- Liability -->
        <div class="flex flex-col gap-2">
          <h2 class="text-2xl font-bold">Liability</h2>
          <p>With respect to MISTech company's responsibility for your use of the app, when you're using the app, it's important to bear in mind that although we endeavour to ensure that it is updated and correct at all times, we do rely on third parties to provide information to us so that we can make it available to you. MISTech company accepts no liability for any loss, direct or indirect, you experience as a result of relying wholly on this functionality of the app.</p>
        </div>

        <!-- App Updates -->
        <div class="flex flex-col gap-2">
          <h2 class="text-2xl font-bold">App Updates</h2>
          <p>At some point, we may wish to update the app. The app is currently available on Android and iOS – the requirements for system(and for any additional systems we decide to extend the availability of the app to) may change, and you'll need to download the updates if you want to keep using the app.</p>
        </div>

        <!-- Changes to Terms -->
        <div class="flex flex-col gap-2">
          <h2 class="text-2xl font-bold">Changes to Terms and Conditions</h2>
          <p>I may update our Terms and Conditions from time to time. Thus, you are advised to review this page periodically for any changes. I will notify you of any changes by posting the new Terms and Conditions on this page.</p>
          <p>These terms and conditions are effective as of 18-12-2024.</p>
        </div>

        <!-- Contact -->
        <div class="flex flex-col gap-2">
          <h2 class="text-2xl font-bold">Contact Us</h2>
          <p>If you have any questions or suggestions about my Terms and Conditions, do not hesitate to contact me at <a href="mailto:contact@example.com" class="underline text-primary italic" > eurekaexam@gmail.com. </a></p>
        </div>

        </div>
    </div>
    </section>

@endsection