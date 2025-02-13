@extends('layouts.public')

@section('title', 'Page Title')

@section('content')
    <div class="text-gray-200">
        <p class="font-bold text-2xl pb-10">Privacy Policy</p>
        <p class="font-bold">1. Introduction</p>
        <p class="font-thin pb-5">
            This Privacy Policy explains how Mock Wise (&quot;we,&quot; &quot;us,&quot; or &quot;our&quot;) collects,
            uses, and protects user information. By using our Service, you agree to the collection and use of
            information as described in this policy.</p>
        <p class="font-bold">2. Data We Collect</p>
        <p class="font-thin pb-5">
            We collect the following data:
        </p>
        <ul class="list-disc pl-10 pb-5 font-thin">
            <li><span class="font-bold">Registration Data:</span> Full name and email address, required for account creation and authentication.</li>
            <li><span class="font-bold">Analytics Data:</span> Request logs, including date, API endpoint, and request body, used for analytics and
                service improvement.
            </li>
        </ul>
        <p class="font-bold">3. Use of Data</p>
        <p class="font-thin pb-5">
            The collected data is used for:</p>
        <ul class="list-disc pl-10 pb-5 font-thin">
            <li>Providing and maintaining the Service.</li>
            <li>Improving the quality and performance of Mock Wise.</li>
            <li>Ensuring security and preventing misuse.</li>
            <li>Communicating account-related information.</li>
        </ul>
        <p class="font-bold">4. No Use of Cookies or Tracking Technologies</p>
        <p class="font-thin pb-5">
            Mock Wise does not use cookies, tracking technologies, or third-party analytics tools to track user
            behavior.</p>
        <p class="font-bold">5. Data Storage &amp; Security</p>
        <p class="font-thin pb-5">
            User data is stored on our hosting provider, Bluehost. We take reasonable precautions to protect user data
            from unauthorized access, alteration, or disclosure.</p>
        <p class="font-bold">6. Data Sharing</p>
        <p class="font-thin pb-5">
            We do not sell, rent, or share user data with any third parties.</p>
        <p class="font-bold">7. Data Deletion</p>
        <p class="font-thin pb-5">
            Users can request data deletion through their dashboard. Upon request, all associated user data will be
            permanently removed from our systems.</p>
        <p class="font-bold">8. Communications</p>
        <p class="font-thin pb-5">
            We send emails only for account-related purposes, such as registration confirmations, security
            notifications, and service updates.</p>
        <p class="font-bold">9. Changes to this Privacy Policy</p>
        <p class="font-thin pb-5">
            We may update this Privacy Policy from time to time. Continued use of the Service after modifications
            implies acceptance of the updated policy.</p>
        <p class="font-bold">10. Contact Information</p>
        <p class="font-thin pb-5">
            For questions regarding this Privacy Policy, please contact us at <a href="mailto:support@mockwise.dev">support@mockwise.dev</a>
        </p>
    </div>
@endsection
