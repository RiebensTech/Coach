Changes Log:
VERSION: 1.3.0 -—--- DATE: 29 January 2025
* Added: "Variation URL" support for WooCommerce Product Bundles.
* Fixed: Issue with multiple initialization of Swatchly on product page.

VERSION: 1.2.9 -—--- DATE: 12 January 2025
* Fixed: Issue global catalog attributes don't show in admin settings

VERSION: 1.2.8 -—--- DATE: 03 December 2024
* Fixed: Conflict with 3rd party plugin.

VERSION: 1.2.7 -—--- DATE: 25 November 2024
* Fixed: Translation notice issue with WordPress 6.7.1

VERSION: 1.2.6 -—--- DATE: 17 November 2024
* Fixed: "Variation URL" not working with elementor loop issue.
* Fixed: Swatch not working properly with bundles product issue.

VERSION: 1.2.5 -—--- DATE: 14 October 2024
* Added: More catalog text option.
* Fixed: Swatch limit not working properly.
* Fixed: Issue with the button text color on swatch button hover does not change correctly.

VERSION: 1.2.4 -—--- DATE: 03 October 2024
* Fixed: Capability issue in swatchly settings menu.
* Fixed: Issue Call to a member function get_available_variations()

VERSION: 1.2.3 -—--- DATE: 26 September 2024
* Added: Compatibility for WooCommerce Product Bundles plugin.

VERSION: 1.2.2 -—--- DATE: 11 September 2024
* Added: Compatibility for Astra Pro quick view

VERSION: 1.2.1 -—--- DATE: 03 August 2024
* Updated: 3rd party libraries for latest PHP version compatibility.

VERSION: 1.2.0 -—--- DATE: 11 July 2024
* Fixed: Encoding issue in product variation dropdown.

VERSION: 1.1.9 -—--- DATE: 10 July 2024
* Fixed: Issue duplicate form field id in the same form.

VERSION: 1.1.8 -—--- DATE: 24 June 2024
* Fixed: Escaping issues have been resolved in multiple areas.

VERSION: 1.1.7 -—--- DATE: 25 Mar 2024
* Added: Option to generate URL based on selected variation attributes for product details page.
* Fixed: 'Ajax add to cart' still converts dropdowns to label swatches when 'auto convert dropdowns to label' is disabled.

VERSION: 1.1.6 -—--- DATE: 14 Mar 2024
* Fixed: Undefined swatchly_params variable issue

VERSION: 1.1.5 -—--- DATE: 12 Mar 2024
* Fixed: Product image doesn't change issue in product loop while use single product add to cart function
* Fixed: Typeerror issue while using the array_values function

VERSION: 1.1.4 -—--- DATE: 19 Feb 2024
* Added: Option to generate URL based on selected variation attributes.
* Updated: Language translation .pot file

VERSION: 1.1.3 -—--- DATE: 19 Dec 2023
* Tested: Compatibility with the latest version of WooCommerce
* Updated: Language translation .pot file
* Tweak: Opt-in message to provide non-sensitive diagnostic data and usage information to improve the plugin

VERSION: 1.1.2 -—--- DATE: 07 Nov 2023
* Fixed: Compatibility error with Barn2 plugin
* Added: Option to add 3 colors for the swatches

VERSION: 1.1.1 -—--- DATE: 13 Sep 2023
* Added: Compatibility with Barn2 Product Filters Plugin.

VERSION: 1.1.0 -—--- DATE: 06 Aug 2023
* Fixed: Swatches doesn't show in elementor preview mode
* Fixed: Issue with the swatches settings on product edit page after duplicating product by WPML
* Tweak: Updated td.label class to .label for all themes compatibility
* Added: Compatibility with the OceanWP theme's quick view popup

VERSION: 1.0.9 -—--- DATE: 6 Oct 2022
* Added: Radio type swatch
* Added: Customization of the radio type swatch
* Fixed: Related product's Alignment issue
* Tweak: Compatibility for Elementor's related product
* Improved: Remove unused variables

VERSION: 1.0.8 -—--- DATE: 4 Aug 2022
* Tweak: Compatibility for Airi theme, urna theme, Jet Smart Filters plugin, WooLentor Plugin Quick view render
* Tweak: Compatibility for infinite scroll & all major infinite scroll
* Tweak: Compatibility for WooLentor plugin's Quick view render & Universal layout position
* Fixed: Codestar path issue
* Fixed: Tooltip override issue
* Fixed: Catalog mode issue

VERSION: 1.0.7 -—--- DATE: 10 Apr 2022
* Fixed: Plugin update notice showing issue

VERSION: 1.0.6 -—--- DATE: 26 Feb 2022
* Improved: .load() function for jQuery mirgrate issue
* Added Compatibility: For the "annasta Woocommerce Product Filters" plugin

VERSION: 1.0.5 -—--- DATE: 1 Nov 2021
* Fixed: Event prevent default for the loop product
* Fixed: return default select for the WPC group & grouped product
* Fixed: Showing attribute slug name instead of the Name
* Fixed: Tooltip options were overridden even if the the swatch type is = select/inherit at product level
* Added: new hook called swatchly_return_default_select

VERSION: 1.0.4 -—--- DATE: 6 Oct 2021
* Fixed: License multiple request problem

VERSION: 1.0.3 -—--- DATE: 29 Sep 2021
* Added: filter swatchly_exclude_variation_row , to exclude any variation from any product

VERSION: 1.0.2 -—--- DATE: 12 Sep 2021
* Fixed: Showing variation swatches for the product loop even if the product is out of stock
* Added: filter swatchly_hide_out_of_stock_message_for_loop_product

VERSION: 1.0.1 -—--- DATE: 25 Aug 2021
- Added: quick view support
- Added: auto convert dropdowns to image support (metabox + global)
- Improved: general settings indicator
- Improved: deciding swatch type frontend code
- Added: new body class
- Improved: swatchly_pro_get_swatch_type function rewrite

VERSION: 1.0.0
- initial release
