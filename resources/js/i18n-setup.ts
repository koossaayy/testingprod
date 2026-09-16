import { addMessages, init, getLocaleFromNavigator, _ } from 'svelte-i18n';
import { get } from 'svelte/store';
import enTranslations from '../../lang/en.json';
import frTranslations from '../../lang/fr.json';
import jaTranslations from '../../lang/ja.json';
import arTranslations from '../../lang/ar.json';
import ruTranslations from '../../lang/ru.json';

  addMessages('en', enTranslations);
  addMessages('fr', frTranslations);
  addMessages('ja', jaTranslations);
  addMessages('ar', arTranslations);
  addMessages('ru', ruTranslations);

init({
  fallbackLocale: 'en',
  initialLocale: getLocaleFromNavigator(),
});

// Plain-function access for non-component modules (helpers, stores), where
// the $_ store syntax is unavailable: import i18n from './i18n-setup';
// then i18n.t('...'). Evaluated per call, so it follows locale switches
// when called during render.
const t = (key: string) => get(_)(key);

export default { t };