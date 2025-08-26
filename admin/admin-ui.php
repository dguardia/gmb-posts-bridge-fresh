<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

$settings = GMBPostsBridge::get_settings();
$connection_status = !empty($settings['api_key']) && !empty($settings['client_id']) ? 'Connected' : 'Not Connected';
$connection_class = $connection_status === 'Connected' ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50';
?>

<div class="wrap bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto py-6">
        <!-- Clean Header -->
        <div class="bg-white rounded-lg shadow-sm mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">GMB Posts Bridge</h1>
                        <p class="text-gray-600 mt-1">Manage your Google My Business posts seamlessly</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span class="text-sm text-gray-500">Status:</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo $connection_class; ?>">
                            <span class="w-2 h-2 rounded-full <?php echo $connection_status === 'Connected' ? 'bg-green-400' : 'bg-red-400'; ?> mr-1.5"></span>
                            <?php echo $connection_status; ?>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Tab Navigation -->
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-6" aria-label="Tabs">
                    <button class="gmb-tab-btn active border-b-2 border-blue-500 py-4 px-1 text-sm font-medium text-blue-600" data-tab="dashboard">
                        Dashboard
                    </button>
                    <button class="gmb-tab-btn border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="settings">
                        Settings
                    </button>
                    <button class="gmb-tab-btn border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="api-keys">
                        API Keys
                    </button>
                    <button class="gmb-tab-btn border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300" data-tab="posts">
                        Posts
                    </button>
                </nav>
            </div>
        </div>

        <!-- Tab Content -->
        <div class="space-y-6">
            <!-- Dashboard Tab -->
            <div id="dashboard-tab" class="gmb-tab-content">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <!-- Connection Status Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Connection Status</p>
                                <div class="mt-2 flex items-center">
                                    <span class="text-lg font-semibold text-gray-900">Google My Business</span>
                                </div>
                                <p class="text-sm <?php echo $connection_status === 'Connected' ? 'text-green-600' : 'text-red-600'; ?> mt-1">
                                    <?php echo $connection_status; ?>
                                </p>
                            </div>
                            <div class="p-3 rounded-full <?php echo $connection_status === 'Connected' ? 'bg-green-100' : 'bg-red-100'; ?>">
                                <?php if ($connection_status === 'Connected'): ?>
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                <?php else: ?>
                                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Posts Synced Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Posts Synced</p>
                                <div class="mt-2 flex items-baseline">
                                    <span class="text-2xl font-semibold text-gray-900">24</span>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">This month</p>
                            </div>
                            <div class="p-3 rounded-full bg-blue-100">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Last Sync Card -->
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600">Last Sync</p>
                                <div class="mt-2 flex items-baseline">
                                    <span class="text-lg font-semibold text-gray-900">Aug 26, 2025</span>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">2:00 AM</p>
                            </div>
                            <div class="p-3 rounded-full bg-purple-100">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <button id="test-connection-btn" class="flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                            Test Connection
                        </button>
                        
                        <button class="gmb-tab-trigger flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors" data-tab="posts">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Create Post
                        </button>
                        
                        <button class="gmb-tab-trigger flex items-center justify-center px-4 py-3 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors" data-tab="settings">
                            <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Settings
                        </button>
                        
                        <button id="sync-now-btn" class="flex items-center justify-center px-4 py-3 bg-blue-600 text-white rounded-lg text-sm font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Sync Now
                        </button>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Recent Activity</h3>
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">Post published successfully</p>
                                <p class="text-sm text-gray-500">Summer sale announcement - 2 hours ago</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">Sync completed</p>
                                <p class="text-sm text-gray-500">24 posts synchronized - 6 hours ago</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                    <svg class="w-4 h-4 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900">Settings updated</p>
                                <p class="text-sm text-gray-500">API configuration changed - 1 day ago</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Settings Tab -->
            <div id="settings-tab" class="gmb-tab-content hidden">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">General Settings</h3>
                    
                    <form id="settings-form" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="location_id" class="block text-sm font-medium text-gray-700 mb-2">Default Location ID</label>
                                <input type="text" id="location_id" name="location_id" value="<?php echo esc_attr($settings['location_id']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your GMB location ID">
                                <p class="mt-1 text-sm text-gray-500">Your Google My Business location ID (optional).</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Customer Override</label>
                                <div class="flex items-center">
                                    <input type="checkbox" name="allow_customer_override" id="allow_customer_override" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" <?php checked($settings['allow_customer_override'], 1); ?>>
                                    <label for="allow_customer_override" class="ml-2 text-sm text-gray-700">Allow customers to override API keys</label>
                                </div>
                                <p class="mt-1 text-sm text-gray-500">When enabled, customers can provide their own Google My Business API credentials.</p>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-200">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- API Keys Tab -->
            <div id="api-keys-tab" class="gmb-tab-content hidden">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">API Configuration</h3>
                    
                    <div class="bg-amber-50 border border-amber-200 rounded-md p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-amber-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h4 class="text-sm font-medium text-amber-800">Important Security Notice</h4>
                                <p class="text-sm text-amber-700 mt-1">Keep your API credentials secure. Never share them publicly or commit them to version control.</p>
                            </div>
                        </div>
                    </div>
                    
                    <form id="keys-form" class="space-y-6">
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="api_key" class="block text-sm font-medium text-gray-700 mb-2">Google API Key</label>
                                <input type="password" id="api_key" name="api_key" value="<?php echo esc_attr($settings['api_key']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your Google Cloud Platform API key">
                                <p class="mt-1 text-sm text-gray-500">Your Google Cloud Platform API key with My Business API access.</p>
                            </div>

                            <div>
                                <label for="client_id" class="block text-sm font-medium text-gray-700 mb-2">OAuth Client ID</label>
                                <input type="text" id="client_id" name="client_id" value="<?php echo esc_attr($settings['client_id']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your OAuth 2.0 client ID">
                                <p class="mt-1 text-sm text-gray-500">Your Google OAuth 2.0 client ID.</p>
                            </div>

                            <div>
                                <label for="client_secret" class="block text-sm font-medium text-gray-700 mb-2">OAuth Client Secret</label>
                                <input type="password" id="client_secret" name="client_secret" value="<?php echo esc_attr($settings['client_secret']); ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Enter your OAuth 2.0 client secret">
                                <p class="mt-1 text-sm text-gray-500">Your Google OAuth 2.0 client secret.</p>
                            </div>
                        </div>

                        <div class="pt-4 border-t border-gray-200">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Save API Keys
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Posts Tab -->
            <div id="posts-tab" class="gmb-tab-content hidden">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-6">Create New Post</h3>
                    
                    <form id="post-form" class="space-y-6">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div class="lg:col-span-2">
                                <label for="post_content" class="block text-sm font-medium text-gray-700 mb-2">Post Content</label>
                                <textarea id="post_content" name="post_content" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="What's happening at your business? Share updates, promotions, or news..."></textarea>
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
                        </div>

                        <div class="pt-4 border-t border-gray-200">
                            <div class="flex space-x-3">
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Create Post
                                </button>
                                <button type="button" class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-4 rounded-md transition duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    Save Draft
                                </button>
                            </div>
                        </div>
                    </form>
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
