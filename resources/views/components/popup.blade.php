<div x-data="{ open: false, actionUrl: '', actionMethod: 'POST' }"
    @toggle-confirmation-popup.window="open = true; actionUrl = $event.detail.url; actionMethod = $event.detail.method || 'POST';">
    <!-- Backdrop -->
    <div x-show="open" class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50" x-cloak></div>

    <!-- Modal -->
    <div x-show="open" class="fixed z-50 inset-0 flex items-center justify-center" x-cloak>
        <div class="bg-white dark:bg-gray-800 p-6 rounded-md shadow-md w-96">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Confirm Action</h2>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">Are you sure you want to proceed with this
                action?</p>

            <div class="flex justify-end space-x-3">
                <button @click.prevent="open = false"
                    class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                    Cancel
                </button>

                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    Confirm
                </button>
            </div>
        </div>
    </div>
</div>
