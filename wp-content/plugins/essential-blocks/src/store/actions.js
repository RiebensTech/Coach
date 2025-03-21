import { dispatch, useSelect, withSelect } from "@wordpress/data";

/**
 * Import Constants
 */
import {
    globalColorKey,
    customColorKey,
    gradientColorKey,
    customGradientColorKey,
    globalTypoKey,
    DEFAULT_STATE,
    SET_GLOBAL_COLORS,
    SAVE_GLOBAL_COLORS,
    SET_BLOCK_DEFAULTS,
    SAVE_BLOCK_DEFAULTS,
    FETCH_GLOBAL_COLORS,
    FETCH_BLOCK_DEFAULTS,
    SET_CUSTOM_COLORS,
    SAVE_CUSTOM_COLORS,
    FETCH_CUSTOM_COLORS,
    SET_GRADIENT_COLORS,
    SAVE_GRADIENT_COLORS,
    FETCH_GRADIENT_COLORS,
    SET_CUSTOM_GRADIENT_COLORS,
    SAVE_CUSTOM_GRADIENT_COLORS,
    FETCH_CUSTOM_GRADIENT_COLORS,
    SET_GLOBAL_TYPOGRAPHY,
    SAVE_GLOBAL_TYPOGRAPHY,
    FETCH_GLOBAL_TYPOGRAPHY,
    SET_IS_SAVING,
    FETCH_IS_SAVING,
    SET_BLOCK_DATA,
    FETCH_BLOCK_DATA
} from "./constant"

/**
 * Import Fetch Functions
 */
import {
    updateGlobalStyle,
    updateBlockDefaults
} from '../helpers/fetch';

/**
 * Action: Set Global Colors
 * @param {*} value
 * @returns
 */
export function setGlobalColors(value) {
    return {
        type: SET_GLOBAL_COLORS,
        value,
    }
}

/**
 * Action: Save Global Color to Database
 * @param {*} value
 * @returns
 */
export function saveGlobalColors(value) {
    return async ({ select, resolveSelect, dispatch }) => {
        if (Object.keys(value).length > 0) {
            let response = await updateGlobalStyle(value, globalColorKey);
        }
        dispatch({
            type: SAVE_GLOBAL_COLORS,
            value,
        })
    };
}

/**
 * Action: Fetch Global Color from Database
 * @returns
 */
export function fetchGlobalColor() {
    return {
        type: FETCH_GLOBAL_COLORS,
    }
}

/**
 * Action: Set block default
 * @param {*} value
 * @returns
 */
export function setBlockDefault(value) {
    return {
        type: SET_BLOCK_DEFAULTS,
        value,
    }
}

/**
 * Action: Save block default when click save button on each block default settings
 * @param {*} value
 * @returns
 */
export function saveBlockDefault(value) {
    return async ({ select, resolveSelect, dispatch }) => {
        // if (Object.keys(value).length > 0) {
        //     let response = await updateBlockDefaults(value);
        // }
        if (typeof value === 'object') {
            let response = await updateBlockDefaults(value);
        }
        dispatch({
            type: SAVE_BLOCK_DEFAULTS,
            value,
        })
    };
}

/**
 * Action: Fetch Block Defaults from Database
 * @returns
 */
export function fetchBlockDefaults() {
    return {
        type: FETCH_BLOCK_DEFAULTS,
    }
}

/**
 * Action: Set Custom Colors
 * @param {*} value
 * @returns
 */
export function setCustomColors(value) {
    return {
        type: SET_CUSTOM_COLORS,
        value,
    }
}

/**
 * Action: Save Custom Color to Database
 * @param {*} value
 * @returns
 */
export function saveCustomColors(value) {
    return async ({ select, resolveSelect, dispatch }) => {
        await updateGlobalStyle(value, customColorKey);
        dispatch({
            type: SAVE_CUSTOM_COLORS,
            value,
        })
    };
}

/**
 * Action: Fetch Custom Color from Database
 * @returns
 */
export function fetchCustomColor() {
    return {
        type: FETCH_CUSTOM_COLORS,
    }
}


/**
 * Action: Set Gradient Colors
 * @param {*} value
 * @returns
 */
export function setGradientColors(value) {
    return {
        type: SET_GRADIENT_COLORS,
        value,
    }
}

/**
 * Action: Save Gradient Color to Database
 * @param {*} value
 * @returns
 */
export function saveGradientColors(value) {
    return async ({ select, resolveSelect, dispatch }) => {
        if (Object.keys(value).length > 0) {
            let response = await updateGlobalStyle(value, gradientColorKey);
        }
        dispatch({
            type: SAVE_GRADIENT_COLORS,
            value,
        })
    };
}

/**
 * Action: Fetch Gradient Color from Database
 * @returns
 */
export function fetchGradientColor() {
    return {
        type: FETCH_GRADIENT_COLORS,
    }
}

/**
 * Action: Set Custom Gradient Colors
 * @param {*} value
 * @returns
 */
export function setCustomGradientColors(value) {
    return {
        type: SET_CUSTOM_GRADIENT_COLORS,
        value,
    }
}

/**
 * Action: Save Custom Gradient Color to Database
 * @param {*} value
 * @returns
 */
export function saveCustomGradientColors(value) {
    return async ({ select, resolveSelect, dispatch }) => {
        await updateGlobalStyle(value, customGradientColorKey);
        dispatch({
            type: SAVE_CUSTOM_GRADIENT_COLORS,
            value,
        })
    };
}

/**
 * Action: Fetch Custom Gradient Color from Database
 * @returns
 */
export function fetchCustomGradientColor() {
    return {
        type: FETCH_CUSTOM_GRADIENT_COLORS,
    }
}

/**
 * Action: Set Is Saving
 * @returns
 */
export function setIsSaving(value) {
    if (value) {
        dispatch('core/editor').editPost({ meta: { _eb_meta_data: 1 } })
    }
    return {
        type: SET_IS_SAVING,
        value
    }
}

/**
 * Action: Fetch Is Saving
 * @returns
 */
export function fetchIsSaving() {
    return {
        type: FETCH_IS_SAVING,
    }
}

/**
 * Action: Fetch Block Data
 * @returns
 */
export function setBlockData(key, value) {
    return {
        type: SET_BLOCK_DATA,
        value: { [key]: { ...value } }

    }
}

/**
 * Action: Fetch Block Data
 * @returns
 */
export function fetchBlockData() {
    return {
        type: FETCH_BLOCK_DATA,
    }
}

/**
 * Action: Set Global Typography
 * @param {*} value
 * @returns
 */
export function setGlobalTypography(value) {
    return {
        type: SET_GLOBAL_TYPOGRAPHY,
        value,
    }
}

/**
 * Action: Save Global Typography to Database
 * @param {*} value
 * @returns
*/
export function saveGlobalTypography(value) {
    return async ({ select, resolveSelect, dispatch }) => {
        if (Object.keys(value).length > 0) {
            let response = await updateGlobalStyle(value, globalTypoKey);
        }
        dispatch({
            type: SAVE_GLOBAL_TYPOGRAPHY,
            value,
        })
    };
}

/**
 * Action: Fetch Global Typography from Database
 * @returns
 */
export function fetchGlobalTypography() {
    return {
        type: FETCH_GLOBAL_TYPOGRAPHY,
    }
}
