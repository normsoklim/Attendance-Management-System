<!-- Reusable Loading Animation Component -->
<div id="loadingOverlay" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm hidden">
    <div class="flex flex-col items-center justify-center">
        <div class="w-16 h-16 border-4 border-blue-200 border-t-blue-600 rounded-full animate-spin mb-4"></div>
        <p id="loadingMessage" class="text-white text-lg font-medium">Loading...</p>
    </div>
</div>

<script>
    // Loading overlay controller
    const loadingOverlay = document.getElementById('loadingOverlay');
    const loadingMessage = document.getElementById('loadingMessage');

    function showLoading(message = 'Loading...') {
        if (loadingMessage) loadingMessage.textContent = message;
        if (loadingOverlay) loadingOverlay.classList.remove('hidden');
    }

    function hideLoading() {
        if (loadingOverlay) loadingOverlay.classList.add('hidden');
    }

    // Auto-handle forms with data-loading attribute
    document.querySelectorAll('form[data-loading]').forEach(function(form) {
        form.addEventListener('submit', function() {
            const message = form.getAttribute('data-loading') || 'Processing...';
            showLoading(message);
        });
    });

    // Expose globally for use in inline scripts
    window.showLoading = showLoading;
    window.hideLoading = hideLoading;

    // Confirm logout and submit form with loading state
    window.confirmLogout = function(formId) {
        document.getElementById('logoutConfirmModal').classList.add('hidden');
        showLoading('{{ __('Logging out...') }}');
        document.getElementById(formId).submit();
    };
</script>