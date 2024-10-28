# State Specific Product Restrictions for WooCommerce

**Contributors:** upnorthmedia  
**Donate link:** [https://upnorthmedia.co](https://upnorthmedia.co)  
**Tags:** woocommerce, shipping, restrictions, state, block  
**Requires at least:** 5.0  
**Tested up to:** 6.6  
**Requires PHP:** 7.2  
**Stable tag:** 1.2  
**License:** GPLv2 or later  
**License URI:** [https://www.gnu.org/licenses/gpl-2.0.html](https://www.gnu.org/licenses/gpl-2.0.html)  

Blocks orders for specific products to certain states based on the customer's shipping address at checkout.

## Description

The WooCommerce State Restrictions plugin allows you to restrict certain products from being shipped to specific states within the United States. This is particularly useful for businesses that have legal or logistical restrictions on shipping certain items to certain locations.

### Features
- Restrict products from being shipped to specific states.
- Simple configuration through the WordPress admin settings.
- Displays an error message at checkout if restricted products are in the cart and the shipping address is in a restricted state.

## Installation

1. Upload the `woocommerce-state-restrictions.zip` file through the WordPress plugin upload screen.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Navigate to `Settings > State Restrictions` to configure the plugin.

## Frequently Asked Questions

### How do I restrict products to specific states?
Navigate to `Settings > State Restrictions` in the WordPress admin area. Enter the product IDs and the state codes where you want to restrict shipping. Separate multiple product IDs and state codes with commas.

### What format should I use for state codes?
Use the two-letter state codes (e.g., CA, NY, TX) to specify restricted states.

### Can I restrict multiple products and states?
Yes, you can enter multiple product IDs and state codes separated by commas.

## Screenshots

1. **Settings Page** – Configure restricted products and states.

## Changelog

### v1.2
- Added sanitization to several WP functions and calls.

### v1.1
- Updated readme.txt information.

### 1.0
- Initial release.

## Upgrade Notice

### 1.0
Initial release of the WooCommerce State Restrictions plugin.

## License

This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
```
