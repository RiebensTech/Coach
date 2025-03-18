<?php
/**
 * Currency Switcher Addons.
 * @since v.1.1.9
 */
namespace WOPB_PRO;
defined('ABSPATH') || exit;

/**
 * Currency_Switcher_Action Class
 * * @since v.1.1.9
 */
class Currency_Switcher_Action {

    private $wopb_current_currency_code = 'USD';
    private $wopb_current_product_price;
    private $wopb_current_exchange_fee;
	private $wopb_current_currency_rate;
	private $wopb_current_decimal;
	private $wopb_current_symbol_position;
	private $wopb_current_exclude_payment_gateways;
    private $currency_symbol;

    /**
     * Setup Class
     * @since v.1.1.9
     */
    public function __construct() {
        $this->set_currency_rate();
		add_filter('woocommerce_currency', array($this, 'change_currency_code'));
		add_filter('woocommerce_shipping_packages', array($this, 'change_shipping_cost'));
		add_action('woocommerce_coupon_loaded', array($this, 'change_coupon_amount'), 100);
		add_filter('woocommerce_product_get_price', array($this, 'change_product_price'));
		add_filter('woocommerce_product_get_sale_price', array($this, 'change_product_sale_price'));
        add_filter('woocommerce_product_get_regular_price', array($this, 'change_product_regular_price'));
		add_filter('woocommerce_variation_prices', array($this, 'change_variation_product_regular_price'), 100);
		add_filter('woocommerce_product_variation_get_price', array($this, 'change_variation_product_price'), 100);
		add_filter('woocommerce_product_variation_get_regular_price', array($this, 'change_variation_product_price'), 100);
        add_filter('woocommerce_product_variation_get_sale_price', array($this, 'change_variation_product_price'), 100);
		add_filter('wc_get_price_decimals', array($this, 'change_price_decimals'), 100);
		add_filter('woocommerce_price_format', array($this, 'change_price_format'), 100);
		add_filter('woocommerce_available_payment_gateways', array($this, 'change_available_payment_gateways'), 100);
    }
    
    /**
	 * Currency Switcher With Rates
     * 
     * @since v.1.1.9
	 * @return NULL
	 */
    public function common_currency_switcher($value) {
        if(!empty($value)) {
            if( $this->wopb_current_currency_code != wopb_function()->get_setting('wopb_default_currency')) {
                return ( ($this->wopb_current_currency_rate + $this->wopb_current_exchange_fee ) * (float)$value );
            }
        }
        return $value;
    }
    /**
	 * Get Currency from Added Currency
     * 
     * @since v.1.1.9
	 * @return NULL
	 */
    public static function get_currency($currency_code) {
        $wopb_currencies = wopb_function()->get_setting('wopb_currencies');
        if( is_array($wopb_currencies)) {
            foreach( $wopb_currencies as $key => $currency ) {
                if($currency['wopb_currency'] == $currency_code) {
                    return $currency;
                }
            }
        }
    }

    /**
	 * Set Currency Switcher Rates
     * 
     * @since v.1.1.9
	 * @return NULL
	 */
    private function set_currency_rate() {

		$this->wopb_current_currency_code = wopb_function()->get_setting('wopb_current_currency');
        $current_currency = $this->get_currency($this->wopb_current_currency_code);
        if(!$current_currency) {
            $this->wopb_current_currency_code = wopb_function()->get_setting('wopb_default_currency');
            $current_currency = $this->get_currency($this->wopb_current_currency_code);
        }
		$this->currency_symbol = get_woocommerce_currency_symbol( $this->wopb_current_currency_code );
        $this->wopb_current_currency_rate = ( isset($current_currency['wopb_currency_rate']) && $current_currency['wopb_currency_rate'] > 0 && !( $current_currency['wopb_currency_rate'] == '' ) ) ? $current_currency['wopb_currency_rate'] : 1;
        $this->wopb_current_exchange_fee = ( isset($current_currency['wopb_currency_exchange_fee']) && $current_currency['wopb_currency_exchange_fee'] >=0 && !( $current_currency['wopb_currency_exchange_fee'] == '' ) )? $current_currency['wopb_currency_exchange_fee'] : 0;
        $this->wopb_current_decimal = isset($current_currency['wopb_currency_decimals']) ? $current_currency['wopb_currency_decimals'] : '';
        $this->wopb_current_symbol_position = isset($current_currency['wopb_currency_symbol_position']) ? $current_currency['wopb_currency_symbol_position'] : '';
        $this->wopb_current_exclude_payment_gateways = isset($current_currency['wopb_currency_exclude_gateways']) ? $current_currency['wopb_currency_exclude_gateways'] : '';
    }

    /**
	 * Change Products Regular Price
     * 
     * @since v.1.1.9
	 * @return NULL
	 */
    public function change_product_regular_price($price) {
		return $this->common_currency_switcher($price);
    }

    /**
	 * Change Products Price
     * 
     * @since v.1.1.9
	 * @return NULL
	 */
    public function change_product_price($price) {
		$this->wopb_current_product_price = $price;
		return $this->common_currency_switcher($price);
    }

    /**
	 * Change Products Sales Price
     * 
     * @since v.1.1.9
	 * @return NULL
	 */
    public function change_product_sale_price($price) {
        return $this->common_currency_switcher($price);
	}

    /**
	 * Change Products Coupon Amount
     * 
     * @since v.1.1.9
	 * @return NULL
	 */
    public function change_coupon_amount($woo_coupon) {
        $coupon_type = $woo_coupon->get_discount_type();
        if( $coupon_type === 'fixed_cart' || $coupon_type === 'fixed_product' ) {
            $woo_coupon->set_amount( $this->common_currency_switcher($woo_coupon->get_amount()) );
        }
		return $woo_coupon;
	}

    /**
	 * Change Products Currency Code
     * 
     * @since v.1.1.9
	 * @return NULL
	 */
    public function change_currency_code() {
		return strtoupper($this->wopb_current_currency_code);
	}

    /**
	 * Change Variation Products Price
     * 
     * @since v.1.1.9
	 * @return NULL
	 */
    public function change_variation_product_regular_price($prices) {
		$new_price = [];
        foreach( $prices as $key => $values) {
            foreach( $values as $key2 => $val ) {
                $new_price[$key][$key2] = $this->common_currency_switcher($val);
            }
        }
		if( empty($new_price) ) {
            return $prices;
        }
        return $new_price;
	}

    /**
	 * Change Products Variation Price
     * 
     * @since v.1.1.9
	 * @return NULL
	 */
    public function change_variation_product_price($price) {
		return $this->common_currency_switcher($price);
	}
    
    /**
	 * Change Products Shipping Cost
     * 
     * @since v.1.1.9
	 * @return NULL
	 */
    public function change_shipping_cost($woo_packages) {
		foreach($woo_packages as $woopackage) {
			foreach($woopackage['rates'] as $woo_rate) {
				$woo_rate->set_cost($this->common_currency_switcher($woo_rate->get_cost()));
			}
		}
		return $woo_packages;
    }
    /**
	 * Change WC price decimals
     * 
     * @since v.1.1.9
	 * @return NULL
	 */
    public function change_price_decimals($wc_decimal) {
        if( $this->wopb_current_decimal || $this->wopb_current_decimal == '0' ) {
            return $this->wopb_current_decimal;
        }
        else {
            return $wc_decimal;
        }
    }
    /**
	 * Change WC price format
     * 
     * @since v.1.1.9
	 * @return NULL
	 */
    public function change_price_format() {
        $currency_position = $this->wopb_current_symbol_position;
        $format = '%1$s%2$s';

        switch ( $currency_position ) {
            case 'left':
                $format = '%1$s%2$s';
                break;
            case 'right':
                $format = '%2$s%1$s';
                break;
            case 'left_space':
                $format = '%1$s&nbsp;%2$s';
                break;
            case 'right_space':
                $format = '%2$s&nbsp;%1$s';
                break;
        }
        return $format;
    }
    /**
	 * Change WC change_available_payment_gateways
     * 
     * @since v.1.1.9
	 * @return NULL
	 */
    public function change_available_payment_gateways( $availableGateways ) {
        if(is_array($this->wopb_current_exclude_payment_gateways)) {
            foreach ($this->wopb_current_exclude_payment_gateways as $key => $gateway ) {
                unset( $availableGateways[$gateway] );
            }
        }
        return $availableGateways;
    }
}