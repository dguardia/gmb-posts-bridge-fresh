<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

$settings = GMBPostsBridge::get_settings();
?>

<div class="wrap bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto py-8">
        <div class="bg-white rounded-lg shadow-sm">
            <!-- Header -->
            <div class="border-b border-gray-200 px-6 py-4">
                <h1 class="text-2xl font-bold text-gray-900 flex items-center">
                    <span class="text-blue-600 mr-2">📢</span>
                    GMB Posts Bridge
                </h1>
                <p class="text-gray-600 mt-1">Manage your Google My Business posts with ease</p>
            </div>

            <!-- Tab Navigation -->
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-6" aria-label="Tabs">
                    <button class="gmb-tab-btn active border-b-2 border-blue-500 py-4 px-1 text-sm font-medium text-blue-600" data-tab="home">
                        Home
                    </button>
                    <button class="gmb-tab-btn border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="settings">
                        Settings
                    </button>
                    <button class="gmb-tab-btn border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="keys">
                        API Keys
                    </button>
                    <button class="gmb-tab-btn border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="post">
                        Create Post
                    </button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="p-6">
                <!-- Home Tab -->
                <div id="home-tab" class="gmb-tab-content">
                    <div class="text-center py-12">
                        <div class="mx-auto h-24 w-24 text-blue-500 mb-4">
                            <svg fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V8zm0 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Welcome to GMB Posts Bridge</h3>
                        <p class="text-gray-600 mb-6 max-w-md mx-auto">
                            Connect your Google My Business account and start managing your posts directly from WordPress.
                        </p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                            <div class="bg-blue-50 p-6 rounded-lg">
                                <div class="text-blue-600 text-2xl mb-2">🔑</div>
                                <h4 class="font-semibold text-gray-900 mb-2">Configure API Keys</h4>
                                <p class="text-gray-600 text-sm">Set up your Google My Business API credentials to get started.</p>
                            </div>
                            <div class="bg-green-50 p-6 rounded-lg">
                                <div class="text-green-600 text-2xl mb-2">⚙️</div>
                                <h4 class="font-semibold text-gray-900 mb-2">Customize Settings</h4>
                                <p class="text-gray-600 text-sm">Configure your preferences and enable customer overrides.</p>
                            </div>
                            <div class="bg-purple-50 p-6 rounded-lg">
                                <div class="text-purple-600 text-2xl mb-2">📝</div>
                                <h4 class="font-semibold text-gray-900 mb-2">Create Posts</h4>
                                <p class="text-gray-600 text-sm">Start creating and managing your Google My Business posts.</p>
                            </div>
                        </div>

                        <div class="mt-8">
                            <button id="test-connection-btn" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                                Test Connection
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Settings Tab -->
                <div id="settings-tab" class="gmb-tab-content hidden">
                    <div class="max-w-2xl">
                        <h3 class="text-lg font-medium text-gray-900 mb-6">General Settings</h3>
                        
                        <form id="settings-form" class="space-y-6">
                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" name="allow_customer_override" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50" <?php checked($settings['allow_customer_override'], 1); ?>>
                                    <span class="ml-2 text-sm text-gray-700">Allow customers to override API keys</span>
                                </label>
                                <p class="mt-1 text-sm text-gray-500">When enabled, customers can provide their own Google My Business API credentials.</p>
                            </div>

                            <div>
                                <label for="location_id" class="block text-sm font-medium text-gray-700 mb-2">Default Location ID</label>
                                <input type="text" id="location_id" name="location_id" value="<?php echo esc_attr($settings['location_id']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <p class="mt-1 text-sm text-gray-500">Your Google My Business location ID (optional).</p>
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                                    Save Settings
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- API Keys Tab -->
                <div id="keys-tab" class="gmb-tab-content hidden">
                    <div class="max-w-2xl">
                        <h3 class="text-lg font-medium text-gray-900 mb-6">API Configuration</h3>
                        
                        <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4 mb-6">
                            <div class="flex">
                                <div class="text-yellow-400 mr-3">⚠️</div>
                                <div>
                                    <h4 class="text-sm font-medium text-yellow-800">Important</h4>
                                    <p class="text-sm text-yellow-700 mt-1">Keep your API credentials secure. Never share them publicly.</p>
                                </div>
                            </div>
                        </div>
                        
                        <form id="keys-form" class="space-y-6">
                            <div>
                                <label for="api_key" class="block text-sm font-medium text-gray-700 mb-2">Google API Key</label>
                                <input type="password" id="api_key" name="api_key" value="<?php echo esc_attr($settings['api_key']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <p class="mt-1 text-sm text-gray-500">Your Google Cloud Platform API key with My Business API access.</p>
                            </div>

                            <div>
                                <label for="client_id" class="block text-sm font-medium text-gray-700 mb-2">OAuth Client ID</label>
                                <input type="text" id="client_id" name="client_id" value="<?php echo esc_attr($settings['client_id']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <p class="mt-1 text-sm text-gray-500">Your Google OAuth 2.0 client ID.</p>
                            </div>

                            <div>
                                <label for="client_secret" class="block text-sm font-medium text-gray-700 mb-2">OAuth Client Secret</label>
                                <input type="password" id="client_secret" name="client_secret" value="<?php echo esc_attr($settings['client_secret']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                <p class="mt-1 text-sm text-gray-500">Your Google OAuth 2.0 client secret.</p>
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                                    Save API Keys
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Create Post Tab -->
                <div id="post-tab" class="gmb-tab-content hidden">
                    <div class="max-w-2xl">
                        <h3 class="text-lg font-medium text-gray-900 mb-6">Create New Post</h3>
                        
                        <form id="post-form" class="space-y-6">
                            <div>
                                <label for="post_content" class="block text-sm font-medium text-gray-700 mb-2">Post Content</label>
                                <textarea id="post_content" name="post_content" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="What's happening at your business?"></textarea>
                                <p class="mt-1 text-sm text-gray-500">Share updates, promotions, or news about your business.</p>
                            </div>

                            <div>
                                <label for="post_type" class="block text-sm font-medium text-gray-700 mb-2">Post Type</label>
                                <select id="post_type" name="post_type" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="STANDARD">Standard Post</option>
                                    <option value="EVENT">Event</option>
                                    <option value="OFFER">Offer</option>
                                    <option value="PRODUCT">Product</option>
                                </select>
                            </div>

                            <div>
                                <label for="call_to_action" class="block text-sm font-medium text-gray-700 mb-2">Call to Action</label>
                                <select id="call_to_action" name="call_to_action" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">None</option>
                                    <option value="BOOK">Book</option>
                                    <option value="ORDER">Order</option>
                                    <option value="SHOP">Shop</option>
                                    <option value="LEARN_MORE">Learn More</option>
                                    <option value="SIGN_UP">Sign Up</option>
                                    <option value="CALL">Call</option>
                                </select>
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                                    Create Post
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    <div id="gmb-message" class="fixed top-4 right-4 max-w-sm w-full bg-white border border-gray-200 rounded-lg shadow-lg p-4 transform translate-x-full transition-transform duration-300 ease-in-out z-50">
        <div class="flex items-center">
            <div id="gmb-message-icon" class="flex-shrink-0 mr-3"></div>
            <div id="gmb-message-text" class="text-sm font-medium text-gray-900"></div>
        </div>
    </div>
</div>