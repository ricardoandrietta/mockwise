<!-- Footer -->
<footer class="container mx-auto px-6 py-8 border-t border-gray-800">
    <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="text-gray-400 mb-4 md:mb-0">
            © <?php echo date('Y'); ?> Mock Wise. All rights reserved.
        </div>
        <div class="flex space-x-6">
            <a href="{{ route('terms') }}" class="text-gray-400 hover:text-white">Terms</a>
            <a href="{{ route('privacy') }}" class="text-gray-400 hover:text-white">Privacy</a>
            <a href="{{ route('contact') }}" class="text-gray-400 hover:text-white">Contact</a>
        </div>
    </div>
</footer>
