@extends('layouts.public')

@section('title', 'Page Title')

@section('content')
    <div class="text-gray-200">
        <p class="font-bold text-2xl pb-10">Terms & Conditions</p>
        <p class="font-bold">1. Introduction</p>
        <p class="font-thin pb-5">
            Welcome to Mock Wise (&quot;Service&quot;), a platform that allows software developers to generate mock
            responses in a predictable DTO. By accessing and using our Service, you agree to comply with these Terms
            &amp; Conditions (&quot;Terms&quot;). If you do not agree, please refrain from using Mock Wise.
        </p>
        <p class="font-bold">2. User Registration &amp; Authentication</p>
        <p class="font-thin pb-5">
            To use the Service, you must register and generate a unique authentication token. You are responsible for
            maintaining the security of your account and token. Any activity conducted using your token is your sole
            responsibility.
        </p>
        <p class="font-bold">3. Acceptable Use</p>
        <p class="font-thin pb-5">
            You agree to use Mock Wise only for lawful purposes and in accordance with these Terms. You must not:
        </p>
        <ul class="list-disc pl-10 pb-5 font-thin">
            <li>Use the Service for any illegal or unauthorized purpose.</li>
            <li>Attempt to disrupt or compromise the security of the Service.</li>
            <li>Use automated bots or scripts to excessively consume resources beyond reasonable limits.</li>
        </ul>
        <p class="font-bold">4. Data Usage &amp; Ownership</p>
        <p class="font-thin pb-5">
            Mock Wise generates fake data, which users may use commercially at their own risk. We do not guarantee the
            accuracy, completeness, or appropriateness of the generated data. You acknowledge that any reliance on such
            data is at your own discretion.
        </p>
        <p class="font-bold">5. API Access &amp; Rate Limits</p>
        <p class="font-thin pb-5">
            Initially, Mock Wise is free to use. However, we reserve the right to introduce rate limits and paid plans
            in the future. Any abuse of the API may result in suspension or termination of your access.
        </p>
        <p class="font-bold">6. Logging &amp; Analytics</p>
        <p class="font-thin pb-5">
            We log user activity for analytics purposes to improve the Service. By using Mock Wise, you consent to such
            data collection in compliance with our <a class="underline" href="{{route('privacy')}}">Privacy Policy</a>.
        </p>
        <p class="font-bold">7. No Guarantees on Uptime or Accuracy</p>
        <p class="font-thin pb-5">
            Mock Wise is provided &quot;as is&quot; without any warranties of uptime, accuracy, or reliability. We are
            not responsible for any losses or damages resulting from Service interruptions or incorrect data.
        </p>
        <p class="font-bold">8. Limitation of Liability</p>
        <p class="font-thin pb-5">
            To the fullest extent permitted by law, Mock Wise and its owners shall not be liable for any direct,
            indirect, incidental, or consequential damages arising from the use of the Service.
        </p>
        <p class="font-bold">9. Changes to Terms</p>
        <p class="font-thin pb-5">
            We reserve the right to update these Terms at any time. Continued use of the Service after changes are
            posted constitutes acceptance of the revised Terms.
        </p>
        <p class="font-bold">10. Contact Information</p>
        <p class="font-thin pb-5">
            For any questions regarding these Terms, please contact us at <a href="mailto:support@mockwise.dev">support@mockwise.dev</a>
        </p>

    </div>
@endsection
