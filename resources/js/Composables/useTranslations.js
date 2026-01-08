import { usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

// Translation helper for Vue components
export function useTranslations() {
    const page = usePage();
    
    const currentLocale = computed(() => page.props.locale || 'ar');
    const translations = computed(() => page.props.translations || {});
    
    /**
     * Translate a key
     * @param {string} key - The translation key (e.g., 'superadmin.login')
     * @param {object} replacements - Key-value pairs for replacements
     * @returns {string}
     */
    const t = (key, replacements = {}) => {
        let translation = translations.value[key] || key;
        
        // Handle replacements like :name, :count
        Object.keys(replacements).forEach(k => {
            translation = translation.replace(`:${k}`, replacements[k]);
        });
        
        return translation;
    };
    
    /**
     * Check if current locale is RTL
     */
    const isRtl = computed(() => currentLocale.value === 'ar');
    
    /**
     * Get direction based on locale
     */
    const direction = computed(() => isRtl.value ? 'rtl' : 'ltr');
    
    return {
        t,
        currentLocale,
        isRtl,
        direction,
        translations
    };
}

// Simple global translation function
export function __(key, replacements = {}) {
    // This will be replaced by the actual translations from the page props
    const page = usePage();
    const translations = page.props.translations || {};
    
    let translation = translations[key] || key;
    
    Object.keys(replacements).forEach(k => {
        translation = translation.replace(`:${k}`, replacements[k]);
    });
    
    return translation;
}
