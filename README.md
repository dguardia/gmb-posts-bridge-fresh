# GMB Posts Bridge

A clean, simple WordPress plugin for managing Google My Business posts with modern UI and customer API key override functionality.

## Features

- **Modern UI**: Built with Tailwind CSS for a clean, responsive interface
- **Tabbed Interface**: Organized sections for Home, Settings, API Keys, and Post Creation
- **API Key Management**: Secure storage and management of Google My Business API credentials
- **Customer Override**: Allow customers to use their own API keys
- **Simple & Clean**: Minimal, working foundation that can be built upon

## Installation

1. Download or clone this repository
2. Upload the `gmb-posts-bridge-fresh` folder to your WordPress `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Navigate to 'GMB Posts' in your WordPress admin menu

## Configuration

### API Setup

1. Go to the **API Keys** tab in the plugin
2. Enter your Google My Business API credentials:
   - Google API Key
   - OAuth Client ID
   - OAuth Client Secret
3. Save your settings

### Settings

1. Go to the **Settings** tab
2. Configure your preferences:
   - Enable/disable customer API key override
   - Set default location ID
3. Save your settings

## Usage

### Testing Connection

1. Go to the **Home** tab
2. Click "Test Connection" to verify your API setup

### Creating Posts

1. Go to the **Create Post** tab
2. Enter your post content
3. Select post type and call-to-action
4. Click "Create Post"

*Note: Post creation is currently a placeholder and needs to be implemented with actual GMB API integration.*

## Development

This plugin provides a solid foundation with:

- Clean WordPress plugin structure
- Modern Tailwind CSS styling
- AJAX-powered interface
- Secure settings storage
- Extensible architecture

### File Structure

```
gmb-posts-bridge-fresh/
├── gmb-posts-bridge.php    # Main plugin file
├── admin/
│   └── admin-ui.php        # Admin interface
├── assets/
│   ├── admin.css          # Custom styles
│   └── admin.js           # JavaScript functionality
└── README.md              # This file
```

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher
- Google My Business API access

## License

GPL v2 or later

## Contributing

This is a clean, minimal foundation. Contributions are welcome to add:

- Actual GMB API integration
- Post scheduling functionality
- Media upload support
- Analytics and reporting
- Additional post types

## Support

For support and feature requests, please use the GitHub issues page.